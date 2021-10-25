@extends('layouts.admin')
@section('title')
BA SID Pelanggan
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
                  <form action="{{route('pelanggan.import')}}" method="POST" enctype="multipart/form-data">
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
         <a href="{{route('pelanggan.export')}}" class="btn btn-info mx-3"><i class='bx bxs-printer' ></i> Cetak Laporan</a>
         <div class="dropdown">
            <a class="btn btn-outline-secondary dropdown-toggle btn-filter" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class='bx bx-filter' ></i>
               Filter
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
               <a class="dropdown-item" href="{{route('pelanggan')}}">Default</a>
               <a class="dropdown-item" href="?orderasc=created_at">Tanggal</a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Content Row -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data BA SID Pelanggan</h6>
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
                  <th>NIPNAS</th>
                  <th>Pelanggan</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>AM</th>
                  <th>BA</th>
                  <th>SID</th>
                  <th>Alamat</th>
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
                  <td>{{$item->nipnas}}</td>
                  <td>{{$item->nama_pelanggan}}</td>
                  <td>{{$item->email_pelanggan}}</td>
                  <td>{{$item->phone}}</td>
                  <td>{{$item->getAM->nama_user}}</td>
                  <td>{{$item->ba}}</td>
                  <td>{{$item->sid}}</td>
                  <td>{{$item->alamat}}</td>
                  @if(Auth::user()->jabatan_id == 1)
                  <td class="text-center">
                     <a class="btn-table text-danger" href="" data-toggle="modal" data-target="#deleteModal-{{$item->nipnas}}"><i class='bx bxs-trash-alt'></i></a>
                     <a class="btn-table text-info" href="#" data-toggle="modal" data-target="#updateModal-{{$item->nipnas}}"><i class='bx bxs-edit' ></i></a>
                     <div class="modal fade" id="deleteModal-{{$item->nipnas}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">×</span>
                                 </button>
                              </div>
                              <div class="modal-body">Apakah anda yakin menghapus data "{{$item->nama_pelanggan}}"</div>
                              <div class="modal-footer">
                                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                 <form action="{{route('pelanggan.delete',$item->nipnas)}}" method="POST">
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
                     <div class="modal fade bd-example-modal-lg text-left" id="updateModal-{{$item->nipnas}}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="createModalLabel">Ubah Data</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                              </div>
                              <form action="{{route('pelanggan.update', $item->nipnas)}}" method="POST">
                              @csrf
                              @method('PUT')
                              <div class="modal-body">
                                 <div class="form-group">
                                    <label for="nipnas" class="col-form-label">NIPNAS</label>
                                    <input readonly type="text" class="form-control" id="nipnas" name="nipnas" value="{{$item->nipnas}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama_pelanggan" value="{{$item->nama_pelanggan}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="am" class="col-form-label">AM</label>
                                    <select name="user_id" id="am" class="form-control">
                                       @foreach($am as $key => $data)
                                       <option <?php if($data->id == $item->user_id) echo "selected" ?> value="{{$data->id}}">{{$data->nama_user}} (ID: {{$data->id}})</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="email" class="col-form-label">Email Pelanggan</label>
                                    <input type="email" class="form-control" id="email" name="email_pelanggan" value="{{$item->email_pelanggan}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="phone" class="col-form-label">Nomor Telepone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{$item->phone}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="ba" class="col-form-label">BA</label>
                                    <input type="text" class="form-control" id="ba" name="ba" value="{{$item->ba}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="sid" class="col-form-label">SID</label>
                                    <input type="text" class="form-control" id="sid" name="sid" value="{{$item->sid}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="alamat" class="col-form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{$item->alamat}}">
                                 </div>
                                 <div class="form-row">
                                    <div class="form-group col-md-6">
                                       <label for="latitude">Latitude</label>
                                       <input id="latitude" type="text" class="form-control latitude" name="latitude" value="{{$item->latitude}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="longitude">Longitude</label>
                                       <input id="longitude" type="text" class="form-control longitude" name="longitude" value="{{$item->longitude}}">
                                    </div>
                                 </div>
                                 <div class="map" id="map" style="height: 300px; border: 1px solid #000;"></div>
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
@include('admin.pelanggan.create')
@endif
@endsection
@section('script')
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyANf2n0pvdETofIHeg2nssF8139ZJBvP2Y&sensor-false"></script>
<script>
window.onload = function() {
    var newmap = document.getElementsByClassName('map');
    var dataUpdate = [
      <?php 
         foreach($models as $key => $item){
            echo "{
               lat: ".$item->latitude.",
               lng: ".$item->longitude.",
             },";
         }
      ?>
    ];
    var marker = [];
    var map = [];
      for (var i = 0; i < newmap.length; i++) {
         var latlng = new google.maps.LatLng(dataUpdate[i].lat, dataUpdate[i].lng);
         map[i] = new google.maps.Map(document.getElementsByClassName('map')[i], {
            center: latlng,
            zoom: 14,
            mapTypeId: google.maps.MapTypeId.ROADMAP
         });

         marker[i] = new google.maps.Marker({
            position: latlng,
            map: map[i],
            title: 'Set lat/lon values for this property',
            draggable: true
         });

         google.maps.event.addListener(marker[i], 'dragend', function(a) {
            console.log(a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4))

            var els=document.getElementsByClassName("latitude");
            for (var i=0;i<els.length;i++) {
                  els[i].value = a.latLng.lat().toFixed(4);
            }

            var els=document.getElementsByClassName("longitude");
            for (var i=0;i<els.length;i++) {
                  els[i].value = a.latLng.lng().toFixed(4);}
         });
      }

   var latlng2 = new google.maps.LatLng(-8.670458, 115.212631);
    var map2 = new google.maps.Map(document.getElementById('map-create'), {
        center: latlng2,
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var marker_2 = new google.maps.Marker({
        position: latlng2,
        map: map2,
        title: 'Set lat/lon values for this property',
        draggable: true
    });
    google.maps.event.addListener(marker_2, 'dragend', function(b) {
        console.log(b.latLng.lat().toFixed(4) + ', ' + b.latLng.lng().toFixed(4))

        document.getElementById("latitude-create").value = b.latLng.lat().toFixed(4);
        document.getElementById("longitude-create").value = b.latLng.lng().toFixed(4);
    });
};


</script>
@endsection