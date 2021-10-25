<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\AM;
use App\User;
use App\Pelanggan;
use App\Transaksi;
use App\StatusTransaksi;
use App\Produk;
use App\Notification;

use Illuminate\Http\Request;

use App\Exports\AMExport;
use App\Imports\AMImport;
use Maatwebsite\Excel\Facades\Excel;

class AMController extends Controller
{
    protected $page = 'admin.am.';
    protected $index = 'admin.am.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_status_transaksi = $request->get('status_transaksi');

        $orderasc = $request->get('orderasc');
        $orderdesc = $request->get('orderdesc');

        if (Auth::user()->jabatan_id == 1 || Auth::user()->jabatan_id == 9) {
            $models = AM::isNotDeleted();
        } else {
            $models = AM::isNotDeleted()->where('user_id', Auth::user()->id);
        }
        $pelanggan = Pelanggan::isNotDeleted()->where('user_id', Auth::user()->id)->get();
        $transaksi = Transaksi::isNotDeleted()->get();
        $produk = Produk::isNotDeleted()->get();
        $statustransaksi = StatusTransaksi::isNotDeleted()->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 5)->get();

        if ($filter_status_transaksi) {
            $models = $models->where('status_transaksi_id', 'like', '%' . $filter_status_transaksi . '%');
        }
        if ($orderasc) {
            $models = $models->orderBy($orderasc, 'asc');
        } 
        if ($orderdesc) {
            $models = $models->orderBy($orderdesc, 'desc');
        } else {
            $models = $models->orderBy('created_at', 'desc');
        }

        $models = $models->paginate(20);
        return view($this->index, compact('models', 'pelanggan', 'statustransaksi', 'produk'));
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
