<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Tanggapan extends Model
{
    use HasFactory, HasHashSlug, QueryCacheable;

    protected $table = 'tanggapan';

    protected $fillable = [
        'pengaduan_id',
        'tgl_tanggapan',
        'tanggapan',
        'petugas_id'
    ];

    public $cacheFor = 3600;

    protected static $flushCacheOnUpdate = true;

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }
}
