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
            <h3><i class="fas fa-coins text-primary"></i>&nbsp;Orçamento</li> 
                <span class="status bg-secondary text-light text-md float-right">{{ $status[$orcamento->status] }}</span>
            </h3>         
        </div>
    </div>
    <div class="card">
  <div class="card-body">
  <form action="{{ route('orcamento.solicitar') }}" method="post" id="solicitarOrcamento">
  @csrf
  <div class="row">
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
    
  @if ($orcamento->status == OrdemServico::ORCAMENTO_PENDENTE)
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="DescricaoProblema"><strong>Descrição do problema (relatado pelo cliente)</strong></label>
                <p>
                    {{$orcamento->descricao_problema}}
                </p>
            </div>
        </div>
    </div>
  @endif
  @if ($orcamento->status == OrdemServico::ORCAMENTO_INFORMADO)
  <div class="row">
    <div class="col-md-12">
        <p>
            <strong>Valor estimado:</strong> R$ {{ number_format($orcamento->valor_orcamento, 2, ',', '.') }}
        </p>
    </div>
</div> 
<hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="DescricaoProblema"><strong>Descrição do problema (relatado pelo cliente)</strong></label>
                <p>
                    {{$orcamento->descricao_problema}}
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="DescricaoProblema"><strong>Descrição do problema (relatado pelo reparador)</strong></label>
                <p>
                    {{ $orcamento->descricao_problema_reparador }}
                </p>
            </div>
        </div>
    </div>
@endif 

    @if ($orcamento->status == OrdemServico::ORCAMENTO_PENDENTE)
        <hr>
        <div class="row mt-2">
            <div class="col-md-12">
            @if ($user->can('informar orcamento'))
                <a href="{{ route('orcamento.edit', $orcamento->id) }}" style="margin-left:5px;" class="btn btn-primary float-right"><i class="fas fa-coins"></i>&nbsp;Informar Orçamento</a>
            @endif
            @if ($user->can('gerenciar orcamento'))
                <a onclick="cancelarOrcamento({{$orcamento->id}})" class="btn btn-danger float-right"><i class="fas fa-times-circle"></i>&nbsp;Cancelar Orçamento</a>
            @endif
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