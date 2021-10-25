@extends('layouts.admin')
@section('title')
Koordinat Pelanggan
@endsection
@section('content')
<!-- Page Heading -->
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Data Produk</h1>
</div> -->
<!-- Content Row -->
<div class="row my-4">
   <div class="col-md-6">
      <div class="d-flex justify-content-start">
         <form class="form-inline">
            <div class="form-group">
               <label for="search" class="sr-only">NIPNAS</label>
               <input type="text" class="form-control" id="search" placeholder="Cari Data" name="nipnas">
               <button type="submit" data-target="#createModal" data-toggle="modal" class="btn btn-primary mx-3">Cari Pelanggan</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data BA SID Pelanggan</h6>
   </div>
   <div class="card-body">
      <div class="table-responsive">
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
                  <td>{{$item->nipnas}}</td>
                  <td>{{$item->nama_pelanggan}}</td>
                  <td>{{$item->email_pelanggan}}</td>
                  <td>{{$item->phone}}</td>
                  <td>{{$item->getAM->nama_user}}</td>
                  <td>{{$item->ba}}</td>
                  <td>{{$item->sid}}</td>
                  <td>{{$item->alamat}}</td>
                  <td class="text-center"> 
                     <button class="btn btn-primary" onclick="showLocation(<?php echo $item->latitude.','.$item->longitude ?>)">Show Location</button>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      {{ $models->appends(\Request::query())->links() }}
   </div>
</div>
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Lokasi Pelanggan</h6>
   </div>
   <div class="card-body">
      <div class="map-pelanggan" style="height: 800px;" id="map"></div>
   </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyANf2n0pvdETofIHeg2nssF8139ZJBvP2Y&sensor-false"></script>
<script>
   var locations = [
      <?php foreach($models as $key => $item){
         echo "['".$item->nama_pelanggan."', ".$item->latitude.", ".$item->longitude.",'".$item->alamat."','".$item->email_pelanggan."','".$item->nipnas."','".$item->ba."','".$item->sid."',],";
      } ?>
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(-8.409518, 115.188919),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
    });

    function showLocation(lat,long) {
      map.setZoom(18);
      map.setCenter({ lat: lat, lng: long });
      document.querySelector('.map-pelanggan').scrollIntoView({
        behavior: 'smooth'
      });
    }

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: '/marker.png',
      });

      infowindow = new google.maps.InfoWindow({
         content: " "
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
         //  infowindow.setContent(locations[i][0], locations[i][3]);
         infowindow.setContent('<p>NIPNAS: ' + locations[i][5] + '</p>' +
            '<p>Nama Pelanggan: ' + locations[i][0] + '</p>' +
            '<p>Email: ' + locations[i][4] + '</p>' +
            '<p>BA: ' + locations[i][6] + '</p>' +
            '<p>SID: ' + locations[i][7] + '</p>' +
            '<p>Alamat: ' + locations[i][3] + '</p>');
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
</script>
@endsection