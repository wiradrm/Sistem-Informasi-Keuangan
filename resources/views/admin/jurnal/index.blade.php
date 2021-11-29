@extends('layouts.admin')
@section('title')
Jurnal Umum
@endsection
@section('content')
<!-- Page Heading -->
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Data Produk</h1>
</div> -->
<div class="row mb-3">
   <div class="col-md-3">
      <form id="form_filter_input_ps">
         <div class="form-group">
            <label for="filter_input_from">Transaksi Dari</label>
            <input type="date" class="form-control mb-3" id="filter_input_ps_from" placeholder="Cari Data" name="tgl_ps_from">
         </div>
   </div>
   <div class="col-md-3">
         <div class="form-group">
            <label for="filter_input_from">Transaksi Sampai</label>
            <input type="date" class="form-control" id="filter_input_ps_to" placeholder="Cari Data" name="tgl_ps_to">
         </div>
      </form>
   </div>
   <div class="col-md-6">
      <div class="d-flex justify-content-end">
         <a href="{{route('jurnal.export')}}" class="btn btn-info mx-3"><i class='bx bxs-printer'></i> Cetak Laporan</a>
      </div>
   </div>
</div>

<!-- Content Row -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         @if (\Session::has('info'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! \Session::get('info') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         @endif
         @if ($errors->any())
         <div class="alert alert-danger">
            <ul class="my-0">
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
         @endif
         <table class="table table-striped" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Ref</th>
                  <th>Debit</th>
                  <th>Kredit</th>
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
      </div>
   </div>
</div>

@endsection
@section('script')
<script>
   $('#filter_input_date_to').change(function() {
      $('#form_filter_input_date').submit();
   });

   $('#filter_input_ps_to').change(function() {
      $('#form_filter_input_ps').submit();
   });
</script>
@endsection