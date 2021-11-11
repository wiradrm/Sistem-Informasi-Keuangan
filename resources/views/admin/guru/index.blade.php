@extends('layouts.admin')
@section('title')
Data Guru
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
         @if(Auth::user()->akses_id == 2)
         <button type="submit" data-target="#createModal" data-toggle="modal" class="btn btn-primary mx-3">Tambah Data</button>
         <button type="submit" data-target="#importModal" data-toggle="modal" class="btn btn-success"><i class='bx bxs-file-import' ></i> Import Excel</button>
         <div class="modal fade bd-example-modal-lg text-left" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="createModalLabel">Import Data</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <form action="{{route('guru.import')}}" method="POST" enctype="multipart/form-data">
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
         </div>
         @endif
      </div>
   </div>
   {{-- <div class="col-md-6">
      <div class="d-flex justify-content-end">
         <a href="{{route('guru.export')}}" class="btn btn-info"><i class='bx bxs-printer' ></i> Cetak Laporan</a>
      </div>
   </div> --}}
</div>
<!-- Content Row -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
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
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Mata Pelajaran</th>
                  <th class="text-center">Action</th>
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
                  <td>{{$item->nip}}</td>
                  <td>{{$item->nama_guru}}</td>
                  <td>{{$item->jenis_kelamin}}</td>
                  <td>{{$item->mapel}}</td>
                  @if(Auth::user()->akses_id == 2)
                  <td class="text-center">
                     <a class="btn-table text-danger" href="" data-toggle="modal" data-target="#deleteModal-{{$item->guru_id}}"><i class='bx bxs-trash-alt'></i></a>
                     <a class="btn-table text-info" href="#" data-toggle="modal" data-target="#updateModal-{{$item->guru_id}}"><i class='bx bxs-edit' ></i></a>
                     <div class="modal fade" id="deleteModal-{{$item->guru_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">×</span>
                                 </button>
                              </div>
                              <div class="modal-body">Apakah anda yakin menghapus data "{{$item->nama_guru}}"</div>
                              <div class="modal-footer">
                                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                 <form action="{{route('guru.delete',$item->guru_id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">
                                       Hapus
                                    </button>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal fade bd-example-modal-lg text-left" id="updateModal-{{$item->guru_id}}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="createModalLabel">Ubah Data</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                              </div>
                              <form action="{{route('guru.update', $item->guru_id)}}" method="POST">
                              @csrf
                              @method('PUT')
                              <div class="modal-body">
                                 <input type="text" hidden class="form-control" id="guru_id" name="guru_id" value="{{$item->guru_id}}">
                                 <div class="form-group">
                                    <label for="nip" class="col-form-label">NIP</label>
                                    <input type="text" class="form-control" id="nip" name="nip" value="{{$item->nip}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="nama_guru" class="col-form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="{{$item->nama_guru}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin</label>
                                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="{{$item->jenis_kelamin}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="mapel" class="col-form-label">Mata Pelajaran</label>
                                    <input type="text" class="form-control" id="mapel" name="mapel" value="{{$item->mapel}}">
                                 </div>
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </td>
                  @endif
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      {{ $models->appends(\Request::query())->links() }}
   </div>
</div>
@if(Auth::user()->akses_id == 2)
@include('admin.guru.create')
@endif
@endsection