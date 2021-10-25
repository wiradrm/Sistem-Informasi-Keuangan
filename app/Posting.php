<?php

namespace App;
use App\User;
use App\Pelanggan;

use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    protected $table = 'tb_posting_kegiatan';
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

    public function getAM()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getPelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'nipnas');
    }

    public function uploadImage($image, $name)
    {
        $des    = 'img/post/';
        $image->move($des, $name);
    }

    public function getImage()
    {
        $path   = 'img/post/';
        return url($path . $this->img);
    }
}
