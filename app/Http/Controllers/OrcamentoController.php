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
            OrdemServico::whereIn('status', [1,2])->with(['cliente','celular'])->get()
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
                    'cliente_id' => 'required|integer',
                    'celular_id' => 'required|integer',
                    'descricao_problema' => 'required|string',
                    'celular_imei' => 'nullable|string',
                    'celular_imei2' => 'nullable|string',
                    'celular_marca' => 'required|string',
                    'celular_modelo' => 'required|string',
                    'cliente_nome' => 'required|string',
                    'cpf' => 'required|string',
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
    
            $cliente = Cliente::find($request->input('cliente_id'));
            if (!isset($cliente)) 
                return response()->json([
                    'success' => false,
                    'message' => 'Não foi possível identificar o cliente!',
                    'route' => route('cliente.show', $request->input('cliente_id'))
                ]);

            $celular = Celular::find($request->input('celular_id'));
            if (!isset($celular)) 
                return response()->json([
                    'success' => false,
                    'message' => 'Não foi possível identificar o celular!',
                    'route' => route('celular.show', $request->input('celular'))
                ]);
    
            $orcamento = new OrdemServico([
                'descricao_problema' => $request->input('descricao_problema'),
                'status' => OrdemServico::ORCAMENTO_PENDENTE,
            ]);
            $orcamento->celular()->associate($celular);
            $orcamento->cliente()->associate($cliente);
            $orcamento->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Orçamento solicitado com sucesso.',
                'route' => route('orcamento.show', $orcamento->id)
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
        $user = User::find(auth()->user()->id);
        //return response()->json(['user'=>$user,'tem_permissao'=>$user->can('consultar orcamento')]);
        if (!$user->can('consultar orcamento') && !$user->can('gerenciar orcamento')){
            return redirect('home');
        }
        return view('orcamento.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($celular_id)
    {
        //Verifica se o usuário possui permissão de acesso
        $user =  User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')) return redirect('orcamento.index');

        //Verifica se o celular existe
        $celular = Celular::with('cliente')->find($celular_id);
        if(!isset($celular)) return abort(404);

        $cliente = $celular->cliente;

        return view('orcamento.create', compact(['cliente','celular']));
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
        if (!$user->can('consultar orcamento') && !$user->can('gerenciar orcamento')){
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $user =  User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento')){
            return response()->json([
                'success' => false,
                'message' => 'Você não possui permissão para realizar essa ação.',
                'route' => route('orcamento.index')
            ]);
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
        if (!$user->can('gerenciar orcamento') && !$user->can('informar orcamento')){
            return redirect()->route('orcamento.index');
        } else {
            $orcamento = OrdemServico::with(['cliente', 'celular'])->where('id', $id)->first();
            if (!isset($orcamento)) return redirect()->route('orcamento.index');
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
        // Checa permissões do usuário
        $user = User::find(auth()->user()->id);
        if (!$user->can('gerenciar orcamento') && !$user->can('informar orcamento')){
            return response()->json([
                'success' => false,
                'errors' => ['Você não possui permissão para realizar essa ação.'],
                'route' => route('orcamento.show', $id)
            ])->setStatusCode(201);
        } 

        // Verifica se existe o orçamento ou OS
        $orcamento = OrdemServico::find($id);
        if (!isset($orcamento)) 
            return response()->json([
                'success' => false,
                'errors' => ['Erro ao salvar. Registro não encontrado! (ID: '.$id.')'],
                'route' => route('orcamento.create')
            ])->setStatusCode(201);

        // Verifica se é um orçamento ou OS
        if( $orcamento->status != OrdemServico::ORCAMENTO_PENDENTE && 
            $orcamento->status != OrdemServico::ORCAMENTO_INFORMADO ) 
            return redirect('ordemservico.edit', compact('orcamento'));
            
        if ( $orcamento->status == OrdemServico::ORCAMENTO_PENDENTE ){
            // editar orçamento pendente
            if ( $user->can('gerenciar orcamento') ){
                $validator = Validator::make(
                    $request->all(), [
                        'descricao_problema' => 'required|string',
                    ]
                );
                if ($validator->fails()) {
                    return response()->json([
                        'errors'=>$validator->errors()->toArray(),
                        'data'=>$request->all()
                    ])->setStatusCode(201);
                }
                $orcamento->descricao_problema = $request->input('descricao_problema');        
                $orcamento->save();
            }
        }

        // informar orçamento
        if ( $user->can('informar orcamento') ){
            $validator = Validator::make(
                $request->all(), [
                    'descricao_problema_reparador' => 'required|string',
                    'valor_orcamento' => 'required|numeric|min:0'
                ]
            );
            if ($validator->fails()) {
                return response()->json([
                    'errors'=>$validator->errors()->toArray(),
                    'data'=>$request->all()
                ])->setStatusCode(201);
            }
            $orcamento->descricao_problema_reparador = $request->input('descricao_problema_reparador');        
            $orcamento->valor_orcamento = $request->input('valor_orcamento');  
            $orcamento->status = OrdemServico::ORCAMENTO_INFORMADO;
            $orcamento->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Alterações salvas com sucesso!',
            'route' => route('orcamento.show',$orcamento->id)
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
        if (!$user->can('gerenciar orcamento')){
            return response()->json([
                'success' => false,
                'errors' => ['Você não possui permissão para realizar essa ação.'],
            ])->setStatusCode(201);
        }
        
        // Verifica se o orçamento existe
        $orcamento = OrdemServico::find($id);
        if (!isset($orcamento)) return abort(404);

        // Certifica que o orçamento não é uma OS
        if ($orcamento->status != OrdemServico::ORCAMENTO_PENDENTE && $orcamento->status != OrdemServico::ORCAMENTO_INFORMADO) return abort(404);
        
        $orcamento->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Orçamento excluído com sucesso',
        ]);
    }
}
