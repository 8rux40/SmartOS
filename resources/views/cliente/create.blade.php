@extends('layouts.app')

@section('content')
<div class="container">
  <form action="{{ route('cliente.create') }}" method="post" id="create">
  @csrf   
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="NomeCliente">Nome</label>
                <input  type="text" class="form-control" id="NomeCliente" required="true" name="cliente_nome">                
            </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
              <label for="CpfCliente">CPF</label>
              <input  type="text" class="form-control" id="CpfCliente" required="true" name="cpf">
          </div>
      </div> 
      <div class="col-md-2">
          <div class="form-group">
              <label for="TelefoneCliente">Número de telefone</label>
              <input  type="text" class="form-control" id="TelefoneCliente" name="cliente_numero_tel">
          </div>
      </div>
      <div class="col-md-2">
          <div class="form-group">
              <label for="CelularCliente">Número de celular</label>
              <input  type="text" class="form-control" id="CelularCliente" name="cliente_numero_cel">
          </div>
      </div>                       
    </div>
    <div class="row"> 
        <div class="col-md-3">
            <div class="form-group">
                <label for="EmailCliente">Email</label>
                <input  type="email" class="form-control" id="EmailCliente" aria-describedby="emailHelp" name="cliente_email">
                <small id="emailHelp" class="form-text text-muted">Nós nunca iremos compartilhar o seu e-mail.</small>         
          </div>
        </div>      
        <div class="col-md-6">
          <div class="form-group">
              <label for="EnderecoCliente">Endereço</label>
              <input  type="text" class="form-control" id="EnderecoCliente" required="true" name="cliente_endereco">
          </div>
        </div>                   
    </div>
    <div class="row">
      <div class="col-md-2">
          <button type="submit" class="btn btn-primary">Cadastrar cliente</button>
      </div>            
    </div>
    </div>
  </form>
</div>
@endsection

@push('javascript')
<script>
 
</script>
@endpush