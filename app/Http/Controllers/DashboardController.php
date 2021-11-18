<?php

namespace App\Http\Controllers;
use DB;
use App\Guru;
use App\Kelas;
use App\Siswa;
use App\Spp;
use App\Pemasukan;
use App\Pengeluaran;
use App\Anggaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{   
    protected $page = 'admin.dashboard.';
    protected $index = 'admin.dashboard.index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $name = $request->get('name');

        $guru = Guru::isNotDeleted()->count();
        $siswa = Siswa::isNotDeleted()->count();
        $kelas = Kelas::isNotDeleted()->count();
        $pengeluaran = DB::table("tb_pengeluaran")->get()->sum("jumlah");
        $kas_masuk = DB::table("tb_pemasukan")->where("jenis_transaksi", "!=", "Saldo Awal")->sum("jumlah");

        $kas_masuk_all = DB::table("tb_pemasukan")->get()->sum("jumlah");

        $saldo_awal = DB::table("tb_pemasukan")->where("jenis_transaksi", "Saldo Awal")->sum("jumlah");
        
        
        $spp = DB::table("tb_bayar")->where("status_transaksi", 1)->sum("jumlah");
        $pemasukan = $kas_masuk+$spp;
        $pengeluaran = DB::table("tb_pengeluaran")->get()->sum("jumlah");
        $akhir = $kas_masuk_all+$spp-$pengeluaran;
        

        return view($this->index, compact('kelas', 'guru', 'siswa', 'saldo_awal', 'pemasukan', 'pengeluaran', 'akhir'));
    }

    public function profile(Request $request, $id)
    {
        $this->validate($request,
            [
                'username'                  => 'required|string|max:255|unique:users,username,'.$request->id,
                'password'                  => 'same:password_confirmation',
            ],
            [
                'required'          => ':attribute is required.'
            ],
            [
                'username'                  => 'Username',
                'password'                  => 'Password',
            ]
        );

        $model = User::findOrFail($id);
        $model->username = $request->username;
        if($request->password != null){
            $model->password = Hash::make($request->password);
        }

        $model->save();

        return redirect()->route('dashboard')->with('info', 'Berhasil mengubah data');
    }
}
