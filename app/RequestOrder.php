<?php

namespace App;
use App\Pelanggan;
use App\Transaksi;

use Illuminate\Database\Eloquent\Model;

class RequestOrder extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    protected $table = 'tb_requests';
    protected $guarded = [];

    public function scopeIsNotDeleted($query)
    {
        return $query->where('status', '!=', static::STATUS_DELETE);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }

    public function getPelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'nipnas');
    }

    public function getTransaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }
}
