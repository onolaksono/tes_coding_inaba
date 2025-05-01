<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kodeTransaksi = $this->kodeOtomatis();
        $produk = Produk::orderBy('produk', 'asc')->get();
        $keranjang = Keranjang::orderBy('id')->get();
        $total = $keranjang->sum('subtotal');
        $jumlahItem = Keranjang::count();
        return view('transaksi.index', compact('produk', 'keranjang', 'kodeTransaksi', 'total', 'jumlahItem'));
    }

    public function kodeOtomatis()
    {
        $tanggal = date('Ymd');

        // Ambil semua transaksi hari ini
        $dataHariIni = Transaksi::whereDate('tanggal', today())->get();

        $maxNumber = 0;

        foreach ($dataHariIni as $item) {
            // Ambil angka setelah TRS, sebelum tanda -
            if (preg_match('/TRS(\d+)-/', $item->kode_transaksi, $matches)) {
                $angka = (int) $matches[1];
                if ($angka > $maxNumber) {
                    $maxNumber = $angka;
                }
            }
        }

        $kode = sprintf('%03d', $maxNumber + 1);

        return 'TRS' . $kode . '-' . $tanggal;

    }

    public function add_cart($id){
        $produk = Produk::findOrFail($id);
        $keranjang = Keranjang::where('id_produk', $produk->id)->first();
        if ($keranjang) {
            $keranjang->quantity += 1;
            $keranjang->subtotal = $keranjang->quantity * $keranjang->harga;
        } else {
            $keranjang = new Keranjang;
            $keranjang->id_produk = $produk->id;
            $keranjang->produk = $produk->produk;
            $keranjang->harga = $produk->harga;
            $keranjang->quantity = 1;
            $keranjang->subtotal = $keranjang->quantity * $keranjang->harga;
        }

        $keranjang->save();
        return redirect('/transaksi');
    }

    public function updateQty(Request $request, $id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $produk = Produk::findOrFail($keranjang->id_produk);
        $request->validate([
            'qty' => 'required|integer|min:1|max:' . $produk->stok,
        ], [
            'qty.max'  => 'Pembelian tidak bisa lebih dari '. $produk->stok
        ]);
        $keranjang->quantity = $request->input('qty');
        $keranjang->subtotal = $keranjang->quantity * $keranjang->harga;

        $keranjang->save();
        return redirect('/transaksi');
    }

    public function hapusProduk($id){
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();
        return redirect('/transaksi');
    }

    public function hapus_Semua()
    {
        try {
            Keranjang::truncate();
            return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus semua produk.');
        }
    }

    public function simpanTransaksi() {
        try {
            DB::beginTransaction();

            $kode_transaksi = $this->kodeOtomatis();
            $tanggal_transaksi = Carbon::now()->format('Y-m-d');
            $keranjang = Keranjang::all();
            $total = $keranjang->sum('subtotal');

            $transaksi = new Transaksi();
            $transaksi->kode_transaksi = $kode_transaksi;
            $transaksi->tanggal = $tanggal_transaksi;
            $transaksi->save();

            foreach ($keranjang as $cart) {
                 // Mengurangi stok produk
                $produk = Produk::find($cart->id_produk);
                if ($produk) {
                    $produk->stok -= $cart->quantity;
                    $produk->save();
                }

                $detailTransaksi = new DetailTransaksi();
                $detailTransaksi->id_transaksi = $transaksi->id;
                $detailTransaksi->id_produk = $cart->id_produk;
                $detailTransaksi->quantity = $cart->quantity;
                $detailTransaksi->save();
            }

            Keranjang::truncate();

            DB::commit();

            return redirect()->back()->with('success', 'Transaksi Berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan transaksi: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan transaksi.');
        }
    }

    public function history()
    {
        $transaksi = Transaksi::with('detailTransaksi.produk')->orderBy('id')->get();

        foreach ($transaksi as $tran) {
            $total = 0;

            foreach ($tran->detailTransaksi as $detail) {
                $qty = $detail->quantity;
                $harga = $detail->produk->harga ?? 0;
                $subtotal = $qty * $harga;

                $detail->subtotal = $subtotal;
                $total += $subtotal;
            }

            $tran->totalTransaksi = $total;
        }

        return view('transaksi.history', compact('transaksi'));
    }

    public function hapus($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->detailTransaksi()->delete();
        $transaksi->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }

}
