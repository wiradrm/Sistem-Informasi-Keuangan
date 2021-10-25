<?php

namespace App\Http\Controllers;
use App\Notification;
use App\RequestOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $page = 'admin.notification.';
    protected $index = 'admin.notification.index';

    public function index()
    {
        if(Auth::user()->id == 1){
            $models = Notification::where('type', 1)->orderBy('created_at', 'desc')->paginate(20);
        }
        else{
            $models = Notification::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->where('type', 2)->paginate(20);
        }

        return view($this->index, compact('models'));
    }


    public function read(Request $request, $id)
    {
        $read = Notification::findOrFail($id);
        $read->read = 0;
        $read->save();

        return redirect()->route('notification')->with('info', 'Notifikasi Ditandai sudah dibaca');
    }

    public function approve(Request $request, $id, $user_id)
    {

        $model = RequestOrder::findOrFail($id);
        $model->approve_status = 2;
        $model->save();

        $read = Notification::where('request_id', $id)->first();
        $read->read = 0;
        $read->save();

        $notif = new Notification();
        $notif->type = 2;
        $notif->status = 2;
        $notif->user_id = $user_id;
        $notif->request_id = $id;
        $notif->save();

        return redirect()->route('notification')->with('info', 'Berhasil mengubah data');
    }

    public function cancel(Request $request, $id, $user_id)
    {

        $model = RequestOrder::findOrFail($id);
        $model->approve_status = 3;
        $model->save();

        $read = Notification::where('request_id',$id)->first();
        $read->read = 0;
        $read->save();

        $notif = new Notification();
        $notif->type = 2;
        $notif->status = 3;
        $notif->user_id = $user_id;
        $notif->request_id = $id;
        $notif->save();

        return redirect()->route('notification')->with('info', 'Berhasil mengubah data');
    }
}
