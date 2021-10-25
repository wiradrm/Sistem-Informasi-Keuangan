<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Order;
use App\User;
use App\Pelanggan;
use App\Transaksi;
use App\StatusTransaksi;
use Illuminate\Http\Request;

use App\Exports\OrderExport;
use App\Imports\OrderImport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    protected $page = 'admin.order.';
    protected $index = 'admin.order.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_inputer = $request->get('inputer');
        $filter_am = $request->get('am');
        $filter_transaksi = $request->get('transaksi');
        $filter_status_transaksi = $request->get('status_transaksi');
        $filter_tgl_input = $request->get('tgl_input');
        $filter_tgl_ps = $request->get('tgl_ps');

        $orderasc = $request->get('orderasc');
        $orderdesc = $request->get('orderdesc');

        $models = Order::isNotDeleted();
        $am = User::isNotDeleted()->where('id', '!=', 1)->where('id', '!=', 9)->get();
        $pelanggan = Pelanggan::isNotDeleted()->get();
        $transaksi = Transaksi::isNotDeleted()->get();
        $statustransaksi = StatusTransaksi::isNotDeleted()->where('id', '!=', 6)->where('id', '!=', 7)->where('id', '!=', 8)->get();

        if ($filter_tgl_input) {
            $models = $models->where('created_at', 'like', '%' . $filter_tgl_input . '%');
        }

        if ($filter_tgl_ps) {
            $models = $models->where('tgl_ps', 'like', '%' . $filter_tgl_ps . '%');
        }

        if ($filter_inputer) {
            $models = $models->where('user_id', 'like', '%' . $filter_inputer . '%');
        }

        if ($filter_transaksi) {
            $models = $models->where('transaksi_id', 'like', '%' . $filter_transaksi . '%');
        }

        if ($filter_status_transaksi) {
            $models = $models->where('status_transaksi_id', 'like', '%' . $filter_status_transaksi . '%');
        }

        if ($filter_am) {
            $models = $models->where('user_id', 'like', '%' . $filter_am . '%');
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
        return view($this->index, compact('models', 'am', 'pelanggan', 'transaksi', 'statustransaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'tgl_ps'                    => 'required',
            'transaksi_id'              => 'required',
            'status_transaksi_id'       => 'required',
            'user_id'                   => 'required',
            'pelanggan_id'              => 'required',
        ],
        [
            'required'          => ':attribute is required.'
        ],
        [
            'tgl_ps'                    => 'Tanggal Bilcom/PS',
            'transaksi_id'              => 'Transaksi',
            'status_transaksi_id'       => 'Status Transaksi',
            'user_id'                   => 'AM',
            'pelanggan_id'              => 'Customer',
        ]
        );

        $model = new Order();
        $model->tgl_ps = $request->tgl_ps;
        $model->transaksi_id = $request->transaksi_id;
        $model->status_transaksi_id = $request->status_transaksi_id;
        $model->user_id = $request->user_id;
        $model->inputer_id = Auth::user()->id;
        $model->pelanggan_id = $request->pelanggan_id;
        $model->save();

        return redirect()->route('order')->with('info', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $order_id)
    {
        $this->validate($request, 
        [
            'created_at'                => 'required',
            'tgl_ps'                    => 'required',
            'transaksi_id'              => 'required',
            'status_transaksi_id'       => 'required',
            'user_id'                   => 'required',
            'pelanggan_id'              => 'required',
        ],
        [
            'required'          => ':attribute is required.'
        ],
        [
            'created_at'                => 'Tanggal Input',
            'tgl_ps'                    => 'Tanggal Bilcom/PS',
            'transaksi_id'              => 'Transaksi',
            'status_transaksi_id'       => 'Status Transaksi',
            'user_id'                   => 'AM',
            'pelanggan_id'              => 'Customer',
        ]
        );

        $model = Order::findOrFail($order_id);
        $model->tgl_ps = $request->tgl_ps;
        $model->transaksi_id = $request->transaksi_id;
        $model->status_transaksi_id = $request->status_transaksi_id;
        $model->user_id = $request->user_id;
        $model->inputer_id = Auth::user()->id;
        $model->pelanggan_id = $request->pelanggan_id;
        $model->save();

        return redirect()->route('order')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $order_id)
    {
        $model = Order::findOrFail($order_id);
        $model->status = Order::STATUS_DELETE;
        $model->save();
        return redirect()->route('order')->with('info', 'Berhasil menghapus data');
    }

    public function export(){
        return Excel::download(new OrderExport, 'report_monitoring_order_'.date('d_m_Y_H_i_s').'.xlsx');
    }

    public function import(Request $request) 
    {
        Excel::import(new OrderImport, $request->file('file')->store('temp'));
        return back()->with('info', 'Berhasil Menambah data');
    }
}
