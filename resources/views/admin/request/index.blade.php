@extends('layouts.admin')
@section('title')
Request Order
@endsection
@section('content')
<!-- Page Heading -->
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Data Produk</h1>
</div> -->
<div class="row my-4">
   <div class="col-md-6">
      <div class="d-flex justify-content-start">
         @if(Auth::user()->jabatan_id != 1)
         <button type="submit" data-target="#createModal" data-toggle="modal" class="btn btn-primary">Tambah Data</button>
         @endif
      </div>
   </div>
   <div class="col-md-6">
      <div class="d-flex justify-content-end">
         <a href="{{route('request.export')}}" class="btn btn-info mx-3"><i class='bx bxs-printer' ></i> Cetak Laporan</a>
         <div class="dropdown">
            <a class="btn btn-outline-secondary dropdown-toggle btn-filter" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class='bx bx-filter' ></i>
               Filter
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
               <a class="dropdown-item" href="{{route('am')}}">Default</a>
               <a class="dropdown-item" href="?orderasc=created_at">Tanggal</a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Content Row -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Request Order</h6>
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
                  <th>Pelanggan</th>
                  <th>Transaksi</th>
                  <th>Messages</th>
                  <th>Tanggal</th>
                  <th>Status</th>
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
                  <td>{{$item->getPelanggan->nama_pelanggan}}</td>
                  <td>{{$item->getTransaksi->keterangan}}</td>
                  <td>{{$item->messages}}</td>
                  <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
                  <td>
                     @if($item->approve_status == 2)
                     <span class="badge badge-success">Berhasil</span>
                     @elseif($item->approve_status == 3)
                     <span class="badge badge-danger">Ditolak</span>
                     @else
                     <span class="badge badge-warning">Request</span>
                     @endif
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      {{ $models->appends(\Request::query())->links() }}
   </div>
</div>
@if(Auth::user()->jabatan_id != 1)
@include('admin.request.create')
@endif
@endsection
@section('script')
<script>
   $('#filter_input_date').change(function(){
      $('#form_filter_input_date').submit();
   });

   $('#filter_input_ps').change(function(){
      $('#form_filter_input_ps').submit();
   });
</script>
@endsection