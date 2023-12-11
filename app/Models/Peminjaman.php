<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_anggota',
        'id_petugas',
        'tgl_pinjam',
        'tgl_kembali',
    ];

    public function anggota()
    {
        return $this->belongsTo(User::class, 'id_anggota');
    }
    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas');
    }
}
