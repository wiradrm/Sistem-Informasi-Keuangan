<?php

namespace App;
use App\Guru;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    protected $table = 'tb_guru';
    protected $guarded = [];
    protected $primaryKey = 'guru_id';

    public function scopeIsNotDeleted($query)
    {
        return $query->where('status', '!=', static::STATUS_DELETE);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }
}
