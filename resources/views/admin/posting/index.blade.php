@extends('layouts.admin')
@section('title')
Posting Kegiatan
@endsection
@section('content')
<div class="row my-4">
   <div class="col-md-6">
      <div class="d-flex justify-content-start">
         <form class="form-inline">
            <div class="form-group">
               <label for="search" class="sr-only">Search</label>
               <input type="text" class="form-control" id="search" placeholder="Cari Data" name="name">
            </div>
         </form>
         <button type="submit" data-target="#createModal" data-toggle="modal" class="btn btn-primary mx-3">Tambah Data</button>
      </div>
   </div>
   <div class="col-md-6">
      <div class="d-flex justify-content-end">
         <a href="{{route('posting.export')}}" class="btn btn-info mx-3"><i class='bx bxs-printer' ></i> Cetak Laporan</a>
         <div class="dropdown">
            <a class="btn btn-outline-secondary dropdown-toggle btn-filter" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class='bx bx-filter' ></i>
               Filter
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
               <a class="dropdown-item" href="{{route('posting')}}">Default</a>
               <a class="dropdown-item" href="?orderasc=created_at">Tanggal</a>
            </div>
         </div>
      </div>
   </div>
</div>
<hr>
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
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Kegiatan</h6>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-striped" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>Judul</th>
                  <th>Tanggal</th>
                  <th>Kegiatan</th>
                  <th>Pelanggan</th>
                  <th>AM</th>
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
                  <td>{{$item->nama_kegiatan}}</td>
                  <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
                  <td>{{$item->keterangan}}</td>
                  <td>{{$item->getPelanggan->nama_pelanggan}}</td>
                  <td>{{$item->getAM->nama_user}}</td>
                  <td class="text-center">
                     <a class="btn-table text-danger" href="" data-toggle="modal" data-target="#deleteModal-{{$item->id}}"><i class='bx bxs-trash-alt'></i></a>
                     <a class="btn-table text-primary" href="#" data-toggle="modal" data-target="#updateModal-{{$item->id}}"><i class='bx bxs-edit' ></i></a>
                     <div class="modal fade" id="deleteModal-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">×</span>
                                 </button>
                              </div>
                              <div class="modal-body">Apakah anda yakin menghapus data "{{$item->nama_kegiatan}}"</div>
                              <div class="modal-footer">
                                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                 <form action="{{route('posting.delete',$item->id)}}" method="POST">
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
                                 <form action="{{route('posting.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                                 @csrf
                                 @method('PUT')
                                 <div class="modal-body">
                                 <div class="form-group">
                                 <label for="nama" class="col-form-label">Nama Kegiatan</label>
                                 <input type="text" class="form-control" id="nama" name="nama_kegiatan" value="{{$item->nama_kegiatan}}">
                                 </div>
                                 <div class="form-group">
                                 <label for="deskripsi-text" class="col-form-label">Kegiatan</label>
                                 <textarea class="form-control" name="keterangan" rows="8">{{$item->keterangan}}</textarea>
                                 </div>
                                 <div class="form-group">
                                    <label for="pelanggan_id" class="col-form-label">Customer</label>
                                    <select name="pelanggan_id" id="pelanggan_id" class="form-control">
                                          @foreach($pelanggan as $key => $data)
                                          <option <?php if($data->nipnas == $item->pelanggan_id) echo "selected" ?> value="{{$data->nipnas}}">{{$data->nama_pelanggan}}</option>
                                          @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-form-label">Dokumentasi</label>
                                    <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="inputGroupFile01" name="img">
                                          <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                 </div>
                                 <img src="{{$item->getImage()}}" width="500" alt="{{$item->nama_kegiatan}}">
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
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      {{ $models->appends(\Request::query())->links() }}
   </div>
</div>
@include('admin.posting.create')
@endsection