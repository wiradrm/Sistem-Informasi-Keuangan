<div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('posting.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label for="nama" class="col-form-label">Nama Kegiatan</label>
          <input type="text" class="form-control" id="nama" name="nama_kegiatan">
        </div>
        <div class="form-group">
          <label for="deskripsi-text" class="col-form-label">Kegiatan</label>
          <textarea class="form-control" name="keterangan" rows="8"></textarea>
        </div>
        <div class="form-group">
            <label for="am" class="col-form-label">Customer</label>
            <select name="pelanggan_id" id="am" class="form-control">
                @foreach($pelanggan as $key => $data)
                <option value="{{$data->nipnas}}">{{$data->nama_pelanggan}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="col-form-label">Dokumentasi</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01" name="img">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
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