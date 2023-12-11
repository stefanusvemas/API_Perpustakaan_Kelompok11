<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'pengembalian';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_petugas',
        'tgl_pengembalian',
        'denda',
    ];
    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas');
    }
}
