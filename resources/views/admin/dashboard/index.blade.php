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
<div class="row">

    <div class="col-xl-4 col-md-4 mb-4">
        <a style="text-decoration: none !important;" href="/order?status_transaksi=1">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        Transaksi Belum di Input</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countPending}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>

    <div class="col-xl-4 col-md-4 mb-4">
        <a style="text-decoration: none !important;" href="/order?status_transaksi=2">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Transaksi Sedang Diproses</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countProgress}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>

    <div class="col-xl-4 col-md-4 mb-4">
        <a style="text-decoration: none !important;" href="/order?status_transaksi=4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Transaksi Berhasil</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countSuccess}}</div>
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
<!-- Content Row --> 
<div class="row">
<!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row my-5">
    <div class="col-md-4">
        <div class="team-card">
            <img src="{{asset('assets/1.jpg')}}" alt="AM TEAM">
            <div class="team-content">
            AM TEAM
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="team-card">
            <img src="{{asset('assets/2.jpg')}}" alt="SALES PRO TEAM">
            <div class="team-content">
            SALES PRO TEAM
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="team-card">
            <img src="{{asset('assets/3.jpg')}}" alt="EOS & INPUTER TEAM">
            <div class="team-content">
            EOS & INPUTER TEAM
            </div>
        </div>
    </div>
</div>
<div class="row my-5">
    @foreach($models as $key => $item)
    <div class="col-md-4">
        <div class="card">
            <img class="card-img-top" style="height: 300px; object-fit:cover" src="{{$item->getImage()}}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{$item->nama_kegiatan}}</h5>
                <p class="card-text">
                    Kegiatan : {{$item->keterangan}} <br>
                    Pelanggan : {{$item->getPelanggan->nama_pelanggan}} <br>
                    AM : {{$item->getAM->nama_user}} <br>
                    Tanggal : {{date('d/m/Y', strtotime($item->created_at))}} <br>
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $models->appends(\Request::query())->links() }}
@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if(Auth::user()->jabatan_id == 1)
<script>
    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
        {
            label: "Belum Diinput",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(235, 77, 75, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(235, 77, 75, 1)",
            pointBorderColor: "rgba(235, 77, 75, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(235, 77, 75, 1)",
            pointHoverBorderColor: "rgba(235, 77, 75, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [<?php foreach($chartPending as $key => $item) echo $item.",";?>],
        },
        {
            label: "Sedang Diproses",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(246, 194, 62, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(246, 194, 62, 1)",
            pointBorderColor: "rgba(246, 194, 62, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(246, 194, 62, 1)",
            pointHoverBorderColor: "rgba(246, 194, 62, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [<?php foreach($chartProgress as $key => $item) echo $item.",";?>],
        },
        {
            label: "Berhasil",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(28, 200, 138, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(28, 200, 138, 1)",
            pointBorderColor: "rgba(28, 200, 138, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(28, 200, 138, 1)",
            pointHoverBorderColor: "rgba(28, 200, 138, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [
                <?php foreach($chartSuccess as $key => $item) echo $item.",";?>
            ],
        },
    ],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
        padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
        }
        },
        scales: {
        xAxes: [{
            time: {
            unit: 'date'
            },
            gridLines: {
            display: false,
            drawBorder: false
            },
            ticks: {
            maxTicksLimit: 7
            }
        }],
        yAxes: [{
            ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
                return '$' + number_format(value);
            }
            },
            gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
            }
        }],
        },
        legend: {
        display: false
        },
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
            label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
            }
        }
        }
    }
    });

    $(".deskripsi-text").each(function () {
        let id = $(this).attr('id');
        CKEDITOR.replace(id, {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    });
</script>
@else
<script>
    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
        {
            label: "Prospek Ditolak",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(235, 77, 75, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(235, 77, 75, 1)",
            pointBorderColor: "rgba(235, 77, 75, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(235, 77, 75, 1)",
            pointHoverBorderColor: "rgba(235, 77, 75, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [<?php foreach($chartPending as $key => $item) echo $item.",";?>],
        },
        {
            label: "Prospek Sedang Proses",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(246, 194, 62, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(246, 194, 62, 1)",
            pointBorderColor: "rgba(246, 194, 62, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(246, 194, 62, 1)",
            pointHoverBorderColor: "rgba(246, 194, 62, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [<?php foreach($chartProgress as $key => $item) echo $item.",";?>],
        },
        {
            label: "Prospek Berhasil",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(28, 200, 138, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(28, 200, 138, 1)",
            pointBorderColor: "rgba(28, 200, 138, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(28, 200, 138, 1)",
            pointHoverBorderColor: "rgba(28, 200, 138, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [
                <?php foreach($chartSuccess as $key => $item) echo $item.",";?>
            ],
        },
    ],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
        padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
        }
        },
        scales: {
        xAxes: [{
            time: {
            unit: 'date'
            },
            gridLines: {
            display: false,
            drawBorder: false
            },
            ticks: {
            maxTicksLimit: 7
            }
        }],
        yAxes: [{
            ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
                return '$' + number_format(value);
            }
            },
            gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
            }
        }],
        },
        legend: {
        display: false
        },
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
            label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
            }
        }
        }
    }
    });

    $(".deskripsi-text").each(function () {
        let id = $(this).attr('id');
        CKEDITOR.replace(id, {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    });
</script>
@endif
@endsection