<?php

namespace App\Http\Controllers;

use DB;
use App\Spp;
use App\Bayar;

use App\Pengeluaran;
use App\Pemasukan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\ModalExport;

use Maatwebsite\Excel\Facades\Excel;

class ModalController extends Controller
{
    protected $page = 'admin.modal.';
    protected $index = 'admin.modal.index';

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
            $pemasukan = $pemasukan->where('created_at', '>=', $filter_tgl_input_from,'&&','created_at', '<=', $filter_tgl_input_to);
            $pengeluaran = $pengeluaran->where('created_at', '>=', $filter_tgl_input_from,'&&','created_at', '<=', $filter_tgl_input_to);
            $bayar = $bayar->where('created_at', '>=', $filter_tgl_input_from,'&&','created_at', '<=', $filter_tgl_input_to);
        }
        
        $jum_keluar = $pengeluaran->sum("jumlah");
        $jum_masuk = $pemasukan->sum("jumlah");
        $jum_spp = $bayar->sum("jumlah");
        
        $pendapatan = $jum_masuk+$jum_spp;
        $total = $jum_masuk+$jum_spp-$jum_keluar;

        return view($this->index, compact('pemasukan', 'jum_keluar', 'pengeluaran', 'bayar', 'total','pendapatan'));
    }


    public function export(){
        return Excel::download(new ModalExport, 'report_modal_'.date('d_m_Y_H_i_s').'.xlsx');
    }
}
