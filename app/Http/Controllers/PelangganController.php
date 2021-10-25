<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Exports\PelangganExport;
use App\Imports\PelangganImport;
use Maatwebsite\Excel\Facades\Excel;

class PelangganController extends Controller
{
    protected $page = 'admin.pelanggan.';
    protected $index = 'admin.pelanggan.index';
    protected $validator;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->get('name');
        $orderasc = $request->get('orderasc');
        $orderdesc = $request->get('orderdesc');
        $models = Pelanggan::isNotDeleted();
        $am = User::isNotDeleted()->get();

        if ($name) {
            $models = $models->where('nama_pelanggan', 'like', '%' . $name . '%');
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
        return view($this->index, compact('models', 'am'));
    }

    public function koordinat(Request $request)
    {
        $nipnas = $request->get('nipnas');
        $models = Pelanggan::isNotDeleted();
        $am = User::isNotDeleted()->get();
        if ($nipnas) {
            $models = $models->where('nipnas', 'like', '%' . $nipnas . '%');
        }
        $models = $models->paginate(20);
        return view('admin.koordinat.index', compact('models', 'am'));
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
            'nipnas'            => 'required|unique:tb_pelanggan',
            'nama_pelanggan'    => 'required',
            'user_id'           => 'required',
            'ba'                => 'required',
            'email_pelanggan'   => 'required',
            'phone'             => 'required',
            'sid'               => 'required',
            'alamat'               => 'required',
        ],
        [
            'required'          => ':attribute is required.'
        ],
        [
            'nipnas'            => 'NIPNAS',
            'nama_pelanggan'    => 'Nama Pelanggan',
            'user_id'           => 'AM',
            'ba'                => 'BA',
            'email_pelanggan'   => 'Alamat Email',
            'phone'             => 'Nomor Telepon',
            'sid'               => 'SID',
            'alamat'            => 'Alamat',
        ]
        );

        $model = new Pelanggan();
        $model->nipnas = $request->nipnas;
        $model->nama_pelanggan = $request->nama_pelanggan;
        $model->email_pelanggan = $request->email_pelanggan;
        $model->user_id = $request->user_id;
        $model->ba = $request->ba;
        $model->sid = $request->sid;
        $model->alamat = $request->alamat;
        $model->phone = $request->phone;
        $model->latitude = $request->latitude;
        $model->longitude = $request->longitude;

        $model->save();

        return redirect()->route('pelanggan')->with('info', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nipnas)
    {
        $this->validate($request, 
        [
            'nama_pelanggan'    => 'required',
            'user_id'           => 'required',
            'ba'                => 'required',
            'email_pelanggan'   => 'required',
            'phone'             => 'required',
            'sid'               => 'required',
            'alamat'            => 'required',
        ],
        [
            'required'          => ':attribute is required.'
        ],
        [
            'nama_pelanggan'    => 'Nama Pelanggan',
            'user_id'           => 'AM',
            'ba'                => 'BA',
            'email_pelanggan'   => 'Alamat Email',
            'phone'             => 'Nomor Telepon',
            'sid'               => 'SID',
            'alamat'            => 'Alamat',
        ]
        );

        $model = Pelanggan::where('nipnas', $nipnas)->first();
        $model->nama_pelanggan = $request->nama_pelanggan;
        $model->email_pelanggan = $request->email_pelanggan;
        $model->user_id = $request->user_id;
        $model->ba = $request->ba;
        $model->sid = $request->sid;
        $model->phone = $request->phone;
        $model->alamat = $request->alamat;
        $model->latitude = $request->latitude;
        $model->longitude = $request->longitude;

        $model->save();

        return redirect()->route('pelanggan')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $nipnas)
    {
        $model = Pelanggan::findOrFail($nipnas);
        $model->status = Pelanggan::STATUS_DELETE;
        $model->save();
        return redirect()->route('pelanggan')->with('info', 'Berhasil menghapus data');
    }

    public function export(){
        return Excel::download(new PelangganExport, 'report_ba_sid_pelanggan_'.date('d_m_Y_H_i_s').'.xlsx');
    }

    public function import(Request $request) 
    {
            Excel::import(new PelangganImport, $request->file('file')->store('temp'));
            return back()->with('info', 'Berhasil Menambah data');

    }
}
