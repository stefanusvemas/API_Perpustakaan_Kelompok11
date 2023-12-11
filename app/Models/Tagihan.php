<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'tagihan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_anggota',
        'nominal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_anggota');
    }
}
