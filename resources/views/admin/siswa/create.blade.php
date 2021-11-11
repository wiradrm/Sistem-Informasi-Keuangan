<div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('siswa.store')}}" method="POST" autocomplete="off">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label for="nisn" class="col-form-label">NISN</label>
          <input type="text" class="form-control" id="nisn" name="nisn">
        </div>
        <div class="form-group">
          <label for="nama_siswa" class="col-form-label">Nama</label>
          <input type="text" class="form-control" id="nama_siswa" name="nama_siswa">
        </div>
        <div class="form-group">
          <label for="tempat" class="col-form-label">Tempat Lahir</label>
          <input type="text" class="form-control" id="tempat" name="tempat">
        </div>
        <div class="form-group">
          <label for="tanggal" class="col-form-label">Tanggal Lahir</label>
          <input type="date" class="form-control" id="tanggal" name="tanggal">
        </div>
        <div class="form-group">
          <label for="alamat" class="col-form-label">Alamat</label>
          <input type="text" class="form-control" id="alamat" name="alamat">
        </div>
        <div class="form-group">
          <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin</label>
          <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin">
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