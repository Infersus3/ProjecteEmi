<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumne;
use App\Models\Professor;
use App\Models\User;
use App\Models\Tasca;


class AdminController extends Controller
{
    public function administrarUsers()
    {
       $alumnes = array();
       $professors = array();
       $nousUsers = array();
       foreach (User::all() as $user){
            if ($user->alumne_id != null){
                array_push($alumnes, $user);
            }else if ($user->professor_id != null){
                array_push($professors, $user);
            }else if ($user->admin == false){
                array_push($nousUsers, $user);
            }else{}

       }
        return view('admin.administrar_users', ['alumnes' => $alumnes, 'professors' => $professors, 'nousUsers' => $nousUsers]);
    }

    public function addAlumne(Request $request, $id){
        $user = User::find($id);
        if ($user->professor_id != null){
            $professor = Professor::find($user->professor_id);
            $user->professor_id = null;
            $user->save();
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

    public function addProfessor(Request $request, $id){
        $user = User::find($id);
        if ($user->alumne_id != null){
            $alumne = ALumne::find($user->alumne_id);
            $tasques = Tasca::all();
            foreach ($tasques as $tasca){
                if ($tasca->alumne_id == $alumne->id){
                    $tasca->delete();
                }
            }
            $user->alumne_id = null;
            $user->save();
            foreach ($alumne->grups as $grup){
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

    public function deleteUser(Request $request, $id){
        $user = User::find($id);
        if ($user->alumne_id != null){
            $alumne = Alumne::find($user->alumne_id);
            $tasques = Tasca::all();
            foreach ($tasques as $tasca){
                if ($tasca->alumne_id == $alumne->id){
                    $tasca->delete();
                }
            }
            $user->alumne_id = null;
            $user->save();
            
            //Treiem l'alumne dels grups que pertanyi
            foreach ($alumne->grups as $grup){
                $grup->alumnes()->detach($alumne->id);
            }
            $alumne->delete();
            $user->delete();
        }else if ($user->professor_id != null){
            $professor = Professor::find($user->professor_id);
            $user->professor_id = null;
            $user->save();
            $professor->delete();
            $user->delete();
        }else{
            $user->delete();
        }
        return redirect()->route('admin_users');
    }
}
