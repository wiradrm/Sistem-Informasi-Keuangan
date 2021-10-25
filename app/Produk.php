<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    protected $table = 'tb_produk';
    protected $guarded = [];

    public function scopeIsNotDeleted($query)
    {
        return $query->where('status', '!=', static::STATUS_DELETE);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }
}
