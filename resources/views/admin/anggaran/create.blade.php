<div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('anggaran.store')}}" method="POST" autocomplete="off">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label for="jenis_anggaran" class="col-form-label">Jenis Anggaran</label>
          <select name="jenis_anggaran" id="jenis_anggaran" class="form-control">
            <option value="Pendapatan" selected>Pendapatan</option>
            <option value="Pengeluaran">Pengeluaran</option>
        </select>
        </div>
        <div class="form-group">
          <label for="anggaran" class="col-form-label">Nama Anggaran</label>
          <input type="text" class="form-control" id="anggaran" name="anggaran">
        </div>
        <div class="form-group">
          <label for="jumlah" class="col-form-label">Jumlah</label>
          <input type="text" class="form-control" id="masking1" name="jumlah">
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