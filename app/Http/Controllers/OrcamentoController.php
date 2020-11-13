<?php

namespace App\Http\Controllers;

use App\Models\Celular;
use App\Models\Cliente;
use App\Models\OrdemServico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrcamentoController extends Controller
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
            OrdemServico::whereIn('status', [1,2])->get()
        );
    }

    public function solicitarOrcamento(Request $request){
        $user =  User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')){
            return response()->json([
                'success' => false,
                'message' => 'Você não possui permissão para realizar essa ação.',
                'route' => route('orcamento.create')
            ]);
        } else {
            $validator = Validator::make(
                $request->all(), [
                    'descricao_problema' => 'required|string',
                    'celular_imei' => 'nullable|string',
                    'celular_imei2' => 'nullable|string',
                    'celular_marca' => 'required|string',
                    'celular_modelo' => 'required|string',
                    'cliente_nome' => 'required|string',
                    'cliente_cpf' => 'required|string|unique:clientes',
                    'cliente_numero_tel' => 'nullable|string',
                    'cliente_numero_cel' => 'nullable|string',
                    'cliente_endereco' => 'required|string',
                    'cliente_email' => 'nullable|string|email'
                ]
            );
    
            if ($validator->fails()) {
                return response()->json([
                    'errors'=>$validator->errors()->toArray(),
                    'data'=>$request->all()
                ])->setStatusCode(201);
            }
    
            $cliente = new Cliente([
                'nome' => $request->input('cliente_nome'),
                'cpf' => $request->input('cliente_cpf'),
                'numero_cel' => $request->input('cliente_numero_cel'),
                'numero_tel' => $request->input('cliente_numero_tel'),
                'endereco' => $request->input('cliente_endereco'),
                'email' => $request->input('cliente_emaile')
            ]);
    
            $celular = new Celular([
                'imei' => $request->input('celular_imei'),
                'imei2' => $request->input('celular_imei2'),
                'marca' => $request->input('celular_marca'),
                'modelo' => $request->input('celular_modelo')
            ]);
    
            $orcamento = new OrdemServico([
                'descricao_problema' => $request->input('descricao_problema'),
                'status' => OrdemServico::ORCAMENTO_PENDENTE,
            ]);
            $orcamento->celular()->save($celular);
            $orcamento->cliente()->save($cliente);
            $orcamento->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Orçamento solicitado com sucesso.',
                'route' => route('orcamento.info',$orcamento->id)
            ]);
        } 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user =  User::find(auth()->user()->id);
        if (!$user->can('consultar orcamento')){
            return response()->json([
                'success' => false,
                'message' => 'Você não possui permissão para realizar essa ação.',
                'route' => route('home')
            ]);
        }
        return view('orcamento.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user =  User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')){
            return response()->json([
                'success' => false,
                'message' => 'Você não possui permissão para realizar essa ação.',
                'route' => route('orcamento.index')
            ]);
        }
        return view('orcamento.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =  User::find(auth()->user()->id);
        if (!$user->can('consultar orcamento')){
            return redirect('orcamento.index');
        } else {
            $orcamento = OrdemServico::find($id);
            if (!isset($orcamento)) return redirect('orcamento.index');
            if(
                $orcamento->status != OrdemServico::ORCAMENTO_PENDENTE && 
                $orcamento->status != OrdemServico::ORCAMENTO_INFORMADO
            ) return view('ordemservico.info', compact('orcamento'));
            return view('orcamento.info', compact('orcamento'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')){
            return redirect('orcamento.index');
        } else {
            $orcamento = OrdemServico::find($id);
            if (!isset($orcamento)) return redirect('orcamento.index');
            if(
                $orcamento->status != OrdemServico::ORCAMENTO_PENDENTE && 
                $orcamento->status != OrdemServico::ORCAMENTO_INFORMADO
            ) return view('ordemservico.edit', compact('orcamento'));
            return view('orcamento.edit', compact('orcamento'));
        }
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
        // $user = User::find(auth()->user()->id);
        // if (!$user->can('gerenciar orcamento')){
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Você não possui permissão para realizar essa ação.',
        //         'route' => route('orcamento.info', $id)
        //     ]);
        // } else {
        //     $orcamento = OrdemServico::find($id);
        //     if (!isset($orcamento)) 
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'Erro no cadastro. Registro não encontrado! (ID: '.$id.')',
        //             'route' => route('orcamento.create')
        //         ]);
        // }
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
