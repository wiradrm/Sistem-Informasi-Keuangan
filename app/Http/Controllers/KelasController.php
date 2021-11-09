<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Exports\ProdukExport;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller
{
    protected $page = 'admin.produk.';
    protected $index = 'admin.produk.index';
    protected $validator;

    protected function validationData($request){
        $this->validator      = Validator::make(
            $request,
            [
                'nama_produk'          => 'required',
            ],
            [
                'required'          => ':attribute is required.'
            ],
            [
                'nama_produk'           => 'Nama Produk',
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
        $name = $request->get('name');
        $orderasc = $request->get('orderasc');
        $orderdesc = $request->get('orderdesc');
        $models = Produk::isNotDeleted();

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

        $model = new Produk();
        $model->nama_produk = $request->nama_produk;
        $model->deskripsi = $request->deskripsi;
        $model->save();
        return redirect()->route('produk')->with('info', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validationData($request->all());
        // if ($this->validator->fails()) {
        //     return redirect()->route($this->back)->withInput($request->all())->withErrors($this->validator->errors());
        // }

        $model = Produk::findOrFail($id);
        $model->nama_produk = $request->nama_produk;
        $model->deskripsi = $request->deskripsi;
        $model->save();
        return redirect()->route('produk')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $model = Produk::findOrFail($id);
      $model->status = Produk::STATUS_DELETE;
      $model->save();

      return redirect()->route('produk')->with('info', 'Berhasil menghapus data');
    }

    public function export(){
        return Excel::download(new ProdukExport, 'report_produk_'.date('d_m_Y_H_i_s').'.xlsx');
    }
}
