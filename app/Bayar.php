<?php

namespace App;
use App\Bayar;

use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    protected $table = 'tb_bayar';
    protected $guarded = [];

    public function scopeIsNotDeleted($query)
    {
        return $query->where('status', '!=', static::STATUS_DELETE);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }

    public function getSiswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }


    // public function getAM()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
}
