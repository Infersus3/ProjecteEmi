<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = [
        'professor_id',
        'enunciat',
        'mostra_cond_compost_id',
        'data_entrega',
    ];
=======
    protected $fillable = ['professor_id', 'mostra_cond_compost_id', 'enunciat', 'data_entrega'];
>>>>>>> 6e910556b7c5d5b7ef039f156af3679acdb3653a
}
