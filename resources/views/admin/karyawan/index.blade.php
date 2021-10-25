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
         @if(Auth::user()->jabatan_id == 1)
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
                  <form action="{{route('karyawan.import')}}" method="POST" enctype="multipart/form-data">
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
   <div class="col-md-6">
      <div class="d-flex justify-content-end">
         <a href="{{route('karyawan.export')}}" class="btn btn-info mx-3"><i class='bx bxs-printer' ></i> Cetak Laporan</a>
         <div class="dropdown">
            <a class="btn btn-outline-secondary dropdown-toggle btn-filter" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class='bx bx-filter' ></i>
               Filter
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
               <a class="dropdown-item" href="{{route('karyawan')}}">Default</a>
               <a class="dropdown-item" href="?orderasc=created_at">Tanggal</a>
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
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Kontak</th>
                  <th>Email</th>
                  @if(Auth::user()->jabatan_id == 1)
                  <th class="text-center">Action</th>
                  @endif
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
                  <td>{{$item->nik}}</td>
                  <td>{{$item->nama_user}} @if(Auth::user()->id == $item->id ) <span class="badge badge-success">Me</span>@endif</td>
                  <td>{{$item->getJabatan->jabatan}}</td>
                  <td>{{$item->phone}}</td>
                  <td>{{$item->email}}</td>
                  @if(Auth::user()->jabatan_id == 1)
                  <td class="text-center">
                     @if(Auth::user()->id != $item->id )
                        <a class="btn-table text-danger" href="" data-toggle="modal" data-target="#deleteModal-{{$item->id}}"><i class='bx bxs-trash-alt'></i></a>
                     @else
                        <a class="btn-table text-danger disabled" role="button" aria-disabled="true" style="cursor:not-allowed;" href="#"><i class='bx bxs-trash-alt'></i></a>
                     @endif
                     <a class="btn-table text-info" href="#" data-toggle="modal" data-target="#updateModal-{{$item->id}}"><i class='bx bxs-edit' ></i></a>
                     <div class="modal fade" id="deleteModal-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">×</span>
                                 </button>
                              </div>
                              <div class="modal-body">Apakah anda yakin menghapus data "{{$item->nama_user}}"</div>
                              <div class="modal-footer">
                                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                 <form action="{{route('karyawan.delete',$item->id)}}" method="POST">
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
                     <div class="modal fade bd-example-modal-lg text-left" id="updateModal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="createModalLabel">Ubah Data</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                              </div>
                              <form action="{{route('karyawan.update', $item->id)}}" method="POST">
                              @csrf
                              @method('PUT')
                              <div class="modal-body">
                                 <div class="form-group">
                                    <label for="nik" class="col-form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" value="{{$item->nik}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama_user" value="{{$item->nama_user}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="username" class="col-form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{$item->username}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="username" class="col-form-label">Email</label>
                                    <input type="email" class="form-control" id="nama" name="email" value="{{$item->email}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="phone" class="col-form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{$item->phone}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="jabatan" class="col-form-label">Jabatan</label>
                                    <select name="jabatan_id" class="form-control" id="jabatan">
                                       @foreach($jabatan as $row)
                                       <option value="{{$row->id}}" <?php if($item->jabatan_id == $row->id){echo "selected";} ?>>{{$row->jabatan}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="password" class="col-form-label">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" autocomplete="false">
                                 </div>
                                 <div class="form-group">
                                    <label for="password_confirmation" class="col-form-label">New Password Confirmation</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="false">
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
@if(Auth::user()->jabatan_id == 1)
@include('admin.karyawan.create')
@endif
@endsection