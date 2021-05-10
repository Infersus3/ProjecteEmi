<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Tasca;
use App\Models\Practica;

class AlumneController extends Controller
{
    public function listTasques(){
        $alumne_id = Auth::user()->alumne_id;
        $tasques = Tasca::all();
        $practiques = Practica::all();
        $tasquesAlumne = array();
        foreach ($tasques as $tasca){
            if($tasca->alumne_id == $alumne_id){
                array_push($tasquesAlumne, $tasca);
            }
        }
        return view('alumne.administrar_tasques', ['tasques' => $tasquesAlumne, 'practiques' => $practiques]);
        
    }
}
