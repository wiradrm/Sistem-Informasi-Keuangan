@extends('layouts.admin')
@section('title')
Data Pembayaran SPP
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
               <input type="text" class="form-control" id="search" placeholder="Cari Data Nama" name="nama">
            </div>
         </form>
         
         @if(Auth::user()->akses_id == 2)
         {{-- <button type="submit" data-target="#createModal" data-toggle="modal" class="btn btn-primary mx-3">Tambah Data</button> --}}
         {{-- <button type="submit" data-target="#importModal" data-toggle="modal" class="btn btn-success"><i class='bx bxs-file-import' ></i> Import Excel</button>
         <div class="modal fade bd-example-modal-lg text-left" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="createModalLabel">Import Data</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <form action="{{route('bayar.import')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                     <div class="input-group mb-3">
                        <div class="custom-file">
                           <input type="file" name="file" class="custom-file-input" id="inputGroupFile02" required>
                           <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  </form>
               </div>
            </div>
            
         </div> --}}
         @endif
      </div>
   </div>
</div>
<div class="row mb-3">
   <div class="col-md-3">
      <label>Bulan</label>
      <div class="dropdown">
         <a class="form-control dropdown-toggle select-filter" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Bulan
         </a>
         <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('bayar')}}">Default</a>
            <a class="dropdown-item" href="?bulan=Oktober">Oktober</a>
            <a class="dropdown-item" href="?bulan=November">November</a>
            <a class="dropdown-item" href="?bulan=Desember">Desember</a>
         </div>
      </div>
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
      <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran SPP</h6>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         @if (\Session::has('info') || \Session::has('error'))
            @if(\Session::has('info'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            @endif
            @if(\Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @endif
               {!! \Session::get('info') !!}
               {!! \Session::get('error') !!}
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
                  <th>Kode SPP</th>
                  <th>Bulan</th>
                  <th>Jumlah Bayar</th>
                  <th>Status Transaksi</th>
                  @if(Auth::user()->akses_id == 2)
                  <th class="text-center">Action</th>
                  @endif
               </tr>
            </thead>
            <tbody>
               @if(  $models->count() == 0)
                  <tr>
                     <td colspan="100%" align="center">
                           No data
                     </td>
                  </tr>
               @endif
               @foreach(  $models as $key => $item)
               <tr>
                  <td>{{$item->nisn}}</td>
                  <td>{{$item->getSiswa->nama_siswa}}</td>
                  <td>{{$item->kode_spp}}</td>
                  <td>{{$item->bulan}}</td>
                  <td>{{$item->jumlah}}</td>
                  
                  @if ($item->status_transaksi == 0)
                      <td> <span class="badge-point bg-warning">Belum Bayar</span></td>
                      <td class="text-center">
                        <a class="btn btn-danger" href="" data-toggle="modal" data-target="#updateModal-{{$item->id}}">Bayar</a>
                        <div class="modal fade" id="updateModal-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Bayar SPP</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">"{{$item->getSiswa->nama_siswa}}" melakukan pembayaran SPP pada bulan {{$item->bulan}}, sudah benar?</div>
                                 <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <form action="{{route('bayar.update',$item->id)}}" method="POST">
                                       @csrf
                                       @method('POST')
                                       <button type="submit" class="btn btn-primary">
                                          Bayar
                                       </button>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </td>
                  @else
                       <td> <span class="badge-point bg-success">Sudah Bayar</span></td>
                       <td class="text-center">
                        <a class="btn btn-warning" href="" data-toggle="modal" data-target="#updateModal-{{$item->id}}">Edit</a>
                        <div class="modal fade" id="updateModal-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pembayaran</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">"Mengedit data pembayaran SPP {{$item->getSiswa->nama_siswa}} pada bulan {{$item->bulan}} menjadi belum bayar", yakin?</div>
                                 <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <form action="{{route('bayar.edit',$item->id)}}" method="POST">
                                       @csrf
                                       @method('POST')
                                       <button type="submit" class="btn btn-primary">
                                          Edit
                                       </button>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </td> 
                  @endif
                  
                  
                  @if($item->status_transaksi != 1)
                  
                  @endif
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      {{  $models->appends(\Request::query())->links() }}
   </div>
</div>
@if(Auth::user()->akses_id == 2)
@endif
@endsection