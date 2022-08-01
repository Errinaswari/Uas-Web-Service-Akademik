<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    public $table = 'dosens';

    protected $fillable = [
        'nip',
        'nama_dosen',
    ];
}
