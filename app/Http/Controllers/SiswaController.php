<?php

namespace App\Http\Controllers;

use DB;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    protected $page = 'admin.siswa.';
    protected $index = 'admin.siswa.index';
    protected $validator;

    protected function validationData($request){
        $this->validator      = Validator::make(
            $request,
            [
                'nama_siswa'          => 'required',
            ],
            [
                'required'          => ':attribute is required.'
            ],
            [
                'nama_siswa'           => 'Nama Siswa',
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
        $models = Siswa::isNotDeleted();

        if ($name) {
            $models = $models->where('nama_siswa', 'like', '%' . $name . '%');
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

        $model = new Siswa();
        $model->nisn = $request->nisn;
        $model->nama_siswa = $request->nama_siswa;
        $model->tempat = $request->tempat;
        $model->tanggal = $request->tanggal;
        $model->angkatan = $request->angkatan;
        $model->alamat = $request->alamat;
        $model->jenis_kelamin = $request->jenis_kelamin;

        $model->save();
        return redirect()->route('siswa')->with('info', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Siswa  $Siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $Siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siswa  $Siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $Siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siswa  $Siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $siswa_id)
    {
        // $this->validationData($request->all());
        // if ($this->validator->fails()) {
        //     return redirect()->route($this->back)->withInput($request->all())->withErrors($this->validator->errors());
        // }

        $model = Siswa::findOrFail($siswa_id);
        $model->nisn = $request->nisn;
        $model->nama_siswa = $request->nama_siswa;
        $model->tempat = $request->tempat;
        $model->tanggal = $request->tanggal;
        $model->angkatan = $request->angkatan;

        $model->alamat = $request->alamat;
        $model->jenis_kelamin = $request->jenis_kelamin;
        $model->save();
        return redirect()->route('siswa')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $Siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($siswa_id)
    {
        $model = Siswa::findOrFail($siswa_id);
        DB::table('tb_siswa')->where('siswa_id',$siswa_id)->delete();
  
        return redirect()->route('siswa')->with('info', 'Berhasil menghapus data');
    }

    public function import(Request $request) 
    {
        Excel::import(new SiswaImport, $request->file('file')->store('temp'));
        return back()->with('info', 'Berhasil Menambah data');
    }

}
