<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CelularController extends Controller
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
    public function create()
    {
        return view('celular.create');
    }

    public function index() {
        return view('celular.index');
    }    
}
