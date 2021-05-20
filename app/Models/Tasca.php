<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasca extends Model
{
    use HasFactory;

    protected $fillable = [
        'practica_id',
        'grup_id',
        'alumne_id',
        'condicion_id',
        'comentari',
        'nota',
        'data_lliurament',
        'document',
        'correcta',
    ];
}
