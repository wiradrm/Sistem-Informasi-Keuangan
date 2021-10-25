@if(Auth::user()->jabatan_id != 1)
@php($data = App\Notification::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->where('type', 2)->take(5)->get())
@php($count = App\Notification::where('user_id', Auth::user()->id)->where('type', 2)->where('read', 1)->count())
@else
@php($data = App\Notification::orderBy('created_at', 'desc')->where('type', 1)->take(5)->get())
@php($count = App\Notification::where('type', 1)->where('read', 1)->count())
@endif
<!-- Nav Item - Alerts -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        @if($count != 0)
        <span class="badge badge-danger badge-counter">{{$count}}</span>
        @endif
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Alerts Center
        </h6>
        @if($data->count() == 0)
            <p class="small text-gray-500 text-center my-3">No data</p>
        @endif
        @foreach($data as $key => $item)
        <a class="dropdown-item d-flex align-items-center" href="{{route('notification')}}">
            <div class="mr-3">
                @if($item->status == 1)
                <div class="icon-circle bg-warning">
                    <i class="fas fa-file-alt text-white"></i>
                </div>
                @elseif($item->status == 3)
                <div class="icon-circle bg-danger">
                    <i class="fas fa-file-alt text-white"></i>
                </div>
                @else
                <div class="icon-circle bg-success">
                    <i class="fas fa-file-alt text-white"></i>
                </div>
                @endif
            </div>
            <div>
                <div class="small text-gray-500">{{ $item->created_at }}</div>
                <span class="@if($item->read == 1) font-weight-bold @endif">Request {{$item->getRequest->getTransaksi->keterangan}} unutk pelanggan {{$item->getRequest->getPelanggan->nama_pelanggan}}</span>
            </div>
        </a>
        @endforeach
        <a class="dropdown-item text-center small text-gray-500" href="{{route('notification')}}">Lihat Semua Notifikasi</a>
    </div>
</li>