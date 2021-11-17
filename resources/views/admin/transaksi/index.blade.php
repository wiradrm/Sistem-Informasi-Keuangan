@extends('layouts.admin')
@section('title')
Transaksi
@endsection
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Data Transaksi</h1>
</div> 


<!-- Content Row -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data</h6>
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
                  <th>Jumlah</th>
               </tr>
            </thead>
            <tbody>
               @foreach($pemasukan as $key => $item)
               <tr>
                  <td> <strong>{{date('d/m/Y', strtotime($item->created_at))}}</strong></td>
                  <td>{{$item->jenis_transaksi}}</td>
                  <td>@currency(($item->jumlah))</td>
               </tr>
               @endforeach
               @foreach($pengeluaran as $key => $item)
               <tr>
                  <td> <strong>{{date('d/m/Y', strtotime($item->created_at))}}</strong></td>
                  <td>{{$item->jenis_transaksi}}</td>
                  <td>@currency(($item->jumlah))</td>
               </tr>
               @endforeach
               @foreach($bayar as $key => $item)
               <tr>
                  <td> <strong>{{date('d/m/Y', strtotime($item->created_at))}}</strong></td>
                  <td>SPP</td>
                  <td>@currency(($item->jumlah))</td>
               </tr>
               @endforeach
               
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