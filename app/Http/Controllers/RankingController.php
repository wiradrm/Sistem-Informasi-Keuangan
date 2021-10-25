<?php

namespace App\Http\Controllers;
use App\User;
use App\AM;
use App\Exports\RankingExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class RankingController extends Controller
{
    protected $page = 'admin.ranking.';
    protected $index = 'admin.ranking.index';

    public function index(Request $request)
    {
        $name = $request->get('name');
        $orderasc = $request->get('orderasc');
        $orderdesc = $request->get('orderdesc');

        $models = User::isNotDeleted()->where('jabatan_id', '!=', '1')->where('jabatan_id', '!=', '9')->withCount('getPoint');
        
        if ($name) {
            $models = $models->where('nama_user', 'like', '%' . $name . '%');
        }        
        if ($orderasc) {
            $models = $models->orderBy('get_point_count', 'desc');
        } 
        if ($orderdesc) {
            $models = $models->orderBy('get_point_count', 'asc');
        } else {
            $models = $models->orderBy('get_point_count', 'desc');
        }

        $models = $models->paginate(20);

        $count = AM::isNotDeleted()->get();
        return view($this->index, compact('models', 'count'));
    }

    public function export(){
        return Excel::download(new RankingExport, 'report_karyawan_aktif_'.date('d_m_Y_H_i_s').'.xlsx');
    }
}
