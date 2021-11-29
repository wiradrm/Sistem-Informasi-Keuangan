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
          <select name="angkatan" id="angkatan" class="form-control">
            @php
                for($i=0;$i<=8;$i++){
                  $year=date('Y',strtotime("last day of -$i year"));
                
                  echo "<option name='$year'>$year</option>";
                }
            @endphp  
          </select>
        </div>
        <div class="form-group">
          <label for="jumlah_bayar" class="col-form-label">Jumlah</label>
          <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar">
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