<div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('spp.store')}}" method="POST" autocomplete="off">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label for="kode_spp" class="col-form-label">Kode SPP</label>
          <input type="kode_spp" class="form-control" id="kode_spp" name="kode_spp">
        </div>
        <div class="form-group">
          <label for="angkatan" class="col-form-label">Angkatan</label>
          <input type="text" class="form-control" id="angkatan" name="angkatan">
        </div>
        <div class="form-group">
          <label for="bulan" class="col-form-label">Bulan</label>
          <select name="bulan" id="bulan" class="form-control">
            <option value="Januari" selected>Januari</option>
            <option value="Februari">Februari</option>
            <option value="Maret">Maret</option>
            <option value="April">April</option>
            <option value="Mei">Mei</option>
            <option value="Juni">Juni</option>
            <option value="Juli">Juli</option>
            <option value="Juli">Juli</option>
            <option value="Agustus">Agustus</option>
            <option value="September">September</option>
            <option value="Oktober">Oktober</option>
            <option value="November">November</option>
            <option value="Desember">Desember</option>

        </select>
        </div>
        <div class="form-group">
          <label for="jumlah" class="col-form-label">Jumlah</label>
          <input type="text" class="form-control" id="jumlah" name="jumlah">
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