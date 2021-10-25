@extends('layouts.admin')
@section('title')
Monitoring Order
@endsection
@section('content')
<!-- Content Row -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Notification</h6>
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
                  <th>Pelanggan</th>
                  <th>Transaksi</th>
                  <th>Messages</th>
                  <th>Tanggal</th>
                  <th>Status</th>
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
                  <td>{{$item->getRequest->getPelanggan->nama_pelanggan}}</td>
                  <td>{{$item->getRequest->getTransaksi->keterangan}}</td>
                  <td>{{$item->getRequest->messages}}</td>
                  <td>{{date('d/m/Y', strtotime($item->getRequest->created_at))}}</td>
                  <td>
                     @if($item->getRequest->approve_status == 2)
                     <span class="badge badge-success">Berhasil</span>
                     @elseif($item->getRequest->approve_status == 3)
                     <span class="badge badge-danger">Ditolak</span>
                     @else
                     <span class="badge badge-warning">Request</span>
                     @endif
                  </td>
                  <td class="text-center">
                     @if(Auth::user()->jabatan_id == 1)
                     @if($item->read == 1)
                     <a href="{{route('notification.cancel', [$item->request_id, $item->user_id])}}" class="btn btn-danger">Tolak</a>
                     <a href="{{route('notification.approve', [$item->request_id, $item->user_id])}}" class="btn btn-success">Terima</a>
                     @else
                     <a href="#" class="btn btn-secondary disabled">Tolak</a>
                     <a href="#" class="btn btn-secondary disabled">Terima</a>
                     @endif
                     @else
                     @if($item->read == 1)
                     <a href="{{route('notification.read', $item->id)}}" class="btn btn-success">Read</a>
                     @else
                     <a href="#" class="btn btn-secondary disabled">Read</a>
                     @endif
                     @endif
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      {{ $models->appends(\Request::query())->links() }}
   </div>
</div>
@endsection
@section('script')
<script>
   function readNotification(id){
      $.ajax({
         type: "GET",
         url     : "notification/read/"+id,
         data: {
            "_token": "{{ csrf_token() }}"
        },
         success: function(msg){
            console.log( "Data Saved");
         }
      });
   }
   </script>
@endsection