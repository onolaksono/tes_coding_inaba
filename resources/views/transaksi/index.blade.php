@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- Judul Halaman -->
        <div class="col-md-12">
            <h2 class="mb-4">Buat Transaksi</h2>
        </div>

        @include('transaksi.modal.addCart')

        <!-- Tabel Produk -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{-- <h5>Daftar Transaksi</h5> --}}
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <h4 class="mb-0">Kode Transaksi</h4>
                        </div>
                        <div class="col-md-10">
                            <h4 class="mb-0">: {{ $kodeTransaksi }}</h4>
                            <input type="hidden" name="kodeTrans" value="{{ $kodeTransaksi }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <h4 class="mb-0">Tanggal</h4>
                        </div>
                        <div class="col-md-10">
                            <h4 class="mb-0">: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</h4>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-auto">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCart">
                                Tambah Produk
                            </button>
                        </div>
                        <div class="col d-flex justify-content-end">
                                <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapuskeranjang"
                                    {{ $jumlahItem == 0 ? 'disabled' : '' }}>
                                    Kosongkan Keranjang
                                </button>
                            @include('transaksi.modal.hapusKeranjang')
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 5%" class="text-center">No</th>
                                <th>Produk</th>
                                <th class="text-center" style="width: 10%">Quantity</th>
                                <th class="text-center" style="width: 15%">Harga</th>
                                <th class="text-center" style="width: 15%">Subtotal</th>
                                <th class="text-center" style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($keranjang->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center">Keranjang kosong</td>
                                </tr>
                            @else
                                @foreach ($keranjang as $cart)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $cart->produk }}</td>
                                        <td>
                                            <form action="{{ route('keranjang.update', $cart->id) }}" method="POST">
                                                @csrf
                                                <input class="form-control text-center" type="number" name="qty"
                                                    value="{{ $cart->quantity }}" class="form-control" min="1"
                                                    onchange="this.form.submit()">
                                            </form>
                                        </td>
                                        <td class="text-center">Rp {{ number_format($cart->harga, 0, ',', '.') }}</td>
                                        <td class="text-center">Rp {{ number_format($cart->subtotal, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('keranjang.destroy', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <form id="form-transaksi" action="{{ route('transaksi.simpan') }}" method="POST">
                        @csrf

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label for="bayar" class="form-label">Total</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="bayar"
                                    value="Rp. {{ number_format($total, 0, ',', '.') }}" readonly>
                                <input type="hidden" name="total" value="{{ $total }}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label for="diterima" class="form-label">Bayar</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="diterima"
                                    placeholder="Masukkan jumlah uang yang diterima" required>
                                <div id="error-message" class="text-danger mt-2" style="display:none;"></div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label for="kembali" class="form-label">Kembalian</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="kembali" value="Rp. 0" readonly>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary" {{ $jumlahItem == 0 ? 'disabled' : '' }}>
                                Simpan Transaksi
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("cariProduk").addEventListener("keyup", function() {
            const keyword = this.value.toLowerCase();
            const rows = document.querySelectorAll("#tabelProduk tbody tr");

            rows.forEach(function(row) {
                const namaProduk = row.querySelector(".nama-produk").textContent.toLowerCase();
                row.style.display = namaProduk.includes(keyword) ? "" : "none";
            });
        });
    </script>

    <script>
        function formatCurrency(value) {
            value = value.replace(/\D/g, '');
            return 'Rp. ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function updateKembalian() {
            var bayar = parseFloat(document.getElementById('bayar').value.replace(/Rp\. /g, '').replace(/\./g, '').trim());
            var diterima = document.getElementById('diterima').value.replace(/Rp\. /g, '').replace(/\D/g, '')
        .trim();
            var errorMessage = document.getElementById('error-message');
            var kembaliField = document.getElementById('kembali');

            if (diterima === "" || isNaN(diterima)) {
                errorMessage.innerHTML = "Uang tidak boleh kosong";
                errorMessage.style.display = "block";
                kembaliField.value = "Rp. 0";
                return;
            }

            // Hitung kembalian
            var kembali = parseFloat(diterima) - bayar;

            // kembalian negatif
            if (kembali < 0) {
                errorMessage.innerHTML = "Uang tidak boleh kurang dari total bayar";
                errorMessage.style.display = "block";
                kembaliField.value = "Rp. 0";
                return;
            }
            errorMessage.style.display = "none";
            kembaliField.value = "Rp. " + kembali.toLocaleString('id-ID');
        }

        document.getElementById('bayar').addEventListener('input', function() {
            this.value = formatCurrency(this.value);
            updateKembalian();
        });

        document.getElementById('diterima').addEventListener('input', function() {
            var diterima = this.value.replace(/Rp\. /g, '').replace(/\D/g, '').trim();
            this.value = formatCurrency(diterima);
            updateKembalian();
        });

        // Form submit
        document.getElementById('form-transaksi').addEventListener('submit', function(event) {
            var bayar = parseFloat(document.getElementById('bayar').value.replace(/Rp\. /g, '').replace(/\./g, '')
                .trim());
            var diterima = document.getElementById('diterima').value.replace(/Rp\. /g, '').replace(/\D/g, '')
        .trim();
            var errorMessage = document.getElementById('error-message');

            if (diterima === "" || isNaN(diterima)) {
                errorMessage.innerHTML = "Uang tidak boleh kosong";
                errorMessage.style.display = "block";
                event.preventDefault();
                return;
            }

            var kembali = parseFloat(diterima) - bayar;

            if (kembali < 0) {
                errorMessage.innerHTML = "Uang tidak boleh kurang dari total bayar";
                errorMessage.style.display = "block";
                event.preventDefault();
                return;
            }

            errorMessage.style.display = "none";
        });
    </script>

@endsection
