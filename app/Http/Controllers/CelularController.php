<?php

namespace App\Http\Controllers;

use App\Models\Celular;
use App\Models\User;
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

    public function getAll(Request $request){
        return response()->json(
            Celular::all()
        );
    }

    public function create()
    {
        return view('celular.create');        
    }

    public function index()
    {
        return view('celular.index');
    }

  
}
