@php($editakses = App\Akses::isNotDeleted()->get())
@php($profile = App\User::isNotDeleted()->where('id', Auth::user()->id)->first())
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>@yield('title') - Business Service Telkom Denpasar</title>
      <!-- Custom fonts for this template-->
      <link href="/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
      <!-- Custom styles for this template-->
      <link href="/admin/css/sb-admin-2.css" rel="stylesheet">
      <link href="/admin/css/style.css" rel="stylesheet">
      <link rel="shortcut icon" href="{{asset('icon.png')}}" type="image/x-icon">
   </head>
   <body id="page-top">
      <!-- Page Wrapper -->
      <div id="wrapper">
         <!-- Sidebar -->
         <ul class="navbar-nav bg-red sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
               <img src="{{asset('assets/logo_horizontal.svg')}}" class="d-xs-none img-fluid" alt="Logo">
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
               <a class="nav-link" href="{{route('dashboard')}}">
               <i class='bx bxs-bar-chart-alt-2'></i>
               <span>Home</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            @if(Auth::user()->jabatan_id != 9)
            <li class="nav-item {{ Request::routeIs('produk') ? 'active' : '' }}">
               <a class="nav-link" href="{{route('produk')}}">
               <i class='bx bxs-dashboard' ></i>
               <span>Produk</span></a>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item {{ Request::routeIs('pelanggan', 'karyawan') ? 'active' : '' }}">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
               <i class='bx bxs-receipt' ></i>
               <span>Data Mapping</span>
               </a>
               <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <h6 class="collapse-header">Data Mapping:</h6>
                     <a class="collapse-item" href="{{route('pelanggan')}}">BA SID Pelanggan</a>
                     <a class="collapse-item" href="{{route('karyawan')}}">Data Karyawan</a>
                  </div>
               </div>
            </li>
            <!-- Nav Item - Charts -->
            @endif
            <li class="nav-item {{ Request::routeIs('order') ? 'active' : '' }}">
               <a class="nav-link" href="{{route('order')}}">
               <i class='bx bxs-file-blank' ></i>
               <span>Monitor Order</span></a>
            </li>
            <li class="nav-item {{ Request::routeIs('am') ? 'active' : '' }}">
               <a class="nav-link" href="{{route('am')}}">
               <i class='bx bxs-receipt' ></i>
               <span>Prospek AM</span></a>
            </li>
            @if(Auth::user()->jabatan_id != 9 && Auth::user()->jabatan_id != 1)
            <li class="nav-item {{ Request::routeIs('request') ? 'active' : '' }}">
               <a class="nav-link" href="{{route('request')}}">
               <i class='bx bxs-receipt' ></i>
               <span>Request Order</span></a>
            </li>
            <li class="nav-item {{ Request::routeIs('posting') ? 'active' : '' }}">
               <a class="nav-link" href="{{route('posting')}}">
               <i class='bx bxs-file' ></i>
               <span>Posting Kegiatan</span></a>
            </li> 
            @endif
            @if(Auth::user()->jabatan_id == 9)
            <li class="nav-item {{ Request::routeIs('ranking') ? 'active' : '' }}">
               <a class="nav-link" href="{{route('ranking')}}">
               <i class='bx bx-trophy'></i>
               <span>Karyawan Aktif</span></a>
            </li> 
            @endif
            <li class="nav-item {{ Request::routeIs('koordinat') ? 'active' : '' }}">
               <a class="nav-link" href="{{route('koordinat')}}">
               <i class='bx bxs-map' ></i>
               <span>Koordinat</span></a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
         </ul>
         <!-- End of Sidebar -->
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
               <!-- Topbar -->
               <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                  <!-- Sidebar Toggle (Topbar) -->
                  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
                  </button>
                  <!-- Topbar Navbar -->
                  <ul class="navbar-nav ml-auto">
                     {{-- @include('admin.notification.notification') --}}
                     <div class="topbar-divider d-none d-sm-block"></div>
                     <!-- Nav Item - User Information -->
                     <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama_user }}</span>
                        <img class="img-profile rounded-circle" src="https://ui-avatars.com/api/?background=eb4d4b&color=ffffff&name={{ Auth::user()->nama_user }}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editProfileModal">
                           <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                           Profile
                           </a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                           <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                           Logout
                           </a>
                        </div>
                     </li>
                  </ul>
               </nav>
               <!-- End of Topbar -->
               <!-- Begin Page Content -->
               <div class="container-fluid">
                  @yield('content')
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
               <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                     <span>Copyright &copy; Maria Letticia 2021</span>
                  </div>
               </div>
            </footer>
            <!-- End of Footer -->
         </div>
         <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
      </a>
      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade bd-example-modal-lg text-left" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
               <h5 class="modal-title" id="createModalLabel">Ubah Data</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               </div>
               <form action="{{route('profile.update', Auth::user()->id)}}" method="POST">
               @csrf
               @method('PUT')
               <div class="modal-body">
                  <div class="form-group">
                     <label for="nik" class="col-form-label">NIK</label>
                     <input type="text" class="form-control" id="nik" name="nik" value="{{ $profile->nik }}">
                  </div>
                  <div class="form-group">
                     <label for="nama" class="col-form-label">Nama</label>
                     <input type="text" class="form-control" id="nama" name="nama_user" value="{{ $profile->nama_user }}">
                  </div>
                  <div class="form-group">
                     <label for="username" class="col-form-label">Username</label>
                     <input type="text" class="form-control" id="username" name="username" value="{{ $profile->username }}">
                  </div>
                  <div class="form-group">
                     <label for="username" class="col-form-label">Email</label>
                     <input type="email" class="form-control" id="nama" name="email" value="{{ $profile->email }}">
                  </div>
                  <div class="form-group">
                     <label for="phone" class="col-form-label">Phone</label>
                     <input type="text" class="form-control" id="phone" name="phone" value="{{ $profile->phone }}">
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
      <!-- Bootstrap core JavaScript-->
      <script src="/admin/vendor/jquery/jquery.min.js"></script>
      <script src="/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="/admin/js/sb-admin-2.min.js"></script>
      <script src="https://unpkg.com/boxicons@2.0.9/dist/boxicons.js"></script>
      @yield('script')
   </body>
</html>