@extends('layouts.admin')
@section('title')
Laporan Modal
@endsection
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Data Laporan Pembayaran SPP</h1>
</div>
{{-- <div class="row my-4">
   <div class="col-md-6">
      <div class="d-flex justify-content-start">
         <form class="form-inline">
            <div class="form-group">
               <label for="search" class="sr-only">Search</label>
               <input type="text" class="form-control" id="search" placeholder="Cari Siswa" name="name">
            </div>
         </form>
      </div>
   </div>
</div> --}}
<!-- Content Row -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-success">Sudah Bayar</h6>
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
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Bayar</th>
                  <th>Total Dibayar</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($sudah as $key => $item)
                   <tr>
                     <td>{{$item->nisn}}</td>
                      <td>{{$item->nama_siswa}}</td>
                      
                     <td>{{$item->dibayar}} Bulan</td>
                     <td>+@currency($item->total_dibayar)</td>
                   </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>

<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-danger">Belum Dibayar</h6>
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
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Tunggakan</th>
                  <th>Total Tunggakan</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($belum as $key => $item)
                   <tr>
                     <td>{{$item->nama_siswa}}</td>
                      <td>{{$item->nama_siswa}}</td>
                     <td>{{$item->tunggakan}} Bulan</td>
                     <td>-@currency($item->jumlah_tunggakan)</td>
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