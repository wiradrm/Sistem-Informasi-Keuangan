<?php

namespace App\Http\Controllers;
use App\RequestOrder;
use App\Pelanggan;
use App\Transaksi;
use App\Notification;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Exports\RequestExport;
use Maatwebsite\Excel\Facades\Excel;

class RequestController extends Controller
{
    protected $page = 'admin.request.';
    protected $index = 'admin.request.index';

    public function index(Request $request)
    {
        $name = $request->get('name');
        $orderasc = $request->get('orderasc');
        $orderdesc = $request->get('orderdesc');
        $models = RequestOrder::isNotDeleted();
        $pelanggan = Pelanggan::isNotDeleted()->where('user_id', Auth::user()->id)->get();
        $transaksi = Transaksi::isNotDeleted()->where('id', '!=', 1)->get();

        if ($name) {
            $models = $models->where('nama_produk', 'like', '%' . $name . '%');
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
        return view($this->index, compact('models','pelanggan','transaksi'));
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
            'pelanggan_id'                    => 'required',
            'transaksi_id'              => 'required',
            'messages'       => 'required',
        ],
        [
            'required'          => ':attribute is required.'
        ],
        [
            'pelanggan_id'                    => 'Nama Pelanggan',
            'transaksi_id'              => 'Transaksi',
            'messages'       => 'Messages',
        ]
        );

        $model = new RequestOrder();
        $model->pelanggan_id = $request->pelanggan_id;
        $model->user_id = Auth::user()->id;
        $model->transaksi_id = $request->transaksi_id;
        $model->messages = $request->messages;

        $model->save();

        $notif = new Notification();
        if(Auth::user()->id != 1){
            $notif->type = 1;
        } else {
            $notif->type = 2;
        }

        $notif->user_id = Auth::user()->id;
        $notif->request_id = $model->id;
        $notif->save();

        return redirect()->route('request')->with('info', 'Berhasil menambah data');
    }

    public function export(){
        return Excel::download(new RequestExport, 'report_request_order_'.date('d_m_Y_H_i_s').'.xlsx');
    }
}
