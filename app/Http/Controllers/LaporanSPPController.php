<?php

namespace App\Http\Controllers;

use DB;
use App\Spp;
use App\Bayar;

use App\Siswa;
use App\Pemasukan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\ModalExport;

use Maatwebsite\Excel\Facades\Excel;

class LaporanSPPController extends Controller
{
    protected $page = 'admin.laporan_spp.';
    protected $index = 'admin.laporan_spp.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->get('name');
        $sudah = DB::table('tb_bayar')
        ->Join('tb_siswa','tb_bayar.nisn','=','tb_siswa.nisn')
        ->where('status_transaksi',1)
        ->select('tb_siswa.nisn','nama_siswa',DB::raw('COUNT(status_transaksi) AS dibayar'),DB::raw('SUM(jumlah) AS total_dibayar'))
        ->groupBy('tb_siswa.nama_siswa','tb_bayar.nisn','tb_siswa.nisn')
        ->paginate(20);

        $belum = DB::table('tb_bayar')
        ->Join('tb_siswa','tb_bayar.nisn','=','tb_siswa.nisn')
        ->where('status_transaksi',0)
        ->select('tb_siswa.nisn','nama_siswa',DB::raw('COUNT(status_transaksi) AS tunggakan'),DB::raw('SUM(jumlah) AS jumlah_tunggakan'))
        ->groupBy('tb_siswa.nama_siswa','tb_bayar.nisn','tb_siswa.nisn')
        ->paginate(20);
        


        if ($name) {
            $sudah = $sudah->where('tb_siswa.nama_siswa', 'like', '%' . $name . '%');
            $belum = $belum->where('tb_siswa.nama_siswa', 'like', '%' . $name . '%');
        }


        return view($this->index, compact('sudah', 'belum'));
    }


    public function export(){
        return Excel::download(new ModalExport, 'report_modal_'.date('d_m_Y_H_i_s').'.xlsx');
    }
}
