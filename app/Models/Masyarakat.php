<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Balping\HashSlug\HasHashSlug;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Masyarakat extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasHashSlug, QueryCacheable;

    protected $table = 'masyarakat';

    protected $fillable = [
        'nik',
        'nama',
        'username',
        'password',
        'telp'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public $cacheFor = 3600;

    protected static $flushCacheOnUpdate = true;

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class);
    }
}
