@extends('layouts.app')

@section('content')

@php
    use App\Models\OrdemServico;
    use App\Models\User;

    $user = User::find(auth()->user()->id);

    $status = [
        OrdemServico::ORCAMENTO_PENDENTE => 'Orçamento pendente',
        OrdemServico::ORCAMENTO_INFORMADO => 'Aguardando OS',
        OrdemServico::ABERTA => 'Aberta',
        OrdemServico::CONCLUIDA => 'Concluída',
        OrdemServico::CANCELADA => 'Cancelada',
    ];
@endphp

<div class="container">
   <div class="row">
    <div class="col-md-12">
         <h3>
             <i class="fas fa-clipboard-list text-primary"></i>&nbsp;Ordem de Serviço
             <span class="status bg-secondary text-light text-md float-right">{{ $status[$ordem_servico->status] }}</span>
        </h3>
    </div>
   </div>
   <div class="card">
    <div class="card-body">
        <form action="" method="post" id="formOrdemServico">
            @csrf 
            <input type="hidden" name="ordemservico_id" value="">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Data da abertura</label>
                        <input type="date" name="data_abertura" id="DataOrcamento" class="form-control" disabled required>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <input disabled="disabled" type="text" class="form-control" id="CpfCliente" name="cpf" 
                            value="{{ $ordem_servico->cliente->nome . ' - ' .$ordem_servico->cliente->cpf }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label for="InputImei1">Primeiro Imei do celular</label>
                    <input  type="text" class="form-control" id="InputImei1" disabled name="imei" value= "{{ $ordem_servico->celular->imei }}">
                  </div>
                </div> 
                <div class="col-md">
                  <div class="form-group">
                    <label for="InputImei2">Segundo Imei do celular</label>
                    <input  type="text" class="form-control" id="InputImei2" disabled name="imei2" value= "{{ $ordem_servico->celular->imei2 }}">
                  </div>
                </div> 
                <div class="col">
                  <div class="form-group">
                    <label for="MarcaCelular">Marca do celular</label>
                    <input  type="text" class="form-control" id="MarcaCelular" disabled name="marca" value= "{{$ordem_servico->celular->marca}}">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="ModeloCelular">Modelo do celular</label>
                    <input type="text" class="form-control" id="ModeloCelular" disabled name="modelo" value= "{{$ordem_servico->celular->modelo}}">
                  </div>
                </div>
            </div>
            
            <hr>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for=""><strong>Descrição Problema (relatado pelo Cliente)</strong></label>
                    <p>
                        {{ $ordem_servico->descricao_problema }} 
                    </p>
                </div>
                <div class="col-md-6">
                    <label for=""><strong>Descrição do serviço a ser executado (Reparador)</strong></label>
                    <p>
                        {{ $ordem_servico->descricao_problema_reparador }}
                    </p>
                </div>
            </div>
            @if ($ordem_servico->status == OrdemServico::CONCLUIDA)
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label for=""><strong>Descrição do serviço executado</strong></label>
                        <p>
                            {{ $ordem_servico->descricao_servico_executado }}
                        </p>
                    </div>
                </div>
                <hr>
                <h4>Peças utilizadas</h4>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Peça</th>
                                    <th>Qtde. utilizada</th>
                                    <th>Vl. Unitário</th>
                                    <th>Vl. Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($ordem_servico->pecasUtilizadas) < 1)
                                    <tr>
                                        <td colspan="4">Nenhuma peça utilizada</td>
                                    </tr>
                                @else
                                    @foreach ($ordem_servico->pecasUtilizadas as $peca_utilizada)
                                        <tr>
                                            <td>{{ $peca_utilizada->peca->codigo ." - ". $peca_utilizada->peca->titulo}}</td>
                                            <td>{{ $peca_utilizada->quantidade_utilizada }}</td>
                                            <td>R$ {{ number_format(($peca_utilizada->peca->preco * 1.0), 2, ',', '.') }}</td>
                                            <td>R$ {{ number_format(($peca_utilizada->peca->preco * $peca_utilizada->quantidade_utilizada * 1.0), 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach  
                                @endif     
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="">Valor Orçamento (R$)</label>
                        <input disabled="disabled" type="text" class="form-control number" id="valor_orcamento" name="valor_orcamento" value="{{number_format($ordem_servico->valor_orcamento, 2, ',', '.')}}">
                    </div>
                    <div class="col-md-3">
                        <label for="">Valor das Peças (R$)</label>
                        <input disabled type="text" class="form-control number" id="valor_pecas" required="true" name="valor_pecas" value="{{ number_format($ordem_servico->valor_pecas, 2, ',', '.') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="">Valor do Serviço (R$)</label>
                        <input type="text" class="form-control number" id="valor_servico" required="true" name="valor_servico" value="{{number_format($ordem_servico->valor_servico, 2, ',', '.')}}">
                    </div>
                    <div class="col-md-3">
                        <label for="">Valor total (R$)</label>
                        <input disabled type="text" class="form-control number" id="valor_total" required="true" name="valor_total" value="{{number_format($ordem_servico->valor_total, 2, ',', '.')}}">
                    </div>
                </div>
            @endif
            <hr>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for=""><strong>Termo de garantia</strong></label>
                    <p class="text-justify">
                        {{$ordem_servico->termo_garantia}}
                    </p>
                </div>
            </div>
            @if ($ordem_servico->status == OrdemServico::ABERTA)
                <hr>
                <div class="row mt-2">
                    <div class="col-md-12">
                    @if ($user->can('fechar os'))
                        <a href="{{ route('ordemservico.edit', $ordem_servico->id) }}" style="margin-left:5px;" class="btn btn-primary float-right"><i class="fas fa-check"></i>&nbsp;Finalizar OS</a>
                    @endif
                    @if ($user->can('cancelar os'))
                        <a onclick="cancelarOS({{$ordem_servico->id}})" class="btn btn-danger float-right"><i class="fas fa-times-circle"></i>&nbsp;Cancelar OS</a>
                    @endif
                    </div>            
                </div>
            @endif
        </form>
    </div>
   </div>
</div>
@endsection

@push('javascript')
<script>
    $(document).ready(function(){
        $('#DataOrcamento').val(moment().format('yyyy-MM-DD'));
        $('.number').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) event.preventDefault();
        });
        carregarPecas()
    })

    function cancelarOS(){
        // Janela de confirmação pra prevenir engano ao cancelar
    }

    function carregarPecas(){
        $.getJSON("{{ route('peca.getAll') }}", function (data){
            if (Array.isArray(data) && data.length){
                data.forEach(peca => {
                    $('#pecas').append( $('<option value="'+ peca.id +'" valor="'+ peca.preco +'">'+ peca.codigo + ' - ' + peca.titulo +'</option>') )
                }) 
            } 
        })
        $('#pecas option').first().attr('selected','selected')
    }
    
    function adicionarPeca(){

        let valor_pecas = parseFloat($('#pecas option:selected').attr('valor')) * 1.0 * parseInt($('#qtde_utilizada').val());
        let row = 
            `<div class="row" id="peca_peca_rand" style="margin-bottom: 5px;"><div class="col-md-7">
                <input type="hidden" name="peca_utilizada_id[]" value="peca_id">
                <input disabled type="text" class="form-control" value="peca_titulo">
            </div>
            <div class="col-md-2">
                <input disabled type="number" class="form-control" min="1" value="peca_qtde" name="quantidade_utilizada[]">
            </div>
            <div class="col-md-2">
                <input disabled type="text" class="form-control number" id="valor_peca_peca_rand" value="peca_valor">
            </div>
            <div class="col-md-1">
                <button type="button" class="form-control btn btn-danger" onclick="removerPeca('peca_rand')"><i class="fas fa-minus"></i>&nbsp;</button>
            </div></div>`
            .replaceAll( 'peca_id', $('#pecas option:selected').val() )
            .replaceAll( 'peca_rand', Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 7) )
            .replace( 'peca_titulo', $('#pecas option:selected').text() )
            .replace( 'peca_qtde', $('#qtde_utilizada').val())
            .replace( 'peca_valor', valor_pecas) 
        $('#pecas_utilizadas').append( row )
        atualizaValorTotal(valor_pecas)
    }

    function atualizaValorTotal(valor){
        let valor_total = parseFloat($('#valor_pecas').val())
        valor_total += valor
        valor_total = (valor_total < 0) ? 0 : valor_total;
        $('#valor_pecas').val( valor_total )
    }

    function removerPeca(id){
        let valor_removido = parseFloat($('#valor_peca_'+id).val())
        $('#peca_'+id).remove()
        atualizaValorTotal( (0.0 - valor_removido ) )
    }

    $('#formOrdemServico').submit(function(e){
        e.preventDefault();
    });
</script>
@endpush