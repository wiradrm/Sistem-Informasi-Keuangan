<?php

namespace App\Http\Controllers;

use DB;
use App\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Imports\GuruImport;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    protected $page = 'admin.guru.';
    protected $index = 'admin.guru.index';
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
        $models = guru::isNotDeleted();

        if ($name) {
            $models = $models->where('nama_guru', 'like', '%' . $name . '%');
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

        $model = new Guru();
        $model->nip = $request->nip;
        $model->nama_guru = $request->nama_guru;
        $model->jenis_kelamin = $request->jenis_kelamin;
        $model->mapel = $request->mapel;

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
    public function update(Request $request, $guru_id)
    {
        // $this->validationData($request->all());
        // if ($this->validator->fails()) {
        //     return redirect()->route($this->back)->withInput($request->all())->withErrors($this->validator->errors());
        // }

        $model = Guru::findOrFail($guru_id);
        $model->nip = $request->nip;
        $model->nama_guru = $request->nama_guru;
        $model->jenis_kelamin = $request->jenis_kelamin;
        $model->mapel = $request->mapel;
        $model->save();
        return redirect()->route('guru')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy($guru_id)
    {
        $model = Guru::findOrFail($guru_id);
        DB::table('tb_guru')->where('guru_id',$guru_id)->delete();
  
        return redirect()->route('guru')->with('info', 'Berhasil menghapus data');
    }

    public function import(Request $request) 
    {
        Excel::import(new GuruImport, $request->file('file')->store('temp'));
        return back()->with('info', 'Berhasil Menambah data');
    }

}
