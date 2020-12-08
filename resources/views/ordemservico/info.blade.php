@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-9">
         <h3><i class="fas fa-coins text-primary"></i>Ordem de Serviço</h3>
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
                    <label for="">Descrição Problema</label>
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
                    <label for="">Descrição Serviço Executado</label>
                    <textarea class="form-control" name="descricao_servico_executado" id="DescServicoExecutado" cols="30" rows="10">{{$ordem_servico->descricao_servico_executado}}</textarea>
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
</script>
@endpush