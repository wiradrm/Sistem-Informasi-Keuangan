<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use DB;
use App\Bayar;
use App\SPP;
use App\Siswa;
use App\User;

use Illuminate\Http\Request;

use App\Exports\AMExport;
use App\Imports\BayarImport;
use Maatwebsite\Excel\Facades\Excel;

class BayarController extends Controller
{
    protected $page = 'admin.bayar.';
    protected $index = 'admin.bayar.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->get('name');

        $models = Bayar::isNotDeleted();

        if ($name) {
            $models = $models->where('nama_siswa', 'like', '%' . $name . '%');
        }

        $models = $models->paginate(20);

        return view($this->index, compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function update($id)
    {
        $model = Bayar::findOrFail($id);
        DB::table('tb_bayar')
              ->where('id', $id)
              ->update(['status_transaksi' => 1]);
        

        return redirect()->route('bayar')->with('info', 'Berhasil bayar data');
    }

    public function import(Request $request) 
    {
        Excel::import(new BayarImport, $request->file('file')->store('temp'));
        return back()->with('info', 'Berhasil menambah data');
    }
}
