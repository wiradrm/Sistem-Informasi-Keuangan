<html lang="en" dir="ltr">
<table class="table table-striped">
    <thead>
        <tr>
            <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Nama</th>
        </tr>
    </thead>
    <tbody>
        @foreach($models as $key => $item)
        <tr>
            <td>{{ $item->nama_produk }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</html>