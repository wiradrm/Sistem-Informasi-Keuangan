<div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('karyawan.store')}}" method="POST" autocomplete="off">
      @csrf
      <div class="modal-body">
        <div class="form-group">
            <label for="nik" class="col-form-label">NIK</label>
            <input type="number" class="form-control" id="nik" name="nik" pattern="\d*" maxlength="4">
          </div>
          <div class="form-group">
            <label for="nama" class="col-form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama_user">
          </div>
          <div class="form-group">
            <label for="username" class="col-form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="form-group">
            <label for="username" class="col-form-label">Email</label>
            <input type="email" class="form-control" id="nama" name="email">
          </div>
          <div class="form-group">
            <label for="phone" class="col-form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone">
          </div>
          <div class="form-group">
            <label for="jabatan" class="col-form-label">Jabatan</label>
            <select name="jabatan_id" class="form-control" id="jabatan">
            @foreach($jabatan as $row)
                <option value="{{$row->id}}">{{$row->jabatan}}</option>
            @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="password" class="col-form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="false">
          </div>
          <div class="form-group">
            <label for="password_confirmation" class="col-form-label">Password Confirmation</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="false">
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