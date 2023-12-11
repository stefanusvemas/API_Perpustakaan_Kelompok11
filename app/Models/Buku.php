<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'buku';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_pengarang',
        'id_kategori',
        'id_penerbit',
        'judul',
        'stok',
        'cover_buku'
    ];

    function pengarang()
    {
        return $this->belongsTo(Pengarang::class, 'id_pengarang');
    }

    function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit');
    }
}
