<div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('kelas.store')}}" method="POST" autocomplete="off">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label for="no_kelas" class="col-form-label">No Kelas</label>
          <input type="text" class="form-control" id="no_kelas" name="no_kelas">
        </div>
        <div class="form-group">
          <label for="kelas" class="col-form-label">Kelas</label>
          <input type="text" class="form-control" id="kelas" name="kelas">
        </div>
        <div class="form-group">
          <label for="wali" class="col-form-label">Wali</label>
          <input type="text" class="form-control" id="wali" name="wali">
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