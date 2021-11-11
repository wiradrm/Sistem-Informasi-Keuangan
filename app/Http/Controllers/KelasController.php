<?php

namespace App\Http\Controllers;

use DB;
use App\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Exports\KelasExport;
use Maatwebsite\Excel\Facades\Excel;

class KelasController extends Controller
{
    protected $page = 'admin.kelas.';
    protected $index = 'admin.kelas.index';
    protected $validator;

    protected function validationData($request){
        $this->validator      = Validator::make(
            $request,
            [
                'kelas'          => 'required',
            ],
            [
                'required'          => ':attribute is required.'
            ],
            [
                'kelas'           => 'Nama Kelas',
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
        $kelas = $request->get('kelas');
        $orderasc = $request->get('orderasc');
        $orderdesc = $request->get('orderdesc');
        $models = Kelas::isNotDeleted();


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

        $model = new Kelas();
        $model->no_kelas = $request->no_kelas;
        $model->kelas = $request->kelas;
        $model->wali = $request->wali;
        $model->save();
        return redirect()->route('kelas')->with('info', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $Kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $Kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $Kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $Kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $Kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kelas_id)
    {
        // $this->validationData($request->all());
        // if ($this->validator->fails()) {
        //     return redirect()->route($this->back)->withInput($request->all())->withErrors($this->validator->errors());
        // }

        $model = Kelas::findOrFail($kelas_id);
        $model->no_kelas = $request->no_kelas;
        $model->kelas = $request->kelas;
        $model->wali = $request->wali;
        $model->save();
        return redirect()->route('kelas')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $Kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($kelas_id)
    {
      $model = Kelas::findOrFail($kelas_id);
      DB::table('tb_kelas')->where('kelas_id',$kelas_id)->delete();

      return redirect()->route('kelas')->with('info', 'Berhasil menghapus data');
    }

    public function export(){
        return Excel::download(new KelasExport, 'report_Kelas_'.date('d_m_Y_H_i_s').'.xlsx');
    }
}
