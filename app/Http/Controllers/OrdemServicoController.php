<?php

namespace App\Http\Controllers;

use App\Models\Celular;
use App\Models\Cliente;
use App\Models\OrdemServico;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrdemServicoController extends Controller
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
            OrdemServico::where('status', '>',2)->get()
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ordemservico.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create($id)
    // {
    //     // Verifica se usuário tem permissões de acesso   

    //     $orcamento = OrdemServico::with(['cliente', 'celular'])->where('id', $id)->first();
    //     if (!isset($orcamento)) return abort(404);
    //     if( $orcamento->status != OrdemServico::ORCAMENTO_INFORMADO ) 
    //         return abort(403);
    //     return view('ordemservico.create', compact('orcamento'));
    // }

    /**
     * Cria uma ordem de servico a partir de um orçamento aguardando OS
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // Verifica se usuário tem permissões de acesso   
        $user = User::find(auth()->user()->id);
        if (!$user->can('gerar os')) 
        return response()->json([
            'success' => false,
            'errors' => ['Você não possui permissão para realizar essa ação.'],
            'route' => route('ordemservico.index')
        ])->setStatusCode(201);

        // Verifica se o orcamento existe
        $os = OrdemServico::find($id);
        if (!isset($os)) return abort(404);

        // Verifica se o orçamento está aguardando OS
        if( $os->status != OrdemServico::ORCAMENTO_INFORMADO ) return abort(403);

        // Converte orçamento em uma OS
        $os->status = OrdemServico::ABERTA;
        $os->save();

        return response()->json([
            'success' => true,
            'message' => 'Ordem de servico aberta com sucesso!',
            'route' => route('ordemservico.show',$os->id)
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

        // verifica se ordem de servico existe
        $ordem_servico = OrdemServico::with(['pecasUtilizadas'])->where('id', $id)->first();
        if(!isset($ordem_servico)) return abort(404);
        return view('ordemservico.info', compact('ordem_servico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Verifica se ordem de serviço existe
        $ordem_servico = OrdemServico::find($id);
        if (!isset($ordem_servico)) return abort(404);
        else return view('ordemservico.edit', compact('ordem_servico'));
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
