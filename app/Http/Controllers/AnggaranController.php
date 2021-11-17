<?php

namespace App\Http\Controllers;

use DB;
use App\Anggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Imports\AnggaranImport;
use Maatwebsite\Excel\Facades\Excel;


class AnggaranController extends Controller
{
    protected $page = 'admin.anggaran.';
    protected $index = 'admin.anggaran.index';
    protected $validator;

    protected function validationData($request){
        $this->validator      = Validator::make(
            $request,
            [
                'jenis_anggaran'          => 'required',
            ],
            [
                'required'          => ':attribute is required.'
            ],
            [
                'jenis_anggaran'           => 'Anggaran',
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
        $jenis_anggaran = $request->get('jenis_anggaran');
        $orderasc = $request->get('orderasc');
        $orderdesc = $request->get('orderdesc');
        $models = Anggaran::isNotDeleted();


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

        $model = new Anggaran();
        $model->jenis_anggaran = $request->jenis_anggaran;
        $model->anggaran = $request->anggaran;

        $model->jumlah = $request->jumlah;
        $model->save();
        return redirect()->route('anggaran')->with('info', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anggaran  $Anggaran
     * @return \Illuminate\Http\Response
     */
    public function show(Anggaran $Anggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anggaran  $Anggaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Anggaran $Anggaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anggaran  $Anggaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $model = Anggaran::findOrFail($id);
        $model->jenis_anggaran = $request->jenis_anggaran;
        $model->anggaran = $request->anggaran;

        $model->jumlah = $request->jumlah;
        $model->save();
        return redirect()->route('anggaran')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anggaran  $Anggaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $model = Anggaran::findOrFail($id);
      DB::table('tb_anggaran')->where('id',$id)->delete();

      return redirect()->route('anggaran')->with('info', 'Berhasil menghapus data');
    }

    public function import(Request $request) 
    {
        Excel::import(new AnggaranImport, $request->file('file')->store('temp'));
        return back()->with('info', 'Berhasil Menambah data');
    }
}
