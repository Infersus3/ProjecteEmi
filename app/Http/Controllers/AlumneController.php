<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Alumne;
use App\Models\Practica;
use Illuminate\Http\Request;
use App\Models\CompostQuimics;
use App\Models\Condicio;
use App\Models\Mostra;
use App\Models\Tasca;
use App\Models\MostraCondComposts;
use Illuminate\Support\Facades\Auth;


class AlumneController extends Controller
{
    //
    public function listTasques()
    {
        $alumne_id = Auth::user()->alumne_id;
        $alumne = ALumne::find($alumne_id);
        $tasques = Tasca::all();
        $practiques = Practica::all();
        $tasquesAlumne = array();
        foreach ($tasques as $tasca) {
            if ($tasca->alumne_id == $alumne_id) {
                array_push($tasquesAlumne, $tasca);
            }
        }
        
        //Mirem si pertany a grups que tinguin altres tasques
        foreach ($tasques as $tasca) {
            foreach ($alumne->grups as $grup){
                if ($tasca->grup_id == $grup->id) {
                        array_push($tasquesAlumne, $tasca);
                }
            }
        }
        
        return view('alumne.administrar_tasques', ['tasques' => $tasquesAlumne, 'practiques' => $practiques, 'alumne' => $alumne]);
    }

    public function realitzaTasca($id, Request $request)
    {
        if (isset($request->submit)) {
            $validated = $request->validate([
                'nom_mostra' => 'required|max:30',
            ]);
            $validated = $request->validate([
                'nom_col' => 'required|max:30',
                'alçada_col' => 'required|numeric|max:10000',
                'temperatura' => 'required|max:10000|numeric',
                'eluent' => 'required|max:25',
                'diametre_col' => 'required|numeric|max:10000',
                'tamany' => 'required|numeric|max:10000',
                'velocitat' => 'required|max:10',
                'detector_uv' => 'required|numeric|max:10000',
            ]);

            $tasca = Tasca::find($id);
            $practId = $tasca->practica_id;
            $practica = Practica::find($practId);
            $totesmcc = MostraCondComposts::all();
            $condicioGuardar = 0;
            $ok = false;
            $i = 0;
            while ($ok != true) {
                if ($totesmcc[$i]->practica_id == $practId) {
                    $condicioGuardar = $totesmcc[$i]->condicion_id;
                    $ok = true;
                }
                $i++;
            }
            $condicio = Condicio::find($condicioGuardar);
            $ok = true;

            if (
                $condicio->alçada_col == $request->alçada_col
                && $condicio->temperatura == $request->temperatura
                && $condicio->eluent == $request->eluent
                && $condicio->diametre_col == $request->diametre_col
                && $condicio->tamany == $request->tamany
                && $condicio->velocitat == $request->velocitat
                && $condicio->detector_uv == $request->detector_uv
                && $condicio->neutre == $request->neutre
            ) {
                $ok = true;
            } else {
                $ok = false;
            }

            if ($ok == true) {
                $tasca->condicion_id = $condicioGuardar;
                $tasca->correcta = true;
                $tasca->save();
            } else {
                if ($tasca->condicion_id != $condicioGuardar){
                    $condicioActual = Condicio::find($tasca->condicion_id);
                    if ($condicioActual){
                    $tasca->condicion_id = null;
                    $tasca->save();
                    $condicioActual->delete();
                    }
                }else{
                    $tasca->condicion_id = null;
                    $tasca->save();
                }
                
                $condIncorrecta = Condicio::create([
                    'alçada_col' => $request->alçada_col,
                    "temperatura" => $request->temperatura,
                    "eluent" => $request->eluent,
                    "diametre_col" => $request->diametre_col,
                    "tamany" => $request->tamany,
                    "velocitat" => $request->velocitat,
                    "detector_uv" => $request->detector_uv,
                    "neutre" => $request->neutre,
                    'nom_col' => $request->nom_col,
                ]);
                $tasca->condicion_id = $condIncorrecta->id;
                $tasca->correcta = false;
                $tasca->save();
            }
            $tasca->comentari = $request->comentari;
            $tasca->save();
            return redirect()->route('tasques_alumne');
        } else {
            $tasca = Tasca::find($id);
            $practId = $tasca->practica_id;
            $practica = Practica::find($practId);
            $totesmcc = MostraCondComposts::all();
            $arrayComposts = array();
            $mostraGuardar = 0;
            $condicioGuardar = 0;
            foreach ($totesmcc as $param) {
                if ($param->practica_id == $practId) {
                    array_push($arrayComposts, $param);
                    $mostraGuardar = $param->mostra_id;
                    $condicioGuardar = $param->condicion_id;
                }
            }
            $mostra = Mostra::find($mostraGuardar);
            $condicio = Condicio::find($condicioGuardar);
            $condN = $condicio->neutre;
            $compost_quimic = CompostQuimics::all();
            $condicioAlumne = null;
            if ($tasca->condicion_id){
                $condicioAlumne = Condicio::find($tasca->condicion_id);
            }
            return view('alumne.fer_practica', ['condicioAlumne' => $condicioAlumne, 'compost_quimic' => $compost_quimic, 'tasca_id' => $tasca->id, 'condN' => $condN, 'condicio' => $condicio, 'arrayComposts' => $arrayComposts, 'mostra' => $mostra, 'practica' => $practica]);
        }
    }

    public function returnCond($id){
        $mostra_cond_compost = MostraCondComposts::all();
        $idCondicions = 0;
        foreach ($mostra_cond_compost as $mostrescc){
            if ($mostrescc->practica_id == $id){
                $idCondicions = $mostrescc->condicion_id;
            }
        }
        $condicions = Condicio::find($idCondicions);
        return response()->json(array('condicio'=> $condicions), 200);
    }
}
