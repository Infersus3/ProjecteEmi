<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    use HasFactory;

    protected $fillable = [
        'professor_id',
        'enunciat',
        'mostra_cond_compost_id',
        'data_entrega',
    ];
}
