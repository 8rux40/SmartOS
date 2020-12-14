<?php

namespace App\Http\Controllers;

use App\Models\Celular;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            Celular::with('cliente')->get()
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
    public function create($cliente_id)
    {
        // Verifica se usuário tem permissões de acesso
        $user = User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')) return abort(403);

        $cliente = Cliente::find($cliente_id);
        if (!isset($cliente)) return abort(404);

        return view('celular.create', compact('cliente'));
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

        $cliente = Cliente::find($request->input('cliente_id'));
        if (!isset($cliente)) return abort(404);

        $validator = Validator::make(
            $request->all(), [
                'cliente_id' => 'integer|required',
                'imei' => 'string|required|unique:celulares',
                'imei2' => 'string|nullable|unique:celulares',
                'marca' => 'string|required',
                'modelo' => 'string|required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()->toArray(),
                'data'=>$request->all()
            ])->setStatusCode(201);
        }

        $celular = new Celular([
            'cliente_id' => $request->input('cliente_id'),
            'imei' => $request->input('imei'),
            'imei2' => $request->input('imei2'),
            'marca' => $request->input('marca'),
            'modelo' => $request->input('modelo'),
        ]);

        $celular->save();

        return response()->json([
            'success' => true,
            'message' => 'Celular cadastrado para '. $cliente->nome .'.',
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
        $celular = Celular::find($id);
        if (!isset($celular)) return abort(404);
        
        $validator = Validator::make(
            $request->all(), [
                'imei' => 'string',
                'imei2' => 'string|nullable',
                'marca'=> 'required|string',
                'modelo' => 'string',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()->toArray(),
                'data'=>$request->all()
            ])->setStatusCode(201);
        }

        $celular->fill($request->only([
            'imei',
            'imei2',
            'marca',
            'modelo',
        ]));

        $celular->save();

        return response()->json([
            'success' => true,
            'message' => 'Celular alterado com sucesso',
            'route' => route('celular.index')
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Verifica se usuário tem permissões de acesso
        $user = User::find(auth()->user()->id);
        if (!$user->can('gerenciar celulares')){
            return response()->json([
                'success' => false,
                'errors' => ['Você não possui permissão para realizar essa ação.'],
            ])->setStatusCode(201);
        }
        
        $celular = Celular::find($id);
        if (!isset($celular)) return abort(404);

        $celular->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Celular excluído com sucesso',
        ]);
    }
}
