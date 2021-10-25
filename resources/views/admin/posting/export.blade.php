<html lang="en" dir="ltr">
<table class="table table-striped">
<thead>
    <tr>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Judul</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Tanggal</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Kegiatan</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Pelanggan</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">AM</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Dokumentasi</th>
    </tr>
</thead>
<tbody>
    @foreach($models as $key => $item)
    <tr>
        <td>{{$item->nama_kegiatan}}</td>
        <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
        <td>{{$item->keterangan}}</td>
        <td>{{$item->getPelanggan->nama_pelanggan}}</td>
        <td>{{$item->getAM->nama_user}}</td>
        <td align="center"><img width="100" src="{{ public_path().'/img/post/'.$item->img }}"></td>
    </tr>
    @endforeach
</tbody>
</table>
</html>