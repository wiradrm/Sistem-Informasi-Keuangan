<?php

namespace App;
use App\Pemasukan;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    protected $table = 'tb_pemasukan';
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
}
