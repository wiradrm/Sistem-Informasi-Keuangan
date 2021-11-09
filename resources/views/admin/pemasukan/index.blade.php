@extends('layouts.admin')
@section('title')
Prospek AM
@endsection
@section('content')
<!-- Page Heading -->
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Data Produk</h1>
</div> -->
<div class="row my-4">
   <div class="col-md-6">
      <div class="d-flex justify-content-start">
         @if(Auth::user()->jabatan_id != 1 && Auth::user()->jabatan_id != 9)
         <button type="submit" data-target="#createModal" data-toggle="modal" class="btn btn-primary">Tambah Data</button>
         <button type="submit" data-target="#importModal" data-toggle="modal" class="btn btn-success mx-3"><i class='bx bxs-file-import' ></i> Import Excel</button>
         <div class="modal fade bd-example-modal-lg text-left" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="createModalLabel">Import Data</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <form action="{{route('am.import')}}" method="POST" enctype="multipart/form-data">
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
         <a href="{{route('am.export')}}" class="btn btn-info mx-3"><i class='bx bxs-printer' ></i> Cetak Laporan</a>
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
<div class="row mb-3">
   <div class="col-md-3">
      <label>Status</label>
      <div class="dropdown">
         <a class="form-control dropdown-toggle select-filter" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Status
         </a>
         <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('am')}}">Default</a>
            @foreach($statustransaksi as $key => $item)
               <a class="dropdown-item" href="?status_transaksi={{$item->id}}">{{$item->status_transaksi}}</a>
            @endforeach
         </div>
      </div>
   </div>
</div>
<!-- Content Row -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Prospek AM</h6>
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
                  <th>AM</th>
                  <th>Prospek</th>
                  <th>Layanan</th>
                  <th>Progress</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  @if(Auth::user()->jabatan_id != 1 && Auth::user()->jabatan_id != 9)
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
                  <td>{{$item->getAM->nama_user}}</td>
                  <td>{{$item->pelanggan}}</td>
                  <td>{{$item->getProduk->nama_produk}}</td>
                  <td>{{$item->progress}}</td>
                  <td>{{$item->getStatusTransaksi->status_transaksi}}</td>
                  <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
                  @if(Auth::user()->jabatan_id != 1 && Auth::user()->jabatan_id != 9)
                  <td class="text-center">
                     <a class="btn-table text-danger" href="" data-toggle="modal" data-target="#deleteModal-{{$item->id}}"><i class='bx bxs-trash-alt'></i></a>
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
                              <div class="modal-body">Apakah anda yakin menghapus data "{{$item->getAM->nama_user}}"</div>
                              <div class="modal-footer">
                                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                 <form action="{{route('am.delete',$item->id)}}" method="POST">
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
                              <form action="{{route('am.update', $item->id)}}" method="POST">
                              @csrf
                              @method('PUT')
                              <div class="modal-body">
                                 <div class="form-group">
                                    <label for="pelanggan" class="col-form-label">Prospek</label>
                                    <input type="text" class="form-control" id="pelanggan" name="pelanggan" value="{{$item->pelanggan}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="product_id" class="col-form-label">Layanan</label>
                                    <select name="product_id" id="product_id" class="form-control">
                                       @foreach($produk as $key => $data)
                                       <option <?php if($data->id == $item->product_id) echo "selected" ?> value="{{$data->id}}">{{$data->nama_produk}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="progress" class="col-form-label">Progress</label>
                                    <input type="text" class="form-control" id="progress" name="progress" value="{{$item->progress}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="status_transaksi_id" class="col-form-label">Status Transaksi</label>
                                    <select name="status_transaksi_id" id="status_transaksi_id" class="form-control">
                                       @foreach($statustransaksi as $key => $data)
                                       <option <?php if($data->id == $item->status_transaksi_id) echo "selected" ?> value="{{$data->id}}">{{$data->status_transaksi}}</option>
                                       @endforeach
                                    </select>
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
@if(Auth::user()->jabatan_id != 1 && Auth::user()->jabatan_id != 9)
@include('admin.am.create')
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