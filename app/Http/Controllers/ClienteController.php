<?php

namespace App\Http\Controllers;

use App\Models\Celular;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function getCelulares($id){
        // Verifica se usuário tem permissões de acesso
        $user = User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')) return abort(403);

        $cliente = Cliente::find($id);
        if (!isset($cliente)) return abort(404);

        return response()->json(
            Celular::where('cliente_id', $id)->get()
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

        $validator = Validator::make(
            $request->all(), [
                'nome' => 'required|string',
                'cpf' => 'string|unique:clientes|required',
                'numero_tel' => 'string|nullable',
                'numero_cel' => 'string|nullable',
                'email' => 'required|string|email',
                'endereco' => 'string',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()->toArray(),
                'data'=>$request->all()
            ])->setStatusCode(201);
        }

        $cliente = new Cliente([
            'nome' => $request->input('nome'),
            'cpf' => $request->input('cpf'),
            'numero_cel' => $request->input('numero_cel'),
            'numero_tel' => $request->input('numero_tel'),
            'endereco' => $request->input('endereco'),
            'email' => $request->input('email')
        ]);

        $cliente->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Cliente cadastrado com sucesso.',
            'route' => route('cliente.show',$cliente->id)
        ]);
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
        if(!isset($cliente)) return abort(404);
        
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
        $cliente = Cliente::find($id);
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

    public function delete($id)
    {
        $cliente = Cliente::find($id);

        $cliente->delete();
    }
}
