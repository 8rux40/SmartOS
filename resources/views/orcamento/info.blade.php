@extends('layouts.app')

@section('content')

@php
    $status = [
        1 => 'Orçamento pendente',
        2 => 'Aguardando OS',
        3 => 'Aberta',
        4 => 'Concluída',
        5 => 'Cancelada',
    ];
@endphp

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h3><i class="fas fa-coins text-primary"></i>&nbsp;Orçamento</li> </h3>         
        </div>
    </div>
    <div class="card">
  <div class="card-body">
  <form action="{{ route('orcamento.solicitar') }}" method="post" id="solicitarOrcamento">
  @csrf
  <div class="row">
    <div class="col-md-12 form-group">
        <h4 class="bg-dark text-light form-control">
            Status: {{ $status[$orcamento->status] }}
        </h4>
    </div>
</div>
  <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="NomeCliente">Nome do cliente</label>
            <input disabled="disabled" type="text" class="form-control" id="NomeCliente" required="true" name="cliente_nome" 
            value="{{ $orcamento->cliente->nome}}">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="CpfCliente">CPF</label>
            <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" 
            value="{{ $orcamento->cliente->cpf}}">
        </div>
    </div> 
    <div class="col-md-2">
        <div class="form-group">
            <label for="TelefoneCliente">Número de telefone</label>
            <input disabled="disabled" type="text" class="form-control" id="TelefoneCliente" name="cliente_numero_tel" 
            value="{{ $orcamento->cliente->numero_tel}}">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="CelularCliente">Número de celular</label>
            <input disabled="disabled" type="text" class="form-control" id="CelularCliente" name="cliente_numero_cel" 
            value="{{ $orcamento->cliente->numero_cel}}">
        </div>
    </div>                       
</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="EnderecoCliente">Endereço</label>
            <input disabled="disabled" type="text" class="form-control" id="EnderecoCliente" required="true" name="cliente_endereco" 
            value="{{ $orcamento->cliente->endereco}}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="EmailCliente">Email</label>
            <input disabled="disabled" type="email" class="form-control" id="EmailCliente" aria-describedby="emailHelp" name="cliente_email" 
            value="{{ $orcamento->cliente->email}}">         
        </div>
    </div>
</div>
<hr>
  <div class="row">
      <div class="col">
          <div class="form-group">
              <label for="MarcaCelular">Marca do celular</label>
              <input disabled="disabled" type="text" class="form-control" id="MarcaCelular" required="true" name="celular_marca" 
              value="{{ $orcamento->celular->marca}}">
          </div>
      </div>
      <div class="col">
          <div class="form-group">
              <label for="ModeloCelular">Modelo do celular</label>
              <input disabled="disabled" type="text" class="form-control" id="ModeloCelular" required="true"  name="celular_modelo" 
              value="{{ $orcamento->celular->modelo}}">
          </div>
      </div>          
      <div class="col-md">
          <div class="form-group">
              <label for="InputImei1">Primeiro Imei do celular</label>
              <input disabled="disabled" type="text" class="form-control" id="InputImei1" name="celular_imei" 
              value="{{ $orcamento->celular->imei}}">
          </div>
      </div> 
      <div class="col-md">
          <div class="form-group">
              <label for="InputImei2">Segundo Imei do celular</label>
              <input disabled="disabled" type="text" class="form-control" id="InputImei2" name="celular_imei2" 
              value="{{ $orcamento->celular->imei2}}">
          </div>
      </div> 
    </div>
  <hr>
  <div class="row">
      <div class="col-md-12">
          <div class="form-group">
              <label for="DescricaoProblema">Descrição do problema (relatado pelo cliente)</label>
              <textarea class="form-control" id="DescricaoProblema" rows="4" disabled="disabled" 
              required name="descricao_problema">{{$orcamento->descricao_problema}}</textarea>
          </div>
      </div>
  </div>
  @if ($orcamento->status == 2)
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="DescricaoServico">Descrição do problema (relatado pelo reparador)</label>
            <textarea disabled class="form-control" id="DescricaoServico" rows="4" required name="descricao_problema_reparador">{{ $orcamento->descricao_problema_reparador }}</textarea>
            </div>
        </div>
    </div>
    <div class="row d-flex align-items-center">
        <div class="col-md-3 d-flex flex-column justify-content-center">
            <label for="">Valor estimado</label>
            <input disabled type="text" class="form-control number" id="ValorEstimado" required="true" name="valor_estimado" value="{{ $orcamento->valor_estimado }}">
        </div>         
    </div> 
  @endif                   
  </form>
</div>
</div>
@endsection

@push('javascript')
<script>
    $('.number').keypress(function(event) {
        if ((event.which != 46  $(this).val().indexOf('.') != -1) && (event.which < 48  event.which > 57)) event.preventDefault();
    });
</script>
@endpush