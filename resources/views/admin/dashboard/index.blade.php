@extends('layouts.admin')
@section('title')
Dashboard
@endsection
@section('content')
<!-- Page Heading -->
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div> -->

<!-- Content Row -->
<p>Keuangan</p>
<div class="row">
    
    <div class="col-xl-4 col-md-4 mb-4">
        <a style="text-decoration: none !important;" href="/anggaran">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                        Saldo Awal</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">@currency($saldo_awal)</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-info-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>

    <div class="col-xl-4 col-md-4 mb-4">
        <a style="text-decoration: none !important;" href="/pemasukan">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                        Kas Masuk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">@currency($pemasukan)</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>

    <div class="col-xl-4 col-md-4 mb-4">
        <a style="text-decoration: none !important;" href="/pengeluaran">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Kas Keluar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">@currency($pengeluaran)</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Saldo Akhir</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">@currency($akhir)</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
</div>
<p>Data Sekolah</p>
<div class="row">
    
    <div class="col-xl-4 col-md-4 mb-4">
        <a style="text-decoration: none !important;" href="/guru">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                        Data Guru</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$guru}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>

    <div class="col-xl-4 col-md-4 mb-4">
        <a style="text-decoration: none !important;" href="/siswa">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                        Data Siswa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$siswa}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
    
    <div class="col-xl-4 col-md-4 mb-4">
        <a style="text-decoration: none !important;" href="/kelas">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Data Kelas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$kelas}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-building fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
</div>
<p>Foto Sekolah</p>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" height="550px" src="{{asset('assets/papan.jpg')}}"  alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" height="550px" src="{{asset('assets/halaman.jpg')}}"  alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" height="550px" src="{{asset('assets/kelas.jpg')}}"  alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
<!-- Content Row --> 
@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection