<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompostQuimics extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'formula',
    ];

}
