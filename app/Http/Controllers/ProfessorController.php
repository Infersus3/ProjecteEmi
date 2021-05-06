<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Alumne;
use App\Models\Practica;
use Illuminate\Http\Request;
use App\Models\CompostQuimics;
use App\Models\Condicio;
use App\Models\Mostra;
use App\Models\Tasca;
use App\Models\MostraCondComposts;
use Illuminate\Support\Facades\Auth;


class ProfessorController extends Controller
{
    public function index()
    {
        return view('professor.crea_tasques');
    }

    public function adminGrups()
    {
        $alumnes = Alumne::all();
        $grups = Grup::all();
        return view('professor.administrar_grups', ['grups' => $grups, 'alumnes' => $alumnes]);
    }

    public function adminPractiques(){
        $practiques = Practica::all();
        return view('professor.administrar_practiques', ['practiques' => $practiques]);
    }

    public function crearGrup(Request $request){
        Grup::create(['nom' => $request->nom]);
        return redirect()->route('admin_grups');
    }

    public function addAlumneGrup($idAlumne, $idGrup)
    {
        $grup = Grup::find($idGrup);
        $grup->alumnes()->attach($idAlumne);
        return redirect()->route('admin_grups');
    }

    public function deleteAlumneGrup($idAlumne, $idGrup)
    {
        $grup = Grup::find($idGrup);
        $grup->alumnes()->detach($idAlumne);
        return redirect()->route('admin_grups');
    }

    public function eliminarGrup($id)
    {
        $grup = Grup::find($id);
        $grup->alumnes()->detach();
        $grup->delete();
        return redirect()->route('admin_grups');
    }

    public function creaPractica(Request $request)
    {

        if (isset($request->submit)) {
            $mostra = Mostra::create([
                'nom' => $request->nom_mostra,
            ]);

            $condicio = Condicio::create([
                'alçada_col' => $request->alçada_col,
                'temperatura' => $request->temperatura,
                'eluent' => $request->eluent,
                'diametre_col' => $request->diametre_col,
                'tamany' => $request->tamany,
                'velocitat' => $request->velocitat,
                'detector_uv' => $request->detector_uv,
            ]);

            $max = CompostQuimics::all();
            for ($i = 0; $i < count($max); $i++) {
                $param = 'compost_q' . $i;
                $selected = $request->$param;
                if (isset($selected)) {

                    $idCompost = 'idCompost' . $i;
                    $tr = 'temps_retencio' . $i;
                    $alçada = 'alçada_grafic' . $i;
                    $validated = $request->validate([
                        $tr => 'required|min:0.01|max:255|numeric',
                        $alçada => 'required|min:0.01|max:1000|numeric',
                    ]);
                    $mostCondComp = MostraCondComposts::create([
                        'mostra_id' => $mostra->id,
                        'condicion_id' => $condicio->id,
                        'compost_quimic_id' => $request->$idCompost,
                        'temps_retencio' => $request->$tr,
                        'alçada_grafic' => $request->$alçada,
                    ]);
                    // var_dump($request->$idCompost);
                } else {
                }
            }
            $professor = Auth::user()->professor_id;
            Practica::create([
                'professor_id' => $professor,
                'enunciat' => $request->eluent,
                'mostra_cond_compost_id' => $mostCondComp->id,
                'data_entrega' => $request->data_entrega,
            ]);
        } else {
            $compost_quimic = CompostQuimics::all();
            return view('professor.crea_practica', ['compost_quimic' => $compost_quimic]);
        }
    }

    public function adminTasca($id)
    {
        $tasquesAll = Tasca::all();
        $tasques = array();
        foreach ($tasquesAll as $tasca){
            if ($tasca->practica_id == $id){
                array_push($tasques, $tasca);
            }
        }
        $grups = Grup::all();
        $alumnes = Alumne::all();
        
        return view('professor.assignar_practiques', ['tasques' => $tasques, 'grups' => $grups, 'alumnes' => $alumnes, 'practica_id' => $id]);
    }

    public function createTasca(Request $request){
        if (isset($request->grup_id)){
            Tasca::create([
                'grup_id' => $request->grup_id, 
                'practica_id' => $request->practica_id,
            ]);
        }else{
            Tasca::create([
                'alumne_id' => $request->alumne_id, 
                'practica_id' => $request->practica_id,
            ]);
        }
        return redirect()->route('admin_tasques');
    }

    public function deleteTasca($id){
        $tasca = Tasca::find($id);
        $tasca->delete();
        return redirect()->route('admin_tasques');
    }
}
