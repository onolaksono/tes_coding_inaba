<!-- Modal Hapus Keranjang -->
<div class="modal fade" id="modalHapuskeranjang" tabindex="-1" aria-labelledby="modalHapuskeranjang" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/keranjang/kosongkan" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalHapusProdukLabel">Kosongkan Keranjang</h5>
                    <button type="button" class="btn-close" style="background-color: white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4>Apakah Anda yakin ingin menghapus semua isi keranjang?</h4>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
