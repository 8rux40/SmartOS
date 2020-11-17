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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verifica se usuário tem permissões de acesso
        $user = User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')) return abort(403);
        
        return view('celular.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Verifica se usuário tem permissões de acesso
        $user = User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')) return abort(403);

        return view('celular.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Verifica se usuário tem permissões de acesso
        $user = User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')) return abort(403);

        // Verifica se celular existe
        $celular = Celular::find($id);
        if (!isset($celular)) return abort(404);

        return view('celular.info', compact('celular'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Verifica se usuário tem permissões de acesso
        $user = User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')) return abort(403);

        // Verifica se celular existe
        $celular = Celular::find($id);
        if (!isset($celular)) return abort(404);

        return view('celular.edit', compact('celular'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(['success'=> true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
