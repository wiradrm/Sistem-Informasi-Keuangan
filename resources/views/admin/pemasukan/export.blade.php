<html lang="en" dir="ltr">
<table class="table table-striped" >
<thead>
    <tr>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">AM</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Prospek</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Layanan</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Progress</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Status</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Tanggal</th>
    </tr>
</thead>
<tbody>
    @foreach($models as $key => $item)
    <tr>
        <td>{{$item->getAM->nama_user}}</td>
        <td>{{$item->pelanggan}}</td>
        <td>{{$item->getProduk->nama_produk}}</td>
        <td>{{$item->progress}}</td>
        <td>{{$item->getStatusTransaksi->status_transaksi}}</td>
        <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
    </tr>
    @endforeach
</tbody>
</table>
</html>