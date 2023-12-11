<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'pengarang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama'
    ];
}
