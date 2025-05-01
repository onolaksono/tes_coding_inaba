<!-- Modal Hapus Produk -->
<div class="modal fade" id="modalHapusHistory{{ $item->id }}" tabindex="-1" aria-labelledby="modalHapusHistory{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/history/{{ $item->id }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalHapusProdukLabel">Hapus Transaksi</h5>
                    <button type="button" class="btn-close" style="background-color: white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Apakah Anda yakin ingin menghapus transaksi ini?</p>
                    <h5 class="text-danger">"{{ $item->kode_transaksi }}"</h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
