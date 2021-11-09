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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$kelas}}</div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$siswa}}</div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$guru}}</div>
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