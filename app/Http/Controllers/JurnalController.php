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

class JurnalController extends Controller
{
    protected $page = 'admin.jurnal.';
    protected $index = 'admin.jurnal.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_tgl_input_from = $request->get('tgl_input_from');

        $pemasukan = Pemasukan::isNotDeleted()->get();
        $pengeluaran = Pengeluaran::isNotDeleted()->get();
        $bayar = Bayar::isNotDeleted()->where("status_transaksi", 1)->get();

        $jum_keluar = DB::table("tb_pengeluaran")->get()->sum("jumlah");
        $jum_masuk = DB::table("tb_pemasukan")->get()->sum("jumlah");
        $jum_spp = Bayar::isNotDeleted()->where("status_transaksi", 1)->get()->sum("jumlah");

        $total = $jum_masuk+$jum_spp-$jum_keluar;

        if ($filter_tgl_input_from && $filter_tgl_input_to) {
            $pemasukan = $pemasukan->whereDate('created_at', '>=', $filter_tgl_input_from)->whereDate('created_at', '<=', $filter_tgl_input_to);
            $pengeluaran = $pengeluaran->whereDate('created_at', '>=', $filter_tgl_input_from)->whereDate('created_at', '<=', $filter_tgl_input_to);
            $bayar = $bayar->whereDate('created_at', '>=', $filter_tgl_input_from)->whereDate('created_at', '<=', $filter_tgl_input_to);
        }

        return view($this->index, compact('pemasukan', 'pengeluaran', 'bayar','total'));
    }


    public function export(){
        return Excel::download(new JurnalExport, 'report_jurnal_'.date('d_m_Y_H_i_s').'.xlsx');
    }
}
