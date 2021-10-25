<html lang="en" dir="ltr">
<table class="table table-striped">
<thead>
    <tr>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Tanggal Input</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Tanggal Bilcom/PS</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Transaksi</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Status</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">AM/AM PRO/SP</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Inputer</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Customer</th>
    </tr>
</thead>
<tbody>
    @foreach($models as $key => $item)
    <tr>
        <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
        <td>{{date('d/m/Y', strtotime($item->tgl_ps))}}</td>
        <td>{{$item->getTransaksi->keterangan}} ({{$item->getTransaksi->transaksi}})</td>
        <td>{{$item->getStatusTransaksi->status_transaksi}}</td>
        <td>{{$item->getAM->nama_user}}</td>
        <td>{{$item->getInputer->nama_user}}</td>
        <td>{{$item->getPelanggan->nama_pelanggan}}</td>
    </tr>
    @endforeach
</tbody>
</table>
</html>