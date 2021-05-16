<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_col',
        'alçada_col',
        'temperatura',
        'eluent',
        'diametre_col',
        'tamany',
        'velocitat',
        'detector_uv',
        'neutre',
    ];

    protected $table =  "condicions";
    
}
