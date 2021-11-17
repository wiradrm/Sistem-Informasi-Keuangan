<?php

namespace App;
use App\Pengeluaran;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    protected $table = 'tb_pengeluaran';
    protected $guarded = [];
    protected $primaryKey = 'id_transaksi';

    public function scopeIsNotDeleted($query)
    {
        return $query->where('status', '!=', static::STATUS_DELETE);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }

    // public function getAM()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
}
