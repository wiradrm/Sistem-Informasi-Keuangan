<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Posting;
use App\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Exports\PostingExport;
use Maatwebsite\Excel\Facades\Excel;

class PostingController extends Controller
{
    protected $page = 'admin.posting.';
    protected $index = 'admin.posting.index';
    protected $validator;
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
        $models = Posting::isNotDeleted();
        $pelanggan = Pelanggan::isNotDeleted()->get();

        if ($name) {
            $models = $models->where('nama_kegiatan', 'like', '%' . $name . '%');
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
        return view($this->index, compact('models', 'pelanggan'));

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
        $this->validate($request, 
        [
            'nama_kegiatan'                    => 'required',
            'keterangan'              => 'required',
            'pelanggan_id'       => 'required',
            'img'       => 'required',
        ],
        [
            'required'          => ':attribute is required.'
        ],
        [
            'nama_kegiatan'                    => 'Nama Kegiatan',
            'keterangan'              => 'Kegiatan',
            'pelanggan_id'       => 'Pelanggan',
            'img'       => 'Dokumentasi',
        ]
        );

        $model = new Posting();
        $model->nama_kegiatan = $request->nama_kegiatan;
        $model->keterangan = $request->keterangan;
        $model->pelanggan_id = $request->pelanggan_id;
        $model->user_id = Auth::user()->id;
        $model->save();

        if ($request->file('img') != null) {
            $file   = $request->file('img');
            $name   = $model->nama_kegiatan . '-' . Str::random(4) . '.' . strtolower($file->getClientOriginalExtension());
            $model->img = $name;
            $model->save();
            $model->uploadImage($file, $name);
        }

        return redirect()->route('posting')->with('info', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posting  $posting
     * @return \Illuminate\Http\Response
     */
    public function show(Posting $posting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posting  $posting
     * @return \Illuminate\Http\Response
     */
    public function edit(Posting $posting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posting  $posting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
        [
            'nama_kegiatan'                    => 'required',
            'keterangan'              => 'required',
            'pelanggan_id'       => 'required',
        ],
        [
            'required'          => ':attribute is required.'
        ],
        [
            'nama_kegiatan'                    => 'Nama Kegiatan',
            'keterangan'              => 'Kegiatan',
            'pelanggan_id'       => 'Pelanggan',
        ]
        );

        $model = Posting::findOrFail($id);
        $model->nama_kegiatan = $request->nama_kegiatan;
        $model->keterangan = $request->keterangan;
        $model->pelanggan_id = $request->pelanggan_id;
        $model->user_id = Auth::user()->id;
        $model->save();

        if ($request->file('img') != null) {
            $file   = $request->file('img');
            $name   = $model->nama_kegiatan . '-' . Str::random(4) . '.' . strtolower($file->getClientOriginalExtension());
            $model->img = $name;
            $model->save();
            $model->uploadImage($file, $name);
        }

        return redirect()->route('posting')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posting  $posting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = Posting::findOrFail($id);
        $model->status = Posting::STATUS_DELETE;
        $model->save();
        return redirect()->route('posting')->with('info', 'Berhasil menghapus data');
    }

    public function export(){
        return Excel::download(new PostingExport, 'report_posting_'.date('d_m_Y_H_i_s').'.xlsx');
    }
}
