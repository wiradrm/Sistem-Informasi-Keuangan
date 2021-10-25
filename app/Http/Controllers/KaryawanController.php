<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Exports\KaryawanExport;
use App\Imports\KaryawanImport;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{
    protected $page = 'admin.karyawan.';
    protected $index = 'admin.karyawan.index';
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
        $models = User::isNotDeleted();
        $jabatan = Jabatan::isNotDeleted()->get();

        if ($name) {
            $models = $models->where('nama_user', 'like', '%' . $name . '%');
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
        return view($this->index, compact('models', 'jabatan'));
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
                'nama_user'                 => 'required',
                'username'                  => 'required|string|max:255|unique:users',
                'nik'                       => 'required|max:16|unique:users',
                'email'                     => 'required|email|unique:users',
                'password'                  => 'required_with:password_confirmation|same:password_confirmation',
                'password_confirmation'     => 'required'

            ],
            [
                'required'          => ':attribute is required.'
            ],
            [
                'nama_user'                 => 'Nama',
                'nik'                       => 'NIK',
                'username'                  => 'Username',
                'email'                     => 'E Mail',
                'password'                  => 'Password',
                'password_confirmation'     => 'Password Confirmation'
            ]
        );

        $model = new User();
        $model->nama_user = $request->nama_user;
        $model->username = $request->username;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->nik = $request->nik;
        $model->jabatan_id = $request->jabatan_id;
        $model->password = Hash::make($request->password);
        $model->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Karyawan  $inputer
     * @return \Illuminate\Http\Response
     */
    public function show($inputer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Karyawan  $inputer
     * @return \Illuminate\Http\Response
     */
    public function edit($inputer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Karyawan  $inputer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'nama_user'                 => 'required',
                'username'                  => 'required|string|max:255|unique:users,username,'.$request->id,
                'email'                     => 'required|email|unique:users,email,'.$request->id,
                'nik'                       => 'required|max:16|unique:users,nik,'.$request->id,
                'password'                  => 'same:password_confirmation',
            ],
            [
                'required'          => ':attribute is required.'
            ],
            [
                'nama_user'                 => 'Nama',
                'nik'                       => 'NIK',
                'username'                  => 'Username',
                'email'                     => 'E Mail',
                'password'                  => 'Password',
            ]
        );

        $model = User::findOrFail($id);
        $model->nama_user = $request->nama_user;
        $model->username = $request->username;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->nik = $request->nik;
        $model->jabatan_id = $request->jabatan_id;
        if($request->password != null){
            $model->password = Hash::make($request->password);
        }
        $model->save();

        return redirect()->route('karyawan')->with('info', 'Berhasil mengubah data');
    }

    public function profile(Request $request, $id)
    {
        $this->validate($request,
            [
                'nama_user'                 => 'required',
                'username'                  => 'required|string|max:255|unique:users,username,'.$request->id,
                'email'                     => 'required|email|unique:users,email,'.$request->id,
                'password'                  => 'same:password_confirmation',
            ],
            [
                'required'          => ':attribute is required.'
            ],
            [
                'nama_user'                 => 'Nama',
                'username'                  => 'Username',
                'email'                     => 'E Mail',
                'password'                  => 'Password',
            ]
        );

        $model = User::findOrFail($id);
        $model->nik = $request->nik;
        $model->nama_user = $request->nama_user;
        $model->username = $request->username;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->jabatan_id = Auth::user()->jabatan_id;
        if($request->password != null){
            $model->password = Hash::make($request->password);
        }

        $model->save();

        return redirect()->route('karyawan')->with('info', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inputer  $inputer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = User::findOrFail($id);
        $model->status = User::STATUS_DELETE;
        $model->save();
        return redirect()->route('karyawan')->with('info', 'Berhasil menghapus data');
    }

    public function export(){
        return Excel::download(new KaryawanExport, 'report_karyawan_'.date('d_m_Y_H_i_s').'.xlsx');
    }

    public function import(Request $request) 
    {
        Excel::import(new KaryawanImport, $request->file('file')->store('temp'));
        return back()->with('info', 'Berhasil Menambah data');
    }
}
