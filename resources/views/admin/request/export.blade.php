<html lang="en" dir="ltr">
<table class="table table-striped" >
<thead>
    <tr>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Pelanggan</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Transaksi</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Messages</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Tanggal</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Status</th>
    </tr>
</thead>
<tbody>
    @if($models->count() == 0)
        <tr>
            <td colspan="100%" align="center">
            No data
            </td>
        </tr>
    @endif
    @foreach($models as $key => $item)
    <tr>
        <td>{{$item->getPelanggan->nama_pelanggan}}</td>
        <td>{{$item->getTransaksi->keterangan}}</td>
        <td>{{$item->messages}}</td>
        <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
        <td>
            @if($item->approve_status == 2)
            <span class="badge badge-success">Berhasil</span>
            @elseif($item->approve_status == 3)
            <span class="badge badge-danger">Ditolak</span>
            @else
            <span class="badge badge-warning">Request</span>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
</table>
</html>