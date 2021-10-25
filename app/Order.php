<?php

namespace App;

use App\Transaksi;
use App\User;
use App\Pelanggan;
use App\StatusTransaksi;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    protected $table = 'tb_monitoring_order';
    protected $guarded = [];
    protected $primaryKey = 'order_id';

    public function scopeIsNotDeleted($query)
    {
        return $query->where('status', '!=', static::STATUS_DELETE);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }

    public function getTransaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }

    public function getStatusTransaksi()
    {
        return $this->belongsTo(StatusTransaksi::class, 'status_transaksi_id', 'id');
    }

    public function getAM()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getInputer()
    {
        return $this->belongsTo(User::class, 'inputer_id', 'id');
    }

    public function getPelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'nipnas');
    }
}
