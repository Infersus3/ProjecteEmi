<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MostraCondComposts;
use App\Models\Condicio;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function returnCond($id, Request $request){
        if ($request->_token){
        $mostra_cond_compost = MostraCondComposts::all();
        $idCondicions = 0;
        foreach ($mostra_cond_compost as $mostrescc){
            if ($mostrescc->practica_id == $id){
                $idCondicions = $mostrescc->condicion_id;
            }
        }
        $condicions = Condicio::find($idCondicions);
        return response()->json(array('condicio'=> $condicions), 200);
        }else{
            abort(403, "Sol·licitud denegada");
        }
        
    }
}
