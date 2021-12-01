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
use DateTime;

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
        $filter_tgl_input_from = $request->get('tgl_ps_from');
        $filter_tgl_input_to = $request->get('tgl_ps_to');
        



        $data_pemasukan = Pemasukan::isNotDeleted()->get();
        $data_pengeluaran = Pengeluaran::isNotDeleted()->get();
        $data_bayar = Bayar::isNotDeleted()->where("status_transaksi", 1)->get();

        $pemasukan = $data_pemasukan;
        $pengeluaran = $data_pengeluaran;
        $bayar = $data_bayar;

        
        if ($filter_tgl_input_from && $filter_tgl_input_to) {

            $pemasukan = Pemasukan::isNotDeleted()->whereDate('created_at', '>=', $filter_tgl_input_from)->whereDate('created_at', '<=', $filter_tgl_input_to)->get();
            $pengeluaran = Pengeluaran::isNotDeleted()->whereDate('created_at', '>=', $filter_tgl_input_from)->whereDate('created_at', '<=', $filter_tgl_input_to)->get();
            $bayar = Bayar::isNotDeleted()->where("status_transaksi", 1)->whereDate('created_at', '>=', $filter_tgl_input_from)->whereDate('created_at', '<=', $filter_tgl_input_to)->get();

        }
        
        $jum_keluar = $pengeluaran->sum("jumlah");
        $jum_masuk = $pemasukan->sum("jumlah");
        $jum_spp = $bayar->sum("jumlah");
        
        $total = $jum_masuk+$jum_spp-$jum_keluar;
        

        return view($this->index, compact('pemasukan', 'pengeluaran', 'bayar','total'));
    }


    public function export(){
        return Excel::download(new JurnalExport, 'report_jurnal_'.date('d_m_Y_H_i_s').'.xlsx');
    }
}
