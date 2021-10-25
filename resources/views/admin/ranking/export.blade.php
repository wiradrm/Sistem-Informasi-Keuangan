<html lang="en" dir="ltr">
<table class="table table-striped">
<thead>
    <tr>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">#</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">NIK</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Nama</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Jabatan</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Kontak</th>
        <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Point</th>
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
        <td>{{$key + 1}}</td>
        <td>{{$item->nik}}</td>
        <td>{{$item->nama_user}} @if(Auth::user()->id == $item->id ) <span class="badge badge-success">Me</span>@endif</td>
        <td>{{$item->getJabatan->jabatan}}</td>
        <td>{{$item->phone}}</td>
        <td>{{$prospek->where('user_id', $item->id)->where('approval_status', 1)->count()}}</td>
    </tr>
    @endforeach
</tbody>
</table>
</html>