<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumne;
use App\Models\User;

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
        return view('admin.administrarUsers', ['alumnes' => $alumnes, 'professors' => $professors, 'nousUsers' => $nousUsers]);
    }

    public function addAlumne(Request $request, $id){
        $user = User::find($id);
        Alumne::create([
            'nom' => $user->name, 
            'user_id' => $id
        ]);
        $alumne = Alumne::where('user_id', $id)->get();
        var_dump($alumne[0]);exit(); FES LES RELACIONS PERQUÈ NO VA, els belongs to aquell
        $user->alumne_id = $alumne->id;

        return redirect()->route('administrar');
    }

    public function addProfessor(){

    }
}
