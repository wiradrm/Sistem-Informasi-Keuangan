@extends('layouts.admin')
@section('title')
Tarif Produk
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
         @endif
      </div>
   </div>
   <div class="col-md-6">
      <div class="d-flex justify-content-end">
         <a href="{{route('produk.export')}}" class="btn btn-info mx-3"><i class='bx bxs-printer' ></i> Cetak Laporan</a>
         <div class="dropdown">
            <a class="btn btn-outline-secondary dropdown-toggle btn-filter" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class='bx bx-filter' ></i>
               Filter
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
               <a class="dropdown-item" href="{{route('produk')}}">Default</a>
               <a class="dropdown-item" href="?orderasc=created_at">Tanggal</a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Content Row -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
   </div>
   <div class="card-body">
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
      <div class="row">
         @if($models->count() == 0)
            <p class="my-3 text-center w-100">No data</p> 
         @endif
         @foreach($models as $key => $item)
         <div class="col-md-4 mb-3">
            <div class="card">
            <img class="card-img-top" style="height: 200px; object-fit:cover;" src="https://www.telkom.co.id/images/replacement_img_horizontal.png" alt="Card image cap">
               <div class="card-body">
                  <h5 class="card-title">{{$item->nama_produk}}</h5>
                  <p class="card-text">Klik lihat produk untuk melihat lebih detail tentang produk ini</p>
                  <a href="#produk-{{$item->id}}" data-toggle="modal" class="btn btn-primary">Lihat Produk</a>
                  @if(Auth::user()->jabatan_id == 1)
                  <a href="#edit-produk-{{$item->id}}" data-toggle="modal" class="btn btn-success"><i class='bx bxs-edit' ></i></a>
                  <a href="#deleteModal-{{$item->id}}" data-toggle="modal" class="btn btn-warning"><i class='bx bxs-trash-alt'></i></a>
                  <div class="modal fade" id="deleteModal-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                              </button>
                           </div>
                           <div class="modal-body">Apakah anda yakin menghapus data "{{$item->nama_produk}}"</div>
                           <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                              <form action="{{route('produk.delete',$item->id)}}" method="POST">
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
                  @endif
               </div>
            </div>
         </div>
         @endforeach
      </div>
      {{ $models->appends(\Request::query())->links() }}
   </div>
</div>
@foreach($models as $key => $item)
<div class="modal fade bd-example-modal-lg" id="produk-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$item->nama_produk}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! $item->deskripsi !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bd-example-modal-lg" id="edit-produk-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('produk.update', $item->id)}}" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-body">
        <div class="form-group">
          <label for="nama" class="col-form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama_produk" value="{{$item->nama_produk}}">
        </div>
        <div class="form-group">
          <label for="deskripsi-text" class="col-form-label">Deskripsi</label>
          <textarea id="editor-{{$item->id}}" class="deskripsi-text" name="deskripsi">{{$item->deskripsi}}</textarea>
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
@endforeach
@if(Auth::user()->jabatan_id == 1)
@include('admin.produk.create')
@endif
@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
$(".deskripsi-text").each(function () {
   let id = $(this).attr('id');
   CKEDITOR.replace(id, {
      filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
   });
});
</script>
@endsection