<?php

namespace App\Http\Controllers;

use DB;
use App\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PengeluaranController extends Controller
{
    protected $page = 'admin.pengeluaran.';
    protected $index = 'admin.pengeluaran.index';
    protected $validator;

    protected function validationData($request){
        $this->validator      = Validator::make(
            $request,
            [
                'jenis_transaksi'          => 'required',
            ],
            [
                'required'          => ':attribute is required.'
            ],
            [
                'jenis_transaksi'           => 'Pengeluaran',
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jenis_transaksi = $request->get('jenis_transaksi');
        $orderasc = $request->get('orderasc');
        $orderdesc = $request->get('orderdesc');
        $models = Pengeluaran::isNotDeleted();

        if ($jenis_transaksi) {
            $models = $models->where('jenis_transaksi', 'like', '%' . $jenis_transaksi . '%');
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
        // $this->validationData($request->all());
        // if ($this->validator->fails()) {
        //     return redirect()->route($this->back)->withInput($request->all())->withErrors($this->validator->errors());
        // }

        $model = new Pengeluaran();
        $model->jenis_transaksi = $request->jenis_transaksi;
        $model->jumlah = $request->jumlah;
        $model->save();
        return redirect()->route('pengeluaran')->with('info', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengeluaran  $Pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pengeluaran $Pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengeluaran  $Pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengeluaran $Pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengeluaran  $Pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_transaksi)
    {

        $model = Pengeluaran::findOrFail($id_transaksi);
        $model->jenis_transaksi = $request->jenis_transaksi;
        $model->jumlah = $request->jumlah;
        $model->save();
        return redirect()->route('pengeluaran')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengeluaran  $Pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_transaksi)
    {
      $model = Pengeluaran::findOrFail($id_transaksi);
      DB::table('tb_pengeluaran')->where('id_transaksi',$id_transaksi)->delete();

      return redirect()->route('pengeluaran')->with('info', 'Berhasil menghapus data');
    }
}
