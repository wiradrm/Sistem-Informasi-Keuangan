<html lang="en" dir="ltr">
<table class="table table-striped">
<thead>
    <tr>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">NIPNAS</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Pelanggan</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Email</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Phone</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">AM</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">BA</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">SID</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Alamat</th>
    </tr>
</thead>
<tbody>
    @foreach($models as $key => $item)
    <tr>
    <td>{{$item->nipnas}}</td>
    <td>{{$item->nama_pelanggan}}</td>
    <td>{{$item->email_pelanggan}}</td>
    <td>{{$item->phone}}</td>
    <td>{{$item->getAM->nama_user}}</td>
    <td>{{$item->ba}}</td>
    <td>{{$item->sid}}</td>
    <td>{{$item->alamat}}</td>
    </tr>
    @endforeach
</tbody>
</table>
</html>