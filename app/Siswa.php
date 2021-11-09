<?php

namespace App;
use App\Siswa;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    protected $table = 'tb_siswa';
    protected $guarded = [];
    protected $primaryKey = 'nis';

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
