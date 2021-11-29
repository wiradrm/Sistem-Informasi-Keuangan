<html lang="en" dir="ltr">    
<table class="table table-striped">
    <thead>
        <tr>
            <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Tanggal</th>
            <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Keterangan</th>
            <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Ref</th>
            <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Debit</th>
            <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Kredit</th>
        </tr>
    </thead>
    <tbody>
      @php
          $in = 201;
      @endphp
      @foreach($pemasukan as $key => $item)
      <tr>
         <td> <strong>{{date('d/m/Y', strtotime($item->created_at))}}</strong></td>
         <td>Kas</td>
         <td>101</td>
         <td>@currency($item->jumlah)</td>
         <td>-</td>
      </tr>
      <tr>
         <td></td>
         <td>{{$item->jenis_transaksi}}</td>
         <td>{{$in}}</td>
         <td>-</td>
         <td>@currency($item->jumlah)</td>
      </tr>
      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
      @php
          $in++
      @endphp
      @endforeach

      @php
          $out = 301;
      @endphp
      @foreach($pengeluaran as $key => $item)
      <tr>
         <td> <strong>{{date('d/m/Y', strtotime($item->created_at))}}</strong></td>
         <td>{{$item->jenis_transaksi}}</td>
         <td>{{$out}}</td>
         <td>@currency($item->jumlah)</td>
         <td>-</td>
      </tr>
      <tr>
         <td></td>
         <td>Kas</td>
         <td>101</td>
         <td>-</td>
         <td>@currency($item->jumlah)</td>
      </tr>
      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
      @php
          $out++
      @endphp
      @endforeach
      @foreach($bayar as $key => $item)
      <tr>
         <td> <strong>{{date('d/m/Y', strtotime($item->created_at))}}</strong></td>
         <td>Kas</td>
         <td>101</td>
         <td>@currency($item->jumlah)</td>
         <td>-</td>
      </tr>
      <tr>
         <td></td>
         <td>SPP</td>
         <td>102</td>
         <td>-</td>
         <td>@currency($item->jumlah)</td>
      </tr>
      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
      @endforeach
      <tr>
         <td></td>
         <td></td>
         <td><strong>Total</strong></td>
         <td>@currency($total)</td>
         <td>@currency($total)</td>
      </tr>
   </tbody>
</table>

</html>