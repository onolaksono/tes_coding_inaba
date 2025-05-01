<!-- Modal Detail Transaksi -->
<div class="modal fade" id="detailHistory{{ $item->id }}" tabindex="-1"
    aria-labelledby="detailHistory{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalTambahProdukLabel">Detail Transaksi - {{ $item->kode_transaksi }}</h5>
                <button type="button" class="btn-close" style="background-color: white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Konten Modal -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <h5 class="mb-0">Kode Transaksi</h5>
                    </div>
                    <div class="col-md-10">
                        <h5 class="mb-0">: {{ $item->kode_transaksi }}</h5>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <h5 class="mb-0">Tanggal</h5>
                    </div>
                    <div class="col-md-10">
                        <h5 class="mb-0">: {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</h5>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Nama Produk</th>
                                <th class="text-center" style="width: 15%;">Quantity</th>
                                <th class="text-center" style="width: 20%;">Harga</th>
                                <th class="text-center" style="width: 20%;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->detailTransaksi as $detail)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $detail->produk->produk }}</td>
                                    <td class="text-center">{{ $detail->quantity }}</td>
                                    <td class="text-center">Rp {{ number_format($detail->produk->harga, 0, ',', '.') }}</td>
                                    <td class="text-center">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-right"><strong>Total</strong></td>
                                <td class="text-center">
                                    <strong>Rp {{ number_format($item->totalTransaksi, 0, ',', '.') }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
