<!-- Modal Pilih Barang -->
<div class="modal fade" id="addCart" tabindex="-1" aria-labelledby="addCartLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addCartLabel">Pilih Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <!-- Form pencarian -->
                    <div class="mb-3">
                        <input type="text" class="form-control" id="cariProduk" placeholder="Cari nama produk...">
                    </div>

                    <!-- Tabel Produk -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabelProduk">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th>Nama Produk</th>
                                    <th class="text-center" style="width: 15%;">stok</th>
                                    <th class="text-center" style="width: 30%;">Harga</th>
                                    <th class="text-center" style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="nama-produk">{{ $item->produk }}</td>
                                        <td class="text-center">{{ $item->stok }}</td>
                                        <td class="text-center">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td class="d-flex justify-content-center flex-wrap gap-2">
                                            <form action="/add_to_cart/{{ $item->id }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm" {{ $item->stok == 0 ? 'disabled' : '' }}>
                                                    Pilih
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
