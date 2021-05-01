<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grup;

class Alumne extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'user_id', 'dni', 'cognom', 'dataN'];

    public function grups(){
        return $this->belongsToMany(Grup::class, 'grup_alumnes');
    }
}
