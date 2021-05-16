<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MostraCondComposts extends Model
{
    use HasFactory;


    protected $fillable = [
        'practica_id',
        'mostra_id',
        'condicion_id',
        'compost_quimic_id',
        'temps_retencio',
        'alçada_grafic',
        'temps_inicial',
        'temps_final',
    ];
}
