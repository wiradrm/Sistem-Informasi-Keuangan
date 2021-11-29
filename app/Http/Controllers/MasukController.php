<?php

namespace App\Http\Controllers;

use DB;
use App\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MasukController extends Controller
{
    protected $page = 'admin.pemasukan.';
    protected $index = 'admin.pemasukan.index';
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
                'jenis_transaksi'           => 'Pemasukan',
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
        $models = Pemasukan::isNotDeleted();

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

        $model = new Pemasukan();
        $model->jenis_transaksi = $request->jenis_transaksi;
        $model->jumlah = $request->jumlah;
        $model->save();
        return redirect()->route('pemasukan')->with('info', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pemasukan  $Pemasukan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemasukan $Pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pemasukan  $Pemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemasukan $Pemasukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pemasukan  $Pemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validationData($request->all());
        // if ($this->validator->fails()) {
        //     return redirect()->route($this->back)->withInput($request->all())->withErrors($this->validator->errors());
        // }

        $model = Pemasukan::findOrFail($id);
        $model->jenis_transaksi = $request->jenis_transaksi;
        $model->jumlah = $request->jumlah;
        $model->save();
        return redirect()->route('pemasukan')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pemasukan  $Pemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $model = Pemasukan::findOrFail($id);
      DB::table('tb_pemasukan')->where('id',$id)->delete();

      return redirect()->route('pemasukan')->with('info', 'Berhasil menghapus data');
    }
}
