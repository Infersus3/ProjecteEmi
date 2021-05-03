<?php

namespace App\Http\Controllers;
use App\Models\Grup;
use App\Models\Alumne;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        //echo Auth::user()->email;
        return view('professor.CreaPractica');
=======
        return view('professor.crea_tasques');
    }

    public function adminGrups(){
        $alumnes = Alumne::all();
        $grups = Grup::all();
        return view('professor.administrar_grups', ['grups' => $grups, 'alumnes' => $alumnes]);
    }

    public function crearGrup(Request $request){
        Grup::create(['nom' => $request->nom]);
        return redirect()->route('admin_grups');
    }

    public function addAlumneGrup($idAlumne, $idGrup){
        $grup = Grup::find($idGrup);
        $grup->alumnes()->attach($idAlumne);
        return redirect()->route('admin_grups');
    }

    public function deleteAlumneGrup($idAlumne,$idGrup){
        $grup = Grup::find($idGrup);
        $grup->alumnes()->detach($idAlumne);
        return redirect()->route('admin_grups');
    }

    public function eliminarGrup($id){
        $grup = Grup::find($id);
        $grup->alumnes()->detach();
        $grup->delete();
        return redirect()->route('admin_grups');
>>>>>>> c7e10acb75ee4a91a98b10f6ddb7ebdb4c18fec1
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
