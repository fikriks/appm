<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Pengaduan extends Model
{
    use HasFactory, HasHashSlug, QueryCacheable;

    protected $table = 'pengaduan';

    protected $fillable = [
        'tgl_pengaduan',
        'masyarakat_id',
        'judul_laporan',
        'isi_laporan',
        'foto',
        'status'
    ];

    public $cacheFor = 3600;

    protected static $flushCacheOnUpdate = true;

    public function scopeDitinjau($query)
    {
        return $query->where('status', '0');
    }

    public function scopeDiproses($query)
    {
        return $query->where('status', 'proses');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class);
    }

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class);
    }
}
