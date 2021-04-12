<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    //
    public function index()
    {
        //echo Auth::user()->email;
        return view('professor.CreaTasques');
    }
}
