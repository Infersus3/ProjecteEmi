<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\Alumne;
use Illuminate\Http\Request;
use App\Models\CompostQuimics;
use App\Models\Condicio;
use App\Models\Mostra;
use App\Models\MostraCondComposts;
use App\Models\Practica;
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

    public function crearGrup(Request $request)
    {
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

        $compost_quimic = CompostQuimics::all();

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
                'neutre' => $request->neutre,
            ]);

            $max = CompostQuimics::all();
            for ($i = 0; $i < count($max); $i++) {
                $param = 'compost_q' . $i;
                $selected = $request->$param;
                if (isset($selected)) {
                    $idCompost = 'idCompost' . $i;
                    $tr = 'temps_retencio' . $i;
                    $alçada = 'alçada_grafic' . $i;
                    $ti = 'temps_inicial' . $i;
                    $tf = 'temps_final' . $i;
                    $validated = $request->validate([
                        $tr => 'required|min:0.01|max:255|numeric',
                        $alçada => 'required|min:0.01|max:1000|numeric',
                        $ti => 'required|min:0|max:255|numeric',
                        $tf => 'required|min:0.01|max:255|numeric',
                    ]);
                    $mostCondComp = MostraCondComposts::create([
                        'mostra_id' => $mostra->id,
                        'condicion_id' => $condicio->id,
                        'compost_quimic_id' => $request->$idCompost,
                        'temps_retencio' => $request->$tr,
                        'alçada_grafic' => $request->$alçada,
                        'temps_inicial' => $request->$ti,
                        'temps_final' => $request->$tf,
                    ]);
                    // var_dump($request->$idCompost);
                } else {
                }
            }
            $visible = 0;
            if ($request->visiblebox) {
                $visible = 1;
            } else {
                $visible = 0;
            }
            $professor = Auth::user()->professor_id;
            Practica::create([
                'professor_id' => $professor,
                'titol' => $request->nom_mostra,
                'mostra_cond_compost_id' => $mostCondComp->id,
                'data_entrega' => $request->data_entrega,
                'visible' => $visible,
            ]);
        } else {
            $compost_quimic = CompostQuimics::all();
            return view('professor.crea_practica', ['compost_quimic' => $compost_quimic]);
        }
    }

    public function veurePractica()
    {
        $practica = Practica::all();
        return view('professor.visualitza_practica', ['practica' => $practica]);
    }

    public function editaPractica($id, Request $request)
    {
        if (isset($request->submit)) {
            $mos = $request->mostraId;
            $mostra = Mostra::find($mos);
            $cond = $request->condicioId;
            $condicio = Condicio::find($cond);
            $max = CompostQuimics::all();
            $pract = Practica::find($id);
            for ($i = 0; $i < count($max); $i++) {
                $param = 'compost_q' . $i;
                $selected = $request->$param;
                if (isset($selected)) {
                    $idMostCondCompost = 'idCompost' . $i;
                    $tr = 'temps_retencio' . $i;
                    $alçada = 'alçada_grafic' . $i;
                    $ti = 'temps_inicial' . $i;
                    $tf = 'temps_final' . $i;
                    $validated = $request->validate([
                        $tr => 'required|min:0.01|max:255|numeric',
                        $alçada => 'required|min:0.01|max:1000|numeric',
                        $ti => 'required|min:0|max:255|numeric',
                        $tf => 'required|min:0.01|max:255|numeric',
                    ]);
                    $allmcc = MostraCondComposts::all();
                    $idTempsR = 'temps_retencio' . $i;
                    $idAlçada = 'alçada_grafic' . $i;
                    $idTempsI = 'temps_inicial' . $i;
                    $idTempsF = 'temps_final' . $i;
                    $mccObj = MostraCondComposts::find($request->$idMostCondCompost);
                    foreach ($allmcc as $param) {
                        if ($param->mostra_id == $mos && $param->compost_quimic_id == $mccObj->compost_quimic_id) {
                            $param->temps_retencio = $request->$idTempsR;
                            $param->alçada_grafic = $request->$idAlçada;
                            $param->temps_inicial = $request->$idTempsI;
                            $param->temps_final = $request->$idTempsF;
                            $param->save();
                            // var_dump("FUNCIONA ");
                            // var_dump($param->compost_quimic_id);

                            //var_dump($param->compost_quimic_id  . "Sale callate pls " . $mccObj->compost_quimic_id);
                        } else {
                            // var_dump($mos . "Hola Sale" . $param->mostra_id . $param->mostra_id . $mos);
                            //var_dump($request->$idMostCondCompost);

                            // var_dump("NO FUNCIONA");
                        }
                    }
                    //  var_dump("123123123");
                } else {
                    
                    
                }//var_dump($selected);
            }
            $mostra->nom = $request->nom_mostra;
            $condicio->alçada_col = $request->alçada_col;
            $condicio->temperatura = $request->temperatura;
            $condicio->eluent = $request->eluent;
            $condicio->diametre_col = $request->diametre_col;
            $condicio->velocitat = $request->velocitat;
            $condicio->detector_uv = $request->detector_uv;
            $condicio->tamany = $request->tamany;
            $condicio->neutre = $request->neutre;
            $pract->data_entrega = $request->data_entrega;
            $pract->visible = $request->visiblebox;
            $pract->save();
            $mostra->save();
            $condicio->save();
        } else {
            $practica = Practica::find($id);
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
            $compost_quimic = CompostQuimics::all();

            return view('professor.edita_practica', ['compost_quimic' => $compost_quimic, 'arrayComposts' => $arrayComposts, 'mostra' => $mostra, 'condicio' => $condicio, 'practica' => $practica]);
        }
    }
}
