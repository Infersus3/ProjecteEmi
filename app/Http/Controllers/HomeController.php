<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD

use Illuminate\Support\Facades\Auth;
=======
use Illuminate\Support\Facades\Auth;

>>>>>>> c7e10acb75ee4a91a98b10f6ddb7ebdb4c18fec1

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        echo Auth::user()->email;exit();
        return view('home');
    }
}
