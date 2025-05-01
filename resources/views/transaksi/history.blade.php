@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">History</h2>
        </div>

        @include('produk.modal.produk_create')
        <div class="col-md-12 mb-4">
            <a href="/transaksi" class="btn btn-success">Buat Transaksi</a>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Transaksi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Kode Transaksi</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Total</th>
                                <th class="text-center" style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_transaksi }}</td>
                                    <td class="text-center">{{ $item->tanggal }}</td>
                                    <td class="text-center">Rp {{ number_format($item->totalTransaksi, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center flex-wrap gap-2">
                                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detailHistory{{ $item->id }}">Detail</a>
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalHapusHistory{{ $item->id }}">Hapus</a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @foreach ($transaksi as $item)
                        @include('transaksi.modal.detailHistory')
                        @include('transaksi.modal.hapusHistory')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
