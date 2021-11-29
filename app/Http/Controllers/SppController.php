<?php

namespace App\Http\Controllers;

use DB;
use App\SPP;
use App\Bayar;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SPPController extends Controller
{
    protected $page = 'admin.spp.';
    protected $index = 'admin.spp.index';
    protected $validator;

    protected function validationData($request){
        $this->validator      = Validator::make(
            $request,
            [
                'spp'          => 'required',
            ],
            [
                'required'          => ':attribute is required.'
            ],
            [
                'spp'           => 'Nama SPP',
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
        $spp = $request->get('spp');
        $orderasc = $request->get('orderasc');
        $orderdesc = $request->get('orderdesc');
        $models = SPP::isNotDeleted();


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
        
        $cek = $request->angkatan;
        $siswa = \App\Siswa::where('angkatan', $cek)->get();
        foreach ($siswa as $key => $item) {

        if ($cek == $item->angkatan) {
            $bayar = new Bayar();
            $bayar->nisn = $item->nisn;
            $bayar->kode_spp = $request->kode_spp;
            $bayar->bulan = 'Oktober';
            $bayar->jumlah = $request->jumlah_bayar;
            $bayar->status_transaksi = 0;
            $bayar->save();
        }
        if ($cek == $item->angkatan) {
            $bayar = new Bayar();
            $bayar->nisn = $item->nisn;
            $bayar->kode_spp = $request->kode_spp;
            $bayar->bulan = 'November';
            $bayar->jumlah = $request->jumlah_bayar;
            $bayar->status_transaksi = 0;
            $bayar->save();
        }
        if ($cek == $item->angkatan) {
            $bayar = new Bayar();
            $bayar->nisn = $item->nisn;
            $bayar->kode_spp = $request->kode_spp;
            $bayar->bulan = 'Desember';
            $bayar->jumlah = $request->jumlah_bayar;
            $bayar->status_transaksi = 0;
            $bayar->save();
            }
        }
        
        $model = new SPP();
        $model->kode_spp = $request->kode_spp;
        $model->angkatan = $request->angkatan;
        $model->jumlah_bayar = $request->jumlah_bayar;
        $model->save();


        

        return redirect()->route('spp')->with('info', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SPP  $SPP
     * @return \Illuminate\Http\Response
     */
    public function show(SPP $SPP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SPP  $SPP
     * @return \Illuminate\Http\Response
     */
    public function edit(SPP $SPP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SPP  $SPP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $spp_id)
    {
        // $this->validationData($request->all());
        // if ($this->validator->fails()) {
        //     return redirect()->route($this->back)->withInput($request->all())->withErrors($this->validator->errors());
        // }

        $model = SPP::findOrFail($spp_id);
        $model->no_spp = $request->no_spp;
        $model->spp = $request->spp;
        $model->wali = $request->wali;
        $model->save();
        return redirect()->route('spp')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SPP  $SPP
     * @return \Illuminate\Http\Response
     */
    public function destroy($spp_id)
    {
      $model = SPP::findOrFail($spp_id);
      DB::table('tb_spp')->where('spp_id',$spp_id)->delete();

      return redirect()->route('spp')->with('info', 'Berhasil menghapus data');
    }

    public function export(){
        return Excel::download(new SPPExport, 'report_SPP_'.date('d_m_Y_H_i_s').'.xlsx');
    }
}
