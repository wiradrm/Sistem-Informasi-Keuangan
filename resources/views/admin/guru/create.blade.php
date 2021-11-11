<div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('guru.store')}}" method="POST" autocomplete="off">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label for="nip" class="col-form-label">NIP</label>
          <input type="text" class="form-control" id="nip" name="nip">
        </div>
        <div class="form-group">
          <label for="nama_guru" class="col-form-label">Nama</label>
          <input type="text" class="form-control" id="nama_guru" name="nama_guru">
        </div>
        <div class="form-group">
          <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin</label>
          <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin">
        </div>
        <div class="form-group">
          <label for="mapel" class="col-form-label">Mata Pelajaran</label>
          <input type="text" class="form-control" id="mapel" name="mapel">
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