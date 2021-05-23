<?php

namespace App\Http\Controllers;


use App\Models\Alumne;
use App\Models\Practica;
use Illuminate\Http\Request;
use App\Models\CompostQuimics;
use App\Models\Condicio;
use App\Models\Mostra;
use App\Models\Grup;
use App\Models\Tasca;
use App\Models\MostraCondComposts;
use Illuminate\Support\Facades\Auth;
use DateTime;


class AlumneController extends Controller
{

    public function listTasques()
    {
        $alumne_id = Auth::user()->alumne_id;
        $alumne = Alumne::find($alumne_id);
        $tasques = Tasca::all();

        $practiques = Practica::orderBy('data_entrega')->get();

        $tasquesAlumne = array();
        foreach ($tasques as $tasca) {
            if ($tasca->alumne_id == $alumne_id) {
                array_push($tasquesAlumne, $tasca);
            }
        }

        //Mirem si pertany a grups que tinguin altres tasques
        foreach ($tasques as $tasca) {
            foreach ($alumne->grups as $grup) {
                if ($tasca->grup_id == $grup->id) {
                    array_push($tasquesAlumne, $tasca);
                }
            }
        }
        $date = new DateTime('NOW');
        $data = $date->format('Y-m-d');

        return view('alumne.administrar_tasques', ['tasques' => $tasquesAlumne, 'data' => $data, 'practiques' => $practiques, 'alumne' => $alumne]);
    }

    public function realitzaTasca($id, Request $request)
    {
        if (isset($request->submit)) {
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
                'doc' => 'max:10000'
            ]);
            if (!is_string($request->doc) && $request->doc != null) {
                if (strlen($request->doc->getClientOriginalName()) > 100) {
                    // Si el document té un nom superior a 100 caràcters.
                    return redirect()->back();
                }
            }

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
                if ($tasca->condicion_id != $condicioGuardar) {
                    $condicioActual = Condicio::find($tasca->condicion_id);
                    if ($condicioActual) {
                        $tasca->condicion_id = null;
                        $tasca->save();
                        $condicioActual->delete();
                    }
                } else {
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
            $date = new DateTime('NOW');
            $data = $date->format('Y-m-d H:i:s');
            $tasca->data_lliurament = $data;

            //Guardem el arxiu a 'documents' i li posem el nom de doc_<id_alumne>_<data_hora_segons>
            if ($request->doc) {
                if (!is_string($request->doc) && $request->doc != null) {
                    $nomFile = $request->doc->getClientOriginalName();
                    $dataFile = explode(' ', $data);
                    $name = Auth::user()->name;
                    if (!$tasca->alumne_id) {
                        $name = Grup::find($tasca->grup_id)->nom;
                    }
                    $url = $request->file('doc')->storeAs('public', $name . '_' . $dataFile[0] . '_' . $dataFile[1] . '_' . $nomFile);
                    $urlValida = preg_replace('/public/', 'storage', $url);
                    $tasca->document = $urlValida;
                } else {
                    $tasca->document = $request->doc;
                }
            }
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
            if ($tasca->condicion_id) {
                $condicioAlumne = Condicio::find($tasca->condicion_id);
            }
            $date = new DateTime('NOW');
            $data = $date->format('Y-m-d');

            return view('alumne.fer_practica', [
                'condicioAlumne' => $condicioAlumne, 'compost_quimic' => $compost_quimic, 'tasca' => $tasca,
                'condN' => $condN, 'condicio' => $condicio, 'arrayComposts' => $arrayComposts, 'mostra' => $mostra, 'practica' => $practica, 'data' => $data
            ]);
        }
    }
}
