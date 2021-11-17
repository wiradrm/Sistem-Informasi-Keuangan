<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Pemasukan;
use App\User;

use Illuminate\Http\Request;

use App\Exports\AMExport;
use App\Imports\AMImport;
use Maatwebsite\Excel\Facades\Excel;

class PemasukanController extends Controller
{
    protected $page = 'admin.pemasukan.';
    protected $index = 'admin.pemasukan.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->get('name');
        $models = Pemasukan::isNotDeleted();

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'pelanggan'                  => 'required',
            'product_id'                     => 'required',
            'progress'                      => 'required',
            'status_transaksi_id'           => 'required',
        ],
        [
            'required'          => ':attribute is required.'
        ],
        [
            'pelanggan'                  => 'Prospek',
            'product_id'                     => 'Layanan',
            'progress'                      => 'Progress',
            'status_transaksi_id'           => 'Status',
        ]
        );

        $model = new AM();
        $model->user_id = Auth::user()->id;
        $model->pelanggan = $request->pelanggan;
        $model->product_id = $request->product_id;
        $model->progress = $request->progress;
        $model->status_transaksi_id = $request->status_transaksi_id;
        $model->save();

        return redirect()->route('am')->with('info', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AM  $aM
     * @return \Illuminate\Http\Response
     */
    public function show(AM $aM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AM  $aM
     * @return \Illuminate\Http\Response
     */
    public function edit(AM $aM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AM  $aM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
        [
            'pelanggan'                  => 'required',
            'product_id'                     => 'required',
            'progress'                      => 'required',
            'status_transaksi_id'           => 'required',
        ],
        [
            'required'          => ':attribute is required.'
        ],
        [
            'pelanggan'                  => 'Prospek',
            'product_id'                     => 'Layanan',
            'progress'                      => 'Progress',
            'status_transaksi_id'           => 'Status',
        ]
        );

        $model = AM::findOrFail($id);
        $model->user_id = Auth::user()->id;
        $model->pelanggan = $request->pelanggan;
        $model->product_id = $request->product_id;
        $model->progress = $request->progress;
        $model->status_transaksi_id = $request->status_transaksi_id;
        $model->approval_status = 0;
        $model->save();

        return redirect()->route('am')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AM  $aM
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = AM::findOrFail($id);
        $model->status = AM::STATUS_DELETE;
        $model->save();
        return redirect()->route('am')->with('info', 'Berhasil menghapus data');
    }

    public function export(){
        return Excel::download(new AMExport, 'report_prospek_am_'.date('d_m_Y_H_i_s').'.xlsx');
    }

    public function import(Request $request) 
    {
        Excel::import(new AMImport, $request->file('file')->store('temp'));
        return back()->with('info', 'Berhasil menambah data');
    }
}
