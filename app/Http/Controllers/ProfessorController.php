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

    public function adminPractiques()
    {
        $practiques = Practica::all();
        return view('professor.administrar_practiques', ['practiques' => $practiques]);
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
        $tasques = Tasca::all();
        foreach ($tasques as $tasca) {
            if ($tasca->grup_id == $id) {
                $tasca->delete();
            }
        }
        $grup->delete();
        return redirect()->route('admin_grups');
    }

    public function adminPractica()
    {
        $practica = Practica::all();
        return view('professor.administrar_practiques', ['practica' => $practica]);
    }

    public function creaPractica(Request $request)
    {

        if (isset($request->submit)) {
            $max = CompostQuimics::all();
            $minimCond = false;
            //Primer validem si ha posat les dades correctament
            for ($i = 0; $i < count($max); $i++) {
                $param = 'compost_q' . $i;
                $selected = $request->$param;
                if (isset($selected)) {
                    $minimCond = true;
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
                } else {
                }
            }
            if (!$minimCond) {
                // Si no ha seleccionat ningún compost dels disponibles
                return redirect()->back();
            }
            $validated = $request->validate([
                'nom_mostra' => 'required',
            ]);
            $validated = $request->validate([
                'nom_col' => 'required',
                'alçada_col' => 'required|numeric',
                'temperatura' => 'required',
                'eluent' => 'required',
                'diametre_col' => 'required|numeric',
                'tamany' => 'required|numeric',
                'velocitat' => 'required',
                'detector_uv' => 'required|numeric',
            ]);
            $mostra = Mostra::create([
                'nom' => $request->nom_mostra,
            ]);

            $condicio = Condicio::create([
                'nom_col' => $request->nom_col,
                'alçada_col' => $request->alçada_col,
                'temperatura' => $request->temperatura,
                'eluent' => $request->eluent,
                'diametre_col' => $request->diametre_col,
                'tamany' => $request->tamany,
                'velocitat' => $request->velocitat,
                'detector_uv' => $request->detector_uv,
                'neutre' => $request->neutre,
            ]);

            $visible = 0;
            if ($request->visiblebox) {
                $visible = 1;
            } else {
                $visible = null;
            }
            $professor = Auth::user()->professor_id;
            $practica = Practica::create([
                'professor_id' => $professor,
                'titol' => $request->nom_mostra,
                'data_entrega' => $request->data_entrega,
                'visible' => $visible,
            ]);

            for ($i = 0; $i < count($max); $i++) {
                $param = 'compost_q' . $i;
                $selected = $request->$param;
                if (isset($selected)) {
                    $idCompost = 'idCompost' . $i;
                    $tr = 'temps_retencio' . $i;
                    $alçada = 'alçada_grafic' . $i;
                    $ti = 'temps_inicial' . $i;
                    $tf = 'temps_final' . $i;
                    MostraCondComposts::create([
                        'practica_id' => $practica->id,
                        'mostra_id' => $mostra->id,
                        'condicion_id' => $condicio->id,
                        'compost_quimic_id' => $request->$idCompost,
                        'temps_retencio' => $request->$tr,
                        'alçada_grafic' => $request->$alçada,
                        'temps_inicial' => $request->$ti,
                        'temps_final' => $request->$tf,
                    ]);
                } else {
                }
            }
            return redirect()->route('admin_practicas');
        } else {
            $compost_quimic = CompostQuimics::all();
            return view('professor.crea_practica', ['compost_quimic' => $compost_quimic]);
        }
    }

    public function editaPractica($id, Request $request)
    {
        if (isset($request->submit)) {
            $max = CompostQuimics::all();
            $minimCond = false;
            //Primer validem si ha posat les dades correctament
            for ($i = 0; $i < count($max); $i++) {
                $param = 'compost_q' . $i;
                $selected = $request->$param;
                if (isset($selected)) {
                    $minimCond = true;
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
                } else {
                }
            }
            //Validem els compostos que pot haver editat
            for ($i = 0; $i < count($max); $i++) {
                $param = 'compost_q0' . $i;
                $selected = $request->$param;
                if (isset($selected)) {
                    $minimCond = true;
                    $idCompost = 'idCompost0' . $i;
                    $tr = 'temps_retencio0' . $i;
                    $alçada = 'alçada_grafic0' . $i;
                    $ti = 'temps_inicial0' . $i;
                    $tf = 'temps_final0' . $i;
                    $validated = $request->validate([
                        $tr => 'required|min:0.01|max:255|numeric',
                        $alçada => 'required|min:0.01|max:1000|numeric',
                        $ti => 'required|min:0|max:255|numeric',
                        $tf => 'required|min:0.01|max:255|numeric',
                    ]);
                } else {
                }
            }
            if (!$minimCond) {
                // Si no ha seleccionat ningún compost dels disponibles
                return redirect()->back();
            }
            $validated = $request->validate([
                'nom_mostra' => 'required',
            ]);
            $validated = $request->validate([
                'nom_col' => 'required',
                'alçada_col' => 'required|numeric',
                'temperatura' => 'required',
                'eluent' => 'required',
                'diametre_col' => 'required|numeric',
                'tamany' => 'required|numeric',
                'velocitat' => 'required',
                'detector_uv' => 'required|numeric',
            ]);
            $mos = $request->mostraId;
            $mostra = Mostra::find($mos);
            $cond = $request->condicioId;
            $condicio = Condicio::find($cond);
            $practId = $id;
            $practica = Practica::find($practId);
            $mostra->nom = $request->nom_mostra;
            $condicio->nom_col = $request->nom_col;
            $condicio->alçada_col = $request->alçada_col;
            $condicio->temperatura = $request->temperatura;
            $condicio->eluent = $request->eluent;
            $condicio->diametre_col = $request->diametre_col;
            $condicio->velocitat = $request->velocitat;
            $condicio->detector_uv = $request->detector_uv;
            $condicio->tamany = $request->tamany;
            $condicio->neutre = $request->neutre;
            $practica->data_entrega = $request->data_entrega;
            $practica->visible = $request->visiblebox;
            $practica->save();
            $mostra->save();
            $condicio->save();
            $max = CompostQuimics::all();
            for ($i = 0; $i < count($max); $i++) {
                $param = 'compost_q' . $i;
                $idMostraCondCompost = 'idMostraCondCompost' . $i;
                $selected = $request->$param;
                if (isset($selected)) {
                    $mccObj = MostraCondComposts::find($request->$idMostraCondCompost);
                    $tr = 'temps_retencio' . $i;
                    $alçada = 'alçada_grafic' . $i;
                    $ti = 'temps_inicial' . $i;
                    $tf = 'temps_final' . $i;
                    if ($mccObj) {
                        $mccObj->temps_retencio = $request->$tr;
                        $mccObj->alçada_grafic = $request->$alçada;
                        $mccObj->temps_inicial = $request->$ti;
                        $mccObj->temps_final = $request->$tf;
                        $mccObj->save();
                    }
                } else {
                    $mccObj = MostraCondComposts::find($request->$idMostraCondCompost);
                    if ($mccObj) {
                        $mccObj->delete();
                    }
                }
            }
            for ($i = 0; $i < count($max); $i++) {
                $param = 'compost_q0' . $i;
                $selected = $request->$param;
                if (isset($selected)) {
                    $idCompost = 'idCompost0' . $i;
                    $tr = 'temps_retencio0' . $i;
                    $alçada = 'alçada_grafic0' . $i;
                    $ti = 'temps_inicial0' . $i;
                    $tf = 'temps_final0' . $i;
                    MostraCondComposts::create([
                        'practica_id' => $practica->id,
                        'mostra_id' => $mostra->id,
                        'condicion_id' => $condicio->id,
                        'compost_quimic_id' => $request->$idCompost,
                        'temps_retencio' => $request->$tr,
                        'alçada_grafic' => $request->$alçada,
                        'temps_inicial' => $request->$ti,
                        'temps_final' => $request->$tf,
                    ]);
                }
            }
            return redirect()->route('admin_practicas');
        } else {
            $practica = Practica::find($id);
            $totesmcc = MostraCondComposts::all();
            $arrayComposts = array();
            $mostraGuardar = 0;
            $condicioGuardar = 0;
            foreach ($totesmcc as $param) {
                if ($param->practica_id == $id) {
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

    public function eliminaPractica($id)
    {
        $pract = Practica::find($id);
        Practica::destroy($id);
        $mccid = $pract->mostra_cond_compost_id;
        $mostra_cond_comp = MostraCondComposts::find($mccid);
        $mostra_cond_comp->delete();

        return redirect()->route('admin_practicas');
    }

    public function adminTasca($id)
    {
        $tasquesAll = Tasca::all();
        $tasques = array();
        foreach ($tasquesAll as $tasca) {
            if ($tasca->practica_id == $id) {
                array_push($tasques, $tasca);
            }
        }
        $grups = Grup::all();
        $alumnes = Alumne::all();
        $practica = Practica::find($id);

        return view('professor.assignar_practica', ['tasques' => $tasques, 'grups' => $grups, 'alumnes' => $alumnes, 'practica' => $practica]);
    }

    public function createTasca(Request $request)
    {
        $practicaId = $request->practica_id;
        if (isset($request->grup_id)) {
            Tasca::create([
                'grup_id' => $request->grup_id,
                'practica_id' => $request->practica_id,
            ]);
        } else {
            Tasca::create([
                'alumne_id' => $request->alumne_id,
                'practica_id' => $request->practica_id,
            ]);
        }
        return redirect()->route('admin_tasques', ['id' => $practicaId]);
    }

    public function deleteTasca(Request $request)
    {
        $practicaId = $request->practica_id;
        $tasca = Tasca::find($request->tasca_id);
        $tasca->delete();
        return redirect()->route('admin_tasques', ['id' => $practicaId]);
    }
}
