<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\User;
use App\Akses;

class User extends Authenticatable
{
    use Notifiable;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 0;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'hak_akses'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function scopeIsNotDeleted($query)
    {
        return $query->where('status', '!=', static::STATUS_DELETE);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }

    public function getAkses()
    {
        return $this->belongsTo(Akses::class, 'akses_id', 'id');
    }
}
