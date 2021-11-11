<?php

namespace App\Http\Controllers;

use App\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Exports\GuruExport;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    protected $page = 'admin.transaksi.';
    protected $index = 'admin.transaksi.index';
    protected $validator;

    protected function validationData($request){
        $this->validator      = Validator::make(
            $request,
            [
                'nama_guru'          => 'required',
            ],
            [
                'required'          => ':attribute is required.'
            ],
            [
                'nama_guru'           => 'Nama guru',
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
        $models = guru::isNotDeleted();

        if ($name) {
            $models = $models->where('nama_guru', 'like', '%' . $name . '%');
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

        $model = new guru();
        $model->nama_guru = $request->nama_guru;
        $model->deskripsi = $request->deskripsi;
        $model->save();
        return redirect()->route('guru')->with('info', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(guru $guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validationData($request->all());
        // if ($this->validator->fails()) {
        //     return redirect()->route($this->back)->withInput($request->all())->withErrors($this->validator->errors());
        // }

        $model = guru::findOrFail($id);
        $model->nama_guru = $request->nama_guru;
        $model->deskripsi = $request->deskripsi;
        $model->save();
        return redirect()->route('guru')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $model = guru::findOrFail($id);
      $model->status = guru::STATUS_DELETE;
      $model->save();

      return redirect()->route('guru')->with('info', 'Berhasil menghapus data');
    }

    public function export(){
        return Excel::download(new guruExport, 'report_guru_'.date('d_m_Y_H_i_s').'.xlsx');
    }
}
