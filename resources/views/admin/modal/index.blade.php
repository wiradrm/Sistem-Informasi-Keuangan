@extends('layouts.admin')
@section('title')
Laporan Modal
@endsection
@section('content')
<!-- Page Heading -->
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Data Produk</h1>
</div> -->
<div class="row mb-3">
   <div class="col-md-3">
      <form id="form_filter_input_ps">
         <div class="form-group">
            <label for="filter_input_from">Laporan Dari</label>
            <input type="date" class="form-control mb-3" id="filter_input_ps_from" placeholder="Cari Data" name="tgl_ps_from">
         </div>
   </div>
   <div class="col-md-3">
         <div class="form-group">
            <label for="filter_input_from">Sampai</label>
            <input type="date" class="form-control" id="filter_input_ps_to" placeholder="Cari Data" name="tgl_ps_to">
         </div>
      </form>
   </div>
   <div class="col-md-6">
      <div class="d-flex justify-content-end">
         <a href="{{route('modal.export')}}" class="btn btn-info mx-3"><i class='bx bxs-printer'></i> Cetak Laporan</a>
      </div>
   </div>
</div>

<!-- Content Row -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
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
                  <th>Keterangan</th>
                  <th>Pengeluaran</th>
                  <th>Pendapatan</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Pendapatan Usaha</td>
                  <td></td>
                  <td>@currency(($pendapatan))</td>
               </tr>
               <tr>
                  <td>Beban Pokok Pendapatan</td>
                  <td></td>
                  <td>-</td>
               </tr>
               <tr>
                  <td><strong>Laba Bruto</strong></td>
                  <td></td>
                  <td><strong>@currency(($pendapatan))</strong></td>
               </tr>
               
               <tr>
                  <td></td>
                  <td></td>
                  <td></td>
               </tr>
               <tr>
                  <td>Biaya-biaya:</td>
                  <td></td>
                  <td></td>
               </tr>
               @foreach($pengeluaran as $key => $item)
               <tr>
                  <td>{{$item->jenis_transaksi}}</td>
                  <td>@currency($item->jumlah)</td>
                  <td></td>
               </tr>
               @endforeach
               <tr>
                  <td><strong>Total Beban</strong></td>
                  <td></td>
                  <td><strong>@currency($jum_keluar)</strong></td>
               </tr>
               <tr>
                  <td><strong>Laba(Rugi)</strong></td>
                  <td></td>
                  <td><strong>@currency($total)</strong></td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</div>

@endsection
@section('script')
<script>
   $('#filter_input_date_to').change(function() {
      $('#form_filter_input_date').submit();
   });

   $('#filter_input_ps_to').change(function() {
      $('#form_filter_input_ps').submit();
   });
</script>
@endsection