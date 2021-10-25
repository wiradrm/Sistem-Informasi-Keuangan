<div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('order.store')}}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tgl_ps" class="col-form-label">Tanggal Bilcom/PS</label>
                        <input type="date" class="form-control" id="tgl_ps" name="tgl_ps">
                    </div>
                    <div class="form-group">
                        <label for="transaksi" class="col-form-label">Transaksi</label>
                        <select name="transaksi_id" id="transaksi" class="form-control">
                            @foreach($transaksi as $key => $data)
                            <option value="{{$data->id}}">{{$data->keterangan}} ({{$data->transaksi}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="transaksi" class="col-form-label">Status Transaksi</label>
                        <select name="status_transaksi_id" id="transaksi" class="form-control">
                            @foreach($statustransaksi as $key => $data)
                            <option value="{{$data->id}}">{{$data->status_transaksi}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="am" class="col-form-label">AM</label>
                        <select name="user_id" id="am" class="form-control">
                            @foreach($am as $key => $data)
                            <option value="{{$data->id}}">{{$data->nama_user}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="am" class="col-form-label">Customer</label>
                        <select name="pelanggan_id" id="am" class="form-control">
                            @foreach($pelanggan as $key => $data)
                            <option value="{{$data->nipnas}}">{{$data->nama_pelanggan}}</option>
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