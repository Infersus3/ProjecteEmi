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
use Illuminate\Support\Facades\Storage;
use DateTime;


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

    public function addAlumneGrup(Request $request)
    {
        $grup = Grup::find($request->idGrup);
        $grup->alumnes()->attach($request->idAlumne);
        return redirect()->route('admin_grups');
    }

    public function deleteAlumneGrup(Request $request)
    {
        $grup = Grup::find($request->idGrup);
        $grup->alumnes()->detach($request->idAlumne);
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
                        $tr => 'required|max:10000|numeric',
                        $alçada => 'required|max:10000|numeric',
                        $ti => 'required|max:10000|numeric',
                        $tf => 'required|max:10000|numeric',
                    ]);
                } else {
                }
            }
            if (!$minimCond) {
                // Si no ha seleccionat ningún compost dels disponibles
                return redirect()->back();
            }
            $validated = $request->validate([
                'nom_mostra' => 'required|max:30',
                'nom_col' => 'required|max:30',
                'alçada_col' => 'required|numeric|max:10000',
                'temperatura' => 'required|max:10000|numeric',
                'eluent' => 'required|max:25',
                'diametre_col' => 'required|numeric|max:10000',
                'tamany' => 'required|numeric|max:10000',
                'velocitat' => 'required|max:20',
                'detector_uv' => 'required|numeric|max:10000',
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
                        $tr => 'required|max:10000|numeric',
                        $alçada => 'required|max:10000|numeric',
                        $ti => 'required|max:10000|numeric',
                        $tf => 'required|max:10000|numeric',
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
                        $tr => 'required|max:10000|numeric',
                        $alçada => 'required|max:10000|numeric',
                        $ti => 'required|max:10000|numeric',
                        $tf => 'required|max:10000|numeric',
                    ]);
                } else {
                }
            }
            if (!$minimCond) {
                // Si no ha seleccionat ningún compost dels disponibles
                return redirect()->back();
            }
            $validated = $request->validate([
                'nom_mostra' => 'required|max:30',
                'nom_col' => 'required|max:30',
                'alçada_col' => 'required|numeric|max:10000',
                'temperatura' => 'required|max:10000|numeric',
                'eluent' => 'required|max:25',
                'diametre_col' => 'required|numeric|max:10000',
                'tamany' => 'required|numeric|max:10000',
                'velocitat' => 'required|max:20',
                'detector_uv' => 'required|numeric|max:10000',
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
        $mostra_id = 0;
        $condicio_id = 0;
        $tasques = Tasca::all();
        $mostra_cond_compostos = MostraCondComposts::all();
        foreach ($mostra_cond_compostos as $mostra_cond){
            if ($mostra_cond->practica_id == $id){
                $mostra_id = $mostra_cond->mostra_id;
                $condicio_id = $mostra_cond->condicion_id;
                $mostra_cond->delete();
            }
        }
        if ($mostra_id){
            Mostra::find($mostra_id)->delete();
        }
        $condicionsDel = array($condicio_id);
        $documents = array($condicio_id);
        foreach ($tasques as $tasca){
            if ($tasca->practica_id == $id){
                array_push($condicionsDel, $tasca->condicion_id);
                array_push($documents, $tasca->document);
                $tasca->delete();
            }
        }
        foreach ($condicionsDel as $condicions_id){
            $cond = Condicio::find($condicions_id);
            if ($cond){
                $cond->delete();
            }
        }
        $pract = Practica::find($id);
        $pract->delete($id);
        
        //Per cada tasca de la pràctica eliminar el document
        foreach ($documents as $doc){
            $urlValida = preg_replace('/storage/', 'public', $doc);
            Storage::delete($urlValida);
        }
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

    public function createCompost(Request $request)
    {
        if (isset($request->submit)) {
            CompostQuimics::create([
                'nom' => $request->nom_compost,
                'formula' => $request->formula,
            ]);
            return redirect()->route('admin_compost');
        } else {
            return view('compost.crear_compost');
        }
    }

    public function eliminaCompost($id)
    {
        CompostQuimics::find($id);
        CompostQuimics::destroy($id);

        return redirect()->route('admin_compost');
    }

    public function adminCompost()
    {
        $compost = CompostQuimics::all();
        $mcc = MostraCondComposts::all();
        return view('compost.administrar_composts', ['compost' => $compost, 'mcc' => $mcc]);
    }

    public function listTasques()
    {
        $professor_id = Auth::user()->professor_id;

        $practique = Practica::orderBy('data_entrega')->get();
        $practiques = array();
        foreach ($practique as $practs) {
            if ($practs->professor_id == $professor_id) {
                array_push($practiques, $practs);
            }
        }

        $date = new DateTime('NOW');
        $data = $date->format('Y-m-d');

        return view('professor.list_tasques', [ 'data' => $data, 'practiques' => $practiques]);
    }

    public function avaluarTasques($id)
    {
        $tasques = Tasca::orderBy('data_lliurament')->get();
        $alumnes = Alumne::all();
        $practica = Practica::find($id);

        $grups = Grup::all();
        $tasquesOrd = array();

        foreach ($tasques as $tasca) {
            if ($tasca->practica_id == $id) {
                array_push($tasquesOrd, $tasca);
            }
        }

        $date = new DateTime('NOW');
        $data = $date->format('Y-m-d');

        return view('professor.avaluar_tasques', [
            'data' => $data, 'practica' => $practica, 'tasquesOrd' => $tasquesOrd, 'grups' => $grups, 'alumnes' => $alumnes
        ]);
    }

    public function avaluarTasca($id, Request $request)
    {
        $tasca = Tasca::find($id);

        if (isset($request->submit)) {
            $validated = $request->validate([
                'nota' => 'required|max:100|numeric',
            ]);
            $tasca->nota = $request->nota;
            $tasca->save();
            return redirect()->route('list_tasques');
        } else {
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
            if ($tasca->condicion_id) {
                $condicioAlumne = Condicio::find($tasca->condicion_id);
            }

            return view('professor.assignar_nota', [
                'condicioAlumne' => $condicioAlumne, 'compost_quimic' => $compost_quimic, 'tasca' => $tasca,
                'condN' => $condN, 'condicio' => $condicio, 'arrayComposts' => $arrayComposts, 'mostra' => $mostra, 'practica' => $practica
            ]);
        }
    }
}
