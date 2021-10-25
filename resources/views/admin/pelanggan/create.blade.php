<div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('pelanggan.store')}}" method="POST" autocomplete="off">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label for="nipnas" class="col-form-label">NIPNAS</label>
          <input type="text" class="form-control" id="nipnas" name="nipnas">
        </div>
        <div class="form-group">
          <label for="pelanggan" class="col-form-label">Pelanggan</label>
          <input type="text" class="form-control" id="pelanggan" name="nama_pelanggan">
        </div>
        <div class="form-group">
          <label for="am" class="col-form-label">AM</label>
          <select name="user_id" id="am" class="form-control">
              @foreach($am as $key => $data)
              <option value="{{$data->id}}">{{$data->nama_user}} (ID: {{$data->id}})</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="email" class="col-form-label">Email Pelanggan</label>
          <input type="email" class="form-control" id="email" name="email_pelanggan">
        </div>
        <div class="form-group">
          <label for="phone" class="col-form-label">Nomor Telepone</label>
          <input type="text" class="form-control" id="phone" name="phone">
        </div>
        <div class="form-group">
          <label for="ba" class="col-form-label">BA</label>
          <input type="text" class="form-control" id="ba" name="ba">
        </div>
        <div class="form-group">
          <label for="sid" class="col-form-label">SID</label>
          <input type="text" class="form-control" id="sid" name="sid">
        </div>
        <div class="form-group">
          <label for="alamat" class="col-form-label">Alamat</label>
          <input type="text" class="form-control" id="alamat" name="alamat">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="latitude-create">Latitude</label>
            <input id="latitude-create" type="text" class="form-control" name="latitude">
          </div>
          <div class="form-group col-md-6">
            <label for="longitude-create">Longitude</label>
            <input id="longitude-create" type="text" class="form-control" name="longitude">
          </div>
        </div>
        <div id="map-create" style="height: 300px; border: 1px solid #000;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>