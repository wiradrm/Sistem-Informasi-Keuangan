<?php

namespace App\Http\Controllers;
use App\Order;
use App\AM;
use App\Posting;
use App\Pelanggan;
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

        $countSuccess = Order::isNotDeleted()->where('status_transaksi_id', 4)->count();
        $countPending = Order::isNotDeleted()->where('status_transaksi_id', 1)->count();
        $countProgress = Order::isNotDeleted()->where('status_transaksi_id', 2)->count();

        $CountChartSuccesss = Order::select('status_transaksi_id', 'created_at')
        ->where('status_transaksi_id', 4)
        ->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });


        $CountChartPending = Order::select('status_transaksi_id', 'created_at')
        ->where('status_transaksi_id', 1)
        ->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });

        $CountChartProgress = Order::select('status_transaksi_id', 'created_at')
        ->where('status_transaksi_id', 2)
        ->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });

        $chartSuccessmcount = [];
        $chartSuccess = [];

        foreach ($CountChartSuccesss as $key => $value) {
            $chartSuccessmcount[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($chartSuccessmcount[$i])) {
                $chartSuccess[$i] = $chartSuccessmcount[$i];
            } else {
                $chartSuccess[$i] = 0;
            }
        }

        $chartPendingmcount = [];
        $chartPending = [];

        foreach ($CountChartPending as $key => $value) {
            $chartPendingmcount[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($chartPendingmcount[$i])) {
                $chartPending[$i] = $chartPendingmcount[$i];
            } else {
                $chartPending[$i] = 0;
            }
        }

        $chartProgressmcount = [];
        $chartProgress = [];

        foreach ($CountChartProgress as $key => $value) {
            $chartProgressmcount[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($chartProgressmcount[$i])) {
                $chartProgress[$i] = $chartProgressmcount[$i];
            } else {
                $chartProgress[$i] = 0;
            }
        }

        return view($this->index, compact('models', 'pelanggan', 'countSuccess', 'countPending', 'countProgress', 'chartProgress', 'chartPending', 'chartSuccess'));
    }
}
