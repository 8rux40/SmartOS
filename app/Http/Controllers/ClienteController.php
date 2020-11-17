<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verifica se usuário tem permissões de acesso
        $user = User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')) return abort(403);
        
        return view('cliente.index');
    }

    public function getAll(Request $request){
        // Verifica se usuário tem permissões de acesso
        $user = User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')) return abort(403);
        
        return response()->json(
            Cliente::all()
        );
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

        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verifica se usuário tem permissões de acesso
        $user = User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')) return abort(403);

        
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
        if (!$user->can('gerenciar orcamento')) return redirect('home');

        // Verifica se o cliente existe
        $cliente = Cliente::find($id);
        if(!isset($cliente)) redirect('cliente.index');
        
        return view('cliente.info', compact('cliente'));
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
    
        // Verifica se cliente existe
        $cliente = cliente::find($id);
        if (!isset($cliente)) return abort(404);    
            return view('cliente.edit', compact('cliente'));        
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
        //
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
