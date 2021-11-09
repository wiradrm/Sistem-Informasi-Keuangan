<div class="modal fade bd-example-modal-lg text-left" id="createModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Ubah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('am.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pelanggan" class="col-form-label">Prospek</label>
                        <input type="text" class="form-control" id="pelanggan" name="pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="product_id" class="col-form-label">Layanan</label>
                        <select name="product_id" id="product_id" class="form-control">
                            @foreach($produk as $key => $data)
                            <option value="{{$data->id}}">{{$data->nama_produk}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="progress" class="col-form-label">Progress</label>
                        <input type="text" class="form-control" id="progress" name="progress">
                    </div>
                    <div class="form-group">
                        <label for="status_transaksi_id" class="col-form-label">Status Transaksi</label>
                        <select name="status_transaksi_id" id="status_transaksi_id" class="form-control">
                            @foreach($statustransaksi as $key => $data)
                            <option value="{{$data->id}}">{{$data->status_transaksi}}</option>
                            @endforeach
                        </select>
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