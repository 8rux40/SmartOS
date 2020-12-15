<?php

namespace App\Http\Controllers;

use App\Models\Celular;
use App\Models\Cliente;
use App\Models\OrdemServico;
use App\Models\Peca;
use App\Models\PecaUtilizada;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

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
        //Verifica permissão
        
        return response()->json( OrdemServico::where('status', '>=', OrdemServico::ABERTA)->get() );
    }

    public function getAbertas(Request $request){
        // Verifica permissão
        
        return response()->json( OrdemServico::with(['celular', 'cliente'])->where('status', OrdemServico::ABERTA)->get() );
    }

    public function getConcluidas(Request $request){
        // Verifica permissão
        
        return response()->json( OrdemServico::with(['celular', 'cliente'])->where('status', OrdemServico::CONCLUIDA)->get() );
    }

    public function getCanceladas(Request $request){
        // Verifica permissão
        
        return response()->json( OrdemServico::with(['celular', 'cliente'])->where('status', OrdemServico::CANCELADA)->get() );
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
        // Verifica se usuário tem permissões de acesso
        $user = User::find(auth()->user()->id);
        if (!$user->can('fechar os')){
            return abort(403);
        }

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
        // Verifica se usuário tem permissões de acesso   
        $user = User::find(auth()->user()->id);
        if (!$user->can('fechar os')) 
        return response()->json([
            'success' => false,
            'errors' => ['Você não possui permissão para realizar essa ação.'],
            'route' => route('ordemservico.index')
        ])->setStatusCode(201);

        // Verifica se a OS existe
        $os = OrdemServico::find($id);
        if (!isset($os)) return abort(404);

        // Restringe fechar OS apenas para OS que estão abertas
        if ($os->status != OrdemServico::ABERTA) {
            return redirect()->route('ordemservico.index');
        }

        $validator = Validator::make(
            $request->all(), [
                'descricao_servico_executado'=> 'string',
                'valor_total' => 'numeric|min:0',
                'valor_servico' => 'numeric|min:0',
                'termo_garantia' => 'string|nullable',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()->toArray(),
                'data'=>$request->all()
            ])->setStatusCode(201);
        }

        // Zera os valores para iniciar os cálculos
        $valor_pecas = 0.0;
        $valor_total = 0.0;
        $valor_servico = $request->input('valor_servico') * 1.0;

        // Peças utilizadas no serviço
        foreach ($request->input('peca_utilizada_id') as $peca_index => $value) {
            $peca = Peca::find($value);
            if(!isset($peca)) return response()->json([
                'errors'=> ['Ocorreu um erro ao tentar encontrar uma das peças. Atualize a página e tente novamente.'],
                'data'=>$request->all()
            ])->setStatusCode(201);
            $peca_utilizada = new PecaUtilizada();
            $peca_utilizada->quantidade_utilizada = $request->input('quantidade_utilizada')[$peca_index];
            $peca_utilizada->peca()->associate($peca);
            $peca_utilizada->ordemServico()->associate($os);
            $peca_utilizada->save();
            
            // Contabiliza o valor da peça no total de peças utilizadas
            $valor_pecas += $peca->preco * $peca_utilizada->quantidade_utilizada * 1.0;
        }

        // Contabiliza o valor das peças utilizadas no total da OS
        $valor_total += $valor_pecas; 
        // Contabiliza o valor dos servico informado
        $valor_total += $valor_servico;

        // Grava os valores no BD
        $os->status = OrdemServico::CONCLUIDA;
        $os->valor_pecas = $valor_pecas;
        $os->valor_total = $valor_total;
        $os->valor_servico = $valor_servico;
        $os->data_fechamento = Carbon::now();
        
        if ( $user->can('editar termo de garantia') ) {
            $os->termo_garantia = $request->input('termo_garantia');
        }

        $os->descricao_servico_executado = $request->input('descricao_servico_executado');
        $os->save();

        return response()->json([
            'success' => true,
            'message' => 'OS alterado com sucesso',
            'route' => route('ordemservico.show', $id)
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

    public function cancelar($id){
        // Verifica se usuário tem permissões de acesso
        $user = User::find(auth()->user()->id);
        if (!$user->can('cancelar os')){
            return response()->json([
                'success' => false,
                'errors' => ['Você não possui permissão para realizar essa ação.'],
            ])->setStatusCode(201);
        }
        
        // Verifica se o orçamento existe
        $os = OrdemServico::find($id);
        if (!isset($os)) return abort(404);

        // Certifica que o OS está ABERTA
        if ( $os->status != OrdemServico::ABERTA ) return abort(404);
        
        $os->status = OrdemServico::CANCELADA;
        $os->data_cancelamento = Carbon::now();
        $os->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Orçamento cancelada com sucesso',
        ]);
    }
}
