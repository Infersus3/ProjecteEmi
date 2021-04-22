<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    //
    public function index()
    {
        //echo Auth::user()->email;
        return view('professor.CreaPractica');
    }
<<<<<<< Updated upstream
=======

    public function startTasca()
    {

        $compost_quimic = Compost_quimics::all();
        return view('professor.CreaPractica',['compost_quimic' => $compost_quimic]);
        // $arrayC = [];
        // $datos = Mostra_cond_composts::all();

        // foreach($datos as $d){
        //     if($d->mostra_id == 1){
        //         array_push($arrayC, $d);
        //     }
        // }
        // var_dump($arrayC[0]->mostra_id);exit();

    }
>>>>>>> Stashed changes
}
