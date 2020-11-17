@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-9">
         <h3><i class="fas fa-coins text-primary"></i> Nova Ordem de Serviço</h3>
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
                        <input disabled="disabled" type="date" name="" id="DataOrcamento" class="form-control" required value="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Celular</label>
                        <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Status</label>
                    <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="">
                </div>
                <div class="col-md-4">
                    <label for="">Horas Trabalhadas</label>
                    <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="">
                </div>
                <div class="col-md-4">
                    <label for="">Termo Garantia</label>
                    <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="">Descrição Problema</label>
                    <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="">Descrição Serviço Executado</label>
                    <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="">Valor total</label>
                    <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="">
                </div>
                <div class="col-md-3">
                    <label for="">Valor Orçamento</label>
                    <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="">
                </div>
                <div class="col-md-3">
                    <label for="">Valor Hora</label>
                    <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="">
                </div>
                <div class="col-md-3">
                    <label for="">Data Fechamento</label>
                    <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="">
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