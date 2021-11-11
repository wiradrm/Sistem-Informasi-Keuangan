<?php

namespace App;
use App\Spp;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    protected $table = 'tb_spp';
    protected $guarded = [];
    protected $primaryKey = 'kode_spp';

    public function scopeIsNotDeleted($query)
    {
        return $query->where('status', '!=', static::STATUS_DELETE);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }
}
