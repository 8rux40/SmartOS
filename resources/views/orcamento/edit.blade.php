@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h3><i class="fas fa-coins text-primary"></i>Edição orçamento</li> </h3>         
        </div>
    </div>
    <div class="card">
      <div class="card-body">
  <form action="" method="post" id="solicitarOrcamento">
  @csrf
  <input type="hidden" name="cliente_id" value="">
  <input type="hidden" name="celular_id" value="">
  <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="NomeCliente">Nome do cliente</label>
            <input disabled="disabled" type="text" class="form-control" id="NomeCliente" required="true" name="cliente_nome" value="">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="CpfCliente">CPF</label>
            <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="">
        </div>
    </div> 
    <div class="col-md-2">
        <div class="form-group">
            <label for="TelefoneCliente">Número de telefone</label>
            <input disabled="disabled" type="text" class="form-control" id="TelefoneCliente" name="cliente_numero_tel" value="">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="CelularCliente">Número de celular</label>
            <input disabled="disabled" type="text" class="form-control" id="CelularCliente" name="cliente_numero_cel" value="">
        </div>
    </div>                       
</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="EnderecoCliente">Endereço</label>
            <input disabled="disabled" type="text" class="form-control" id="EnderecoCliente" required="true" name="cliente_endereco" value="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="EmailCliente">Email</label>
            <input disabled="disabled" type="email" class="form-control" id="EmailCliente" aria-describedby="emailHelp" name="cliente_email" value="">         
        </div>
    </div>
</div>
<hr>
  <div class="row">
      <div class="col">
          <div class="form-group">
              <label for="MarcaCelular">Marca do celular</label>
              <input disabled="disabled" type="text" class="form-control" id="MarcaCelular" required="true" name="celular_marca" value="">
          </div>
      </div>
      <div class="col">
          <div class="form-group">
              <label for="ModeloCelular">Modelo do celular</label>
              <input disabled="disabled" type="text" class="form-control" id="ModeloCelular" required="true"  name="celular_modelo" value="">
          </div>
      </div>          
      <div class="col-md">
          <div class="form-group">
              <label for="InputImei1">Primeiro Imei do celular</label>
              <input disabled="disabled" type="text" class="form-control" id="InputImei1" name="celular_imei" value="">
          </div>
      </div> 
      <div class="col-md">
          <div class="form-group">
              <label for="InputImei2">Segundo Imei do celular</label>
              <input disabled="disabled" type="text" class="form-control" id="InputImei2" name="celular_imei2" value="">
          </div>
      </div> 
    </div>
  <hr>
  <div class="row">
      <div class="col-md-12">
          <div class="form-group">
              <label for="DescricaoProblema">Descrição do problema do celular</label>
              <textarea class="form-control" id="DescricaoProblema" rows="4" required name="descricao_problema"></textarea>
          </div>
      </div>
  </div> 
  <div class="row">
      <div class="col-md-12">
          <button type="submit" class="btn btn-success float-right"><i class="fas fa-check"></i>&nbsp;Salvar alterações</button>
      </div>            
  </div>             
  </form>
</div>
</div>
@endsection

@push('javascript')
@endpush