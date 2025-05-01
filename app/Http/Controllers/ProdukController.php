<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::orderBy('produk', 'asc')->get();

        return view('produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Validasi input produk
       $validated = $request->validate([
        'produk' => 'required|string|unique:produk,produk',
        'harga'  => 'required|integer|min:0',
        'stok'   => 'required|integer|min:0',
        ], [
            'produk.required' => 'Nama produk wajib diisi.',
            'produk.unique'   => 'Nama produk sudah ada, silakan gunakan nama lain.',
            'harga.required'  => 'Harga tidak boleh kosong.',
            'harga.integer'   => 'Harga harus berupa angka.',
            'harga.min'       => 'Harga tidak sesuai.',
            'stok.required'   => 'Stok wajib diisi.',
            'stok.integer'    => 'Stok harus berupa angka.',
            'stok.min'        => 'Stok tidak boleh minus.',
        ]);

        try {
            // Simpan data produk
            Produk::create([
                'produk' => $validated['produk'],
                'harga'  => $validated['harga'],
                'stok'   => $validated['stok'],
            ]);
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan produk.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input produk
        $validated = $request->validate([
        'produk' => [
                'required',
                'string',
                'max:255',
                Rule::unique('produk')->ignore($id),
            ],
        'harga'  => 'required|integer|min:0',
        'stok'   => 'required|integer|min:0',
        ], [
            'produk.required' => 'Nama produk wajib diisi.',
            'produk.unique'   => 'Nama produk sudah ada, silakan gunakan nama lain.',
            'harga.required'  => 'Harga tidak boleh kosong.',
            'harga.integer'   => 'Harga harus berupa angka.',
            'harga.min'       => 'Harga tidak sesuai.',
            'stok.required'   => 'Stok wajib diisi.',
            'stok.integer'    => 'Stok harus berupa angka.',
            'stok.min'        => 'Stok tidak boleh minus.',
        ]);
        try {
            $produk = Produk::findOrFail($id);
            $produk->produk = $request->produk;
            $produk->harga = $request->harga;
            $produk->stok = $request->stok;
            $produk->save();
            return redirect()->back()->with('success', 'Produk berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat update produk.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat hapus produk.');
        }
    }
}
