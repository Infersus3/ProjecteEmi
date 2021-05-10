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


class AlumneController extends Controller
{
    //
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
    public function realitzaTasca($id, Request $request)
    {
        if (isset($request->submit)) {

            $tasca = Tasca::find($id);
            $practId = $tasca->practica_id;
            $practica = Practica::find($practId);
            $mccId = $practica->mostra_cond_compost_id;
            $mcc = MostraCondComposts::find($mccId);
            $mostraid = $mcc->mostra_id;
            $totesmcc = MostraCondComposts::all();
            $cond = $mcc->condicion_id;
            $condicio = Condicio::find($cond);
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
                $tasca->condicion_id = $cond;
                $tasca->correcta = true;
                $tasca->save();
                return redirect()->route('tasques_alumne');
                //return a la vista de lista tasques
            } else {
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
                return redirect()->route('tasques_alumne');
                //return a una vista de error
            }
        } else {
            $tasca = Tasca::find($id);
            $practId = $tasca->practica_id;
            $practica = Practica::find($practId);
            $mccId = $practica->mostra_cond_compost_id;
            $mcc = MostraCondComposts::find($mccId);
            $mostraid = $mcc->mostra_id;
            $totesmcc = MostraCondComposts::all();
            $arrayComposts = array();
            $mostraGuardar = 0;
            $condicioGuardar = 0;
            foreach ($totesmcc as $param) {
                if ($param->mostra_id == $mostraid) {
                    array_push($arrayComposts, $param);
                    $mostraGuardar = $param->mostra_id;
                    $condicioGuardar = $param->condicion_id;
                }
            }
            $mostra = Mostra::find($mostraGuardar);
            $condicio = Condicio::find($condicioGuardar);
            $condN = $condicio->neutre;
            $compost_quimic = CompostQuimics::all();

            return view('alumne.fer_practica', ['compost_quimic' => $compost_quimic,'tasca' => $tasca, 'condN' => $condN, 'arrayComposts' => $arrayComposts, 'mostra' => $mostra,'practica' => $practica]);
        }
    }
}