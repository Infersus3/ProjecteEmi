<?php

namespace App\Http\Controllers;

use App\Models\Alumne;
use App\Models\Professor;
use App\Models\MostraCondComposts;
use App\Models\Mostra;
use App\Models\Condicio;
use App\Models\User;
use App\Models\Tasca;
use App\Models\Practica;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function administrarUsers()
    {
        $alumnes = array();
        $professors = array();
        $nousUsers = array();
        foreach (User::all() as $user) {
            if ($user->alumne_id != null) {
                array_push($alumnes, $user);
            } else if ($user->professor_id != null) {
                array_push($professors, $user);
            } else if ($user->admin == false) {
                array_push($nousUsers, $user);
            } else {
            }
        }
        return view('admin.administrar_users', ['alumnes' => $alumnes, 'professors' => $professors, 'nousUsers' => $nousUsers]);
    }

    public function addAlumne($id)
    {
        $user = User::find($id);
        if ($user->professor_id != null) {
            $professor = Professor::find($user->professor_id);
            $user->professor_id = null;
            $user->save();
            $practiques = Practica::all();
            foreach ($practiques as $practica) {
                if ($practica->professor_id == $professor->id) {
                    $this->eliminaPractica($practica->id);
                }
            }
            $professor->delete();
        }

        $alumne = Alumne::create([
            'nom' => $user->name,
            'user_id' => $id
        ]);
        $user->alumne_id = $alumne->id;
        $user->save();
        return redirect()->route('admin_users');
    }

    public function addProfessor($id)
    {
        $user = User::find($id);
        if ($user->alumne_id != null) {
            $alumne = ALumne::find($user->alumne_id);
            $tasques = Tasca::all();
            foreach ($tasques as $tasca) {
                if ($tasca->alumne_id == $alumne->id) {
                    $tasca->delete();
                }
            }
            $user->alumne_id = null;
            $user->save();
            foreach ($alumne->grups as $grup) {
                $grup->alumnes()->detach($alumne->id);
            }
            $alumne->delete();
        }

        $professor = Professor::create([
            'nom' => $user->name,
            'user_id' => $id,
        ]);
        $user->professor_id = $professor->id;
        $user->save();
        return redirect()->route('admin_users');
    }

    public function deleteUserRol($id)
    {
        $user = User::find($id);
        if ($user->alumne_id != null) {
            $alumne = Alumne::find($user->alumne_id);
            $tasques = Tasca::all();
            foreach ($tasques as $tasca) {
                if ($tasca->alumne_id == $alumne->id) {
                    $tasca->delete();
                }
            }
            $user->alumne_id = null;
            $user->save();

            //Treiem l'alumne dels grups que pertanyi
            foreach ($alumne->grups as $grup) {
                $grup->alumnes()->detach($alumne->id);
            }
            $alumne->delete();
        } else if ($user->professor_id != null) {
            $professor = Professor::find($user->professor_id);
            $user->professor_id = null;
            $user->save();
            $practiques = Practica::all();
            foreach ($practiques as $practica) {
                if ($practica->professor_id == $professor->id) {
                    $this->eliminaPractica($practica->id);
                }
            }
            $professor->delete();
        } else {
            $user->delete();
        }
        return redirect()->route('admin_users');
    }

    public function eliminaPractica($id)
    {
        $mostra_id = 0;
        $condicio_id = 0;
        $tasques = Tasca::all();
        $mostra_cond_compostos = MostraCondComposts::all();
        foreach ($mostra_cond_compostos as $mostra_cond) {
            if ($mostra_cond->practica_id == $id) {
                $mostra_id = $mostra_cond->mostra_id;
                $condicio_id = $mostra_cond->condicion_id;
                $mostra_cond->delete();
            }
        }
        if ($mostra_id) {
            Mostra::find($mostra_id)->delete();
        }
        $condicionsDel = array($condicio_id);
        $documents = array($condicio_id);
        foreach ($tasques as $tasca) {
            if ($tasca->practica_id == $id) {
                array_push($condicionsDel, $tasca->condicion_id);
                array_push($documents, $tasca->document);
                $tasca->delete();
            }
        }
        foreach ($condicionsDel as $condicions_id) {
            $cond = Condicio::find($condicions_id);
            if ($cond) {
                $cond->delete();
            }
        }
        $pract = Practica::find($id);
        $pract->delete($id);

        //Per cada tasca de la pràctica eliminar el document
        foreach ($documents as $doc) {
            $urlValida = preg_replace('/storage/', 'public', $doc);
            Storage::delete($urlValida);
        }
    }
}
