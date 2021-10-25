<?php

namespace App;

use App\Transaksi;
use App\User;
use App\Pelanggan;
use App\StatusTransaksi;
use App\Produk;
use Illuminate\Database\Eloquent\Model;

class AM extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    protected $table = 'tb_prospek_am';
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function scopeIsNotDeleted($query)
    {
        return $query->where('status', '!=', static::STATUS_DELETE);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }

    public function getStatusTransaksi()
    {
        return $this->belongsTo(StatusTransaksi::class, 'status_transaksi_id', 'id');
    }

    public function getAM()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getProduk()
    {
        return $this->belongsTo(Produk::class, 'product_id', 'id');
    }
}
