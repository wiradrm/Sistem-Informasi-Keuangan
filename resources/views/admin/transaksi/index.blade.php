@extends('layouts.admin')
@section('title')
Transaksi
@endsection
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Data Transaksi</h1>
</div> 


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
   {{-- <div class="col-md-3">
      <label>Status</label>
      <div class="dropdown">
         <a class="form-control dropdown-toggle select-filter" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Status
         </a>
         <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('bayar')}}">Default</a>
            <a class="dropdown-item" href="?status=0">Belum Bayar</a>
            <a class="dropdown-item" href="?status=1">Sudah Bayar</a>
         </div>
      </div>
   </div> --}}
</div>


<!-- Content Row -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Kas Masuk <span class="iconify" data-icon="bx:bxs-down-arrow" style="color: #007267;"></span></h6>
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
            <h5>SPP</h5>
            <thead>
               <tr>
                  <th>Tanggal</th>
                  <th>Oleh</th>
                  <th>Jumlah</th>
               </tr>
            </thead>
            <tbody>
               @if($bayar->count() == 0)
                  <tr>
                     <td colspan="100%" align="center">
                           No data
                     </td>
                  </tr>
               @endif
               @foreach($bayar as $key => $item)
               <tr>
                  <td> <strong>{{date('d/m/Y', strtotime($item->created_at))}}</strong></td>
                  <td>{{$item->getSiswa->nama_siswa}}</td>
                  <td>@currency(($item->jumlah))</td>
               </tr>
               @endforeach
               
            </tbody>
         </table>
         <table class="table table-striped" width="100%" cellspacing="0">
            <h5>Kas Masuk Lainnya</h5>
            <thead>
               <tr>
                  <th>Tanggal</th>
                  <th>Transaksi</th>
                  <th>Jumlah</th>
               </tr>
            </thead>
            <tbody>
               @if($pemasukan->count() == 0)
                  <tr>
                     <td colspan="100%" align="center">
                           No data
                     </td>
                  </tr>
               @endif
               @foreach($pemasukan as $key => $item)
               <tr>
                  <td> <strong>{{date('d/m/Y', strtotime($item->created_at))}}</strong></td>
                  <td>{{$item->jenis_transaksi}}</td>
                  <td>@currency(($item->jumlah))</td>
               </tr>
               @endforeach
               
            </tbody>
         </table>



        
      </div>
   </div>
</div>


<!-- Content Row -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Kas Keluar <span class="iconify" data-icon="bx:bxs-up-arrow" style="color: #d60e18;"></span></h6>
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
                  <th>Transaksi</th>
                  <th>Jumlah</th>
               </tr>
            </thead>
            <tbody>
               @if($pengeluaran->count() == 0)
                  <tr>
                     <td colspan="100%" align="center">
                           No data
                     </td>
                  </tr>
               @endif
               @foreach($pengeluaran as $key => $item)
               <tr>
                  <td> <strong>{{date('d/m/Y', strtotime($item->created_at))}}</strong></td>
                  <td>{{$item->jenis_transaksi}}</td>
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