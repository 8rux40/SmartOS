@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-9">
         <h3><i class="fas fa-coins text-primary"></i>Editar Ordem de Serviço</h3>
    </div>
   </div>
   <div class="card">
    <div class="card-body">
        <form action="" method="post" id="formOrdemServico">
            @csrf 
            <input type="hidden" name="ordemservico_id" value="">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Data da abertura</label>
                        <input disabled="disabled" type="date" name="data_abertura" id="DataOrcamento" class="form-control" required value="{{ $ordem_servico->data_abertura }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="nome" value="{{$ordem_servico->cliente->nome}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Celular</label>
                        <input disabled="disabled" type="text" class="form-control" id="CelularCliente" required="true" name="numero_cel" value="{{$ordem_servico->cliente->numero_cel}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Status</label>
                    <input disabled="disabled" type="text" class="form-control" id="StatusOs" required="true" name="status" value="{{$ordem_servico->status}}">
                </div>
            </div>
            <div class="row">
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="">Termo Garantia</label>
                    <textarea class="form-control" name="termo_garantia" id="TermoGarantia" cols="30" rows="10">{{$ordem_servico->termo_garantia}}</textarea>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="">Descrição Problema (Atendente)</label>
                    <textarea class="form-control" name="descricao_problema" id="DescProblema" cols="30" rows="10">{{$ordem_servico->descricao_problema}}</textarea>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="">Descrição Problema (Reparador)</label>
                    <textarea class="form-control" name="descricao_problema_reparador" id="DescProblemaReparador" cols="30" rows="10">{{$ordem_servico->descricao_problema_reparador}}</textarea>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="">Descrição do serviço executado</label>
                    <textarea class="form-control" name="descricao_servico_executado" id="DescServicoExecutado" cols="30" rows="10">{{$ordem_servico->descricao_servico_executado}}</textarea>
                </div>
            </div>
            <hr>
            <div class="row mt-2">
                <div class="col-md-9">
                    <label for="">Peça</label>
                    <select name="peca_id[]" id="pecas" class="form-control" >
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Qtde. Utilizada</label>
                    <input type="number" id="qtde_utilizada" class="form-control" min="1" value="1" name="quantidade_utilizada[]">
                </div>
                <div class="col-md-1">
                    <label>&nbsp;</label>
                    <button type="button" class="form-control btn btn-primary" onclick="adicionarPeca()"><i class="fas fa-plus"></i>&nbsp;</button>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12" id="pecas_utilizadas">
                    
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="">Valor total</label>
                    <input disabled="disabled" type="text" class="form-control" id="ValorTotal" required="true" name="valor_total" value="{{$ordem_servico->valor_total}}">
                </div>
                <div class="col-md-3">
                    <label for="">Valor Orçamento</label>
                    <input disabled="disabled" type="text" class="form-control" id="ValorOrcamento" required="true" name="valor_orcamento" value="{{$ordem_servico->valor_orcamento}}">
                </div>
                <div class="col-md-3">
                    <label for="">Valor Servico</label>
                    <input disabled="disabled" type="text" class="form-control" id="ValorServico" required="true" name="valor_servico" value="{{$ordem_servico->valor_servico}}">
                </div>
                <div class="col-md-3">
                    <label for="">Data Fechamento</label>
                    <input disabled="disabled" type="text" class="form-control" id="DataFechamento" required="true" name="data_fechamento" value="{{$ordem_servico->data_fechamento}}">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-check"></i>&nbsp;Salvar</button>
                </div>            
            </div>
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
    e.preventDefault()
</script>
@endpush