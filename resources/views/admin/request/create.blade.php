<div class="modal fade bd-example-modal-lg text-left" id="createModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="createModalLabel">Ubah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{route('request.store')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                <label for="pelanggan_id" class="col-form-label">Pelanggan</label>
                <select name="pelanggan_id" id="pelanggan_id" class="form-control">
                    @foreach($pelanggan as $key => $data)
                    <option value="{{$data->nipnas}}">{{$data->nama_pelanggan}}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                    <label for="transaksi_id" class="col-form-label">Transaksi</label>
                    <select name="transaksi_id" id="transaksi_id" class="form-control">
                        @foreach($transaksi as $key => $data)
                        <option value="{{$data->id}}">{{$data->keterangan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="messages" class="col-form-label">Messages</label>
                    <textarea id="messages" class="form-control" cols="30" name="messages" rows="10"></textarea>
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