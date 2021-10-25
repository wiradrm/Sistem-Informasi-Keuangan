@extends('layouts.admin')
@section('title')
Karyawan
@endsection
@section('content')
<!-- Page Heading -->
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Data Produk</h1>
</div> -->
<div class="row my-4">
   <div class="col-md-6">
      <div class="d-flex justify-content-start">
         <form class="form-inline">
            <div class="form-group">
               <label for="search" class="sr-only">Search</label>
               <input type="text" class="form-control" id="search" placeholder="Cari Data" name="name">
            </div>
         </form>
      </div>
   </div>
   <div class="col-md-6">
      <div class="d-flex justify-content-end">
         <a href="{{route('ranking.export')}}" class="btn btn-info mx-3"><i class='bx bxs-printer' ></i> Cetak Laporan</a>
         <div class="dropdown">
            <a class="btn btn-outline-secondary dropdown-toggle btn-filter" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class='bx bx-filter' ></i>
               Filter
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
               <a class="dropdown-item" href="{{route('ranking')}}">Default</a>
               <a class="dropdown-item" href="?orderasc=1">Tertinggi</a>
               <a class="dropdown-item" href="?orderdesc=1">Terendah</a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Content Row -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Karyawan</h6>
   </div>
   <div class="card-body">
      <div class="table-responsive">
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
                  <th>#</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Kontak</th>
                  <th>Point</th>
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
                  @if($count->where('user_id', $item->id)->where('status_transaksi_id', 3)->count() >= 10)
                     <td><?php echo $count->where('user_id', $item->id)->where('status_transaksi_id', 3)->count(); ?> <span class="badge-point bg-warning">Gold</span></td>
                  @elseif($count->where('user_id', $item->id)->where('status_transaksi_id', 3)->count() >= 5)
                     <td><?php echo $count->where('user_id', $item->id)->where('status_transaksi_id', 3)->count(); ?> <span class="badge-point bg-success">Platinum</span></td>
                  @elseif($count->where('user_id', $item->id)->where('status_transaksi_id', 3)->count() >= 3)
                     <td><?php echo $count->where('user_id', $item->id)->where('status_transaksi_id', 3)->count(); ?> <span class="badge-point bg-secondary">Bronze</span></td>
                  @else
                     <td><span> <?php echo $count->where('user_id', $item->id)->where('status_transaksi_id', 3)->count(); ?></span></td>
                  @endif
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      {{ $models->appends(\Request::query())->links() }}
   </div>
</div>
@endsection