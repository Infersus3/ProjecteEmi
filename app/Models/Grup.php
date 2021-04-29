<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alumne;

class Grup extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function alumnes(){
        return $this->belongsToMany(Alumne::class);
    }

}
