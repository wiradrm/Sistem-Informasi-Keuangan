<div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('produk.store')}}" method="POST">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label for="nama" class="col-form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama_produk">
        </div>
        <div class="form-group">
          <label for="deskripsi-text" class="col-form-label">Deskripsi</label>
          <textarea id="editor" class="deskripsi-text" name="deskripsi"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>