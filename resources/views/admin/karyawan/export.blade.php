<html lang="en" dir="ltr">
<table class="table table-striped">
<thead>
    <tr>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">NIK</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Nama</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Jabatan</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Kontak</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Email</th>
    </tr>
</thead>
<tbody>
    @foreach($models as $key => $item)
    <tr>
        <td>{{$item->nik}}</td>
        <td>{{$item->nama_user}}</td>
        <td>{{$item->getJabatan->jabatan}}</td>
        <td>{{$item->phone}}</td>
        <td>{{$item->email}}</td>
    </tr>
    @endforeach
</tbody>
</table>
</html>