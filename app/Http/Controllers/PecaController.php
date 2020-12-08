<?php

namespace App\Http\Controllers;

use App\Models\Peca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PecaController extends Controller
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
        // Verifica se usuário tem permissões de acesso          
        
        return response()->json(
            Peca::all()
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
        
        return view('peca.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('peca.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verifica se usuário tem permissões de

        $validator = Validator::make(
            $request->all(), [
                'titulo' => 'required|string',
                'codigo' => 'string|unique:pecas|required',
                'preco' => 'required|numeric|min:0',
                'quantidade_pecas' => 'required|numeric|min:0',
                'descricao' => 'required|string'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()->toArray(),
                'data'=>$request->all()
            ])->setStatusCode(201);
        }

        $peca = new Peca();
        $peca->fill($request->only(['titulo',
        'codigo',
        'preco',
        'quantidade_pecas',
        'descricao']));
        $peca->save();

        return response()->json([
            'success' => true,
            'message' => 'Peça cadastrada com sucesso.',
            'route' => route('peca.edit',$peca->id)
        ]);
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
    
        // Verifica se peça existe
        $peca = peca::find($id);
        if (!isset($peca)) return abort(404);    
            return view('peca.edit', compact('peca'));        
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
        // Verifica se usuário tem permissões de acesso   
        
        // Verifica se peça existe
        $peca = peca::find($id);
        if (!isset($peca)) return abort(404); 

        $validator = Validator::make(
            $request->all(), [
                'titulo' => 'required|string',
                'preco' => 'required|numeric|min:0',
                'quantidade_pecas' => 'required|numeric|min:0',
                'descricao' => 'required|string'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()->toArray(),
                'data'=>$request->all()
            ])->setStatusCode(201);
        }

        $peca->fill($request->only([
            'titulo',
            'preco',
            'quantidade_pecas',
            'descricao'
        ]));

        $peca->save();

        return response()->json([
            'success' => true,
            'message' => 'Peça alterada com sucesso.',
            'route' => route('peca.edit', $peca->id)
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
        //
    }
}
