<?php

namespace App\Http\Controllers;

use App\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Facades\Excel;

class JurnalController extends Controller
{
    protected $page = 'admin.jurnal.';
    protected $index = 'admin.jurnal.index';
    protected $validator;

    protected function validationData($request){
        $this->validator      = Validator::make(
            $request,
            [
                'kode_spp'          => 'required',
            ],
            [
                'required'          => ':attribute is required.'
            ],
            [
                'kode_spp'           => 'Kode SPP',
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
        $models = Spp::isNotDeleted();

        if ($name) {
            $models = $models->where('kode_spp', 'like', '%' . $name . '%');
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

        $model = new Spp();
        $model->nama_spp = $request->nama_spp;
        $model->deskripsi = $request->deskripsi;
        $model->save();
        return redirect()->route('spp')->with('info', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function show(Spp $spp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function edit(Spp $spp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validationData($request->all());
        // if ($this->validator->fails()) {
        //     return redirect()->route($this->back)->withInput($request->all())->withErrors($this->validator->errors());
        // }

        $model = Spp::findOrFail($id);
        $model->nama_spp = $request->nama_spp;
        $model->deskripsi = $request->deskripsi;
        $model->save();
        return redirect()->route('spp')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $model = Spp::findOrFail($id);
      $model->status = Spp::STATUS_DELETE;
      $model->save();

      return redirect()->route('spp')->with('info', 'Berhasil menghapus data');
    }

    public function export(){
        return Excel::download(new SppExport, 'report_spp_'.date('d_m_Y_H_i_s').'.xlsx');
    }
}
