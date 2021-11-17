<?php

namespace App\Http\Controllers;

use DB;
use App\Spp;
use App\Bayar;

use App\Pengeluaran;
use App\Pemasukan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\JurnalExport;

use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    protected $page = 'admin.transaksi.';
    protected $index = 'admin.transaksi.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $pemasukan = Pemasukan::isNotDeleted()->get();
        $pengeluaran = Pengeluaran::isNotDeleted()->get();
        $bayar = Bayar::isNotDeleted()->where("status_transaksi", 1)->get();

        $jum_keluar = DB::table("tb_pengeluaran")->get()->sum("jumlah");
        $jum_masuk = DB::table("tb_pemasukan")->get()->sum("jumlah");
        $jum_spp = Bayar::isNotDeleted()->where("status_transaksi", 1)->get()->sum("jumlah");

        $total = $jum_keluar+$jum_masuk+$jum_spp;


        return view($this->index, compact('pemasukan', 'pengeluaran', 'bayar'));
    }


    public function export(){
        return Excel::download(new JurnalExport, 'report_jurnal_'.date('d_m_Y_H_i_s').'.xlsx');
    }
}
