<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'review';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_buku',
        'id_anggota',
        'komentar',
        'rating'
    ];

    function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    function anggota()
    {
        return $this->belongsTo(User::class, 'id_anggota');
    }
}
