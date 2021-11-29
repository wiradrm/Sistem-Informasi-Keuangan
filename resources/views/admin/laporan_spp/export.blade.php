<html lang="en" dir="ltr">    
<table class="table table-striped">
    <thead>
        <tr>
            <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Keterangan</th>
            <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Pengeluaran</th>
            <th style="vertical-align : middle; text-align:center; font-weight: bold; background : #d9d9d9;">Pendapatan</th>
        </tr>
    </thead>
    <tbody>
      <tr>
         <td>Pendapatan Usaha</td>
         <td></td>
         <td>@currency(($pendapatan))</td>
      </tr>
      <tr>
         <td>Beban Pokok Pendapatan</td>
         <td></td>
         <td>-</td>
      </tr>
      <tr>
         <td><strong>Laba Bruto</strong></td>
         <td></td>
         <td><strong>@currency(($pendapatan))</strong></td>
      </tr>
      
      <tr>
         <td></td>
         <td></td>
         <td></td>
      </tr>
      <tr>
         <td>Biaya-biaya:</td>
         <td></td>
         <td></td>
      </tr>
      @foreach($pengeluaran as $key => $item)
      <tr>
         <td>{{$item->jenis_transaksi}}</td>
         <td>@currency($item->jumlah)</td>
         <td></td>
      </tr>
      @endforeach
      <tr>
         <td><strong>Total Beban</strong></td>
         <td></td>
         <td><strong>@currency($jum_keluar)</strong></td>
      </tr>
      <tr>
         <td><strong>Laba(Rugi)</strong></td>
         <td></td>
         <td><strong>@currency($total)</strong></td>
      </tr>
   </tbody>
</table>

</html>