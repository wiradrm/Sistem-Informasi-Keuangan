<?php

namespace App;
use App\RequestOrder;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    protected $table = 'tb_notifications';
    protected $guarded = [];

    public function getRequest()
    {
        return $this->belongsTo(RequestOrder::class, 'request_id', 'id');
    }
}
