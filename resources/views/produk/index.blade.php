@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Daftar Produk</h2>
        </div>

        @include('produk.modal.produk_create')
        <div class="col-md-12 mb-4">
            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">Tambah
                Produk</a>

        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Produk</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Nama Produk</th>
                                <th class="text-center" style="width: 10%;">Harga</th>
                                <th class="text-center" style="width: 10%;">Stok</th>
                                <th class="text-center" style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->produk }}</td>
                                    <td class="text-center">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->stok }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center flex-wrap gap-2">
                                            <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditProduk{{ $item->id }}">Edit</a>
                                            <a href="" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapusProduk{{ $item->id }}">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                                @include('produk.modal.produk_edit')
                                @include('produk.modal.produk_delete')
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
