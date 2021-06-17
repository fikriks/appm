<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Balping\HashSlug\HasHashSlug;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Petugas extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasHashSlug, QueryCacheable;

    protected $table = 'petugas';

    protected $fillable = [
        'nama_petugas',
        'username',
        'password',
        'telp'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $cacheFor = 3600;

    protected static $flushCacheOnUpdate = true;
}
