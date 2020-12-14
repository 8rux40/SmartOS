@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9">
        <h3><i class="fas fa-mobile-alt text-primary"></i> Novo celular</li> </h3>         
    </div>
  </div>
<div class="card">
  <div class="card-body">
  <form method="post" id="formCreateCelular">
  @csrf   
  <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
  <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="NomeCliente">Nome do cliente</label>
            <input disabled="disabled" type="text" class="form-control" id="NomeCliente" required="true" name="cliente_nome" value="{{ $cliente->nome }}">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="CpfCliente">CPF</label>
            <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="{{ $cliente->cpf }}">
        </div>
    </div> 
    <div class="col-md-2">
        <div class="form-group">
            <label for="TelefoneCliente">Número de telefone</label>
            <input disabled="disabled" type="text" class="form-control" id="TelefoneCliente" name="cliente_numero_tel" value="{{ $cliente->numero_tel }}">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="CelularCliente">Número de celular</label>
            <input disabled="disabled" type="text" class="form-control" id="CelularCliente" name="cliente_numero_cel" value="{{ $cliente->numero_cel }}">
        </div>
    </div>                       
</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="EnderecoCliente">Endereço</label>
            <input disabled="disabled" type="text" class="form-control" id="EnderecoCliente" required="true" name="cliente_endereco" value="{{ $cliente->endereco }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="EmailCliente">Email</label>
            <input disabled="disabled" type="email" class="form-control" id="EmailCliente" aria-describedby="emailHelp" name="cliente_email" value="{{ $cliente->email }}">         
        </div>
    </div>
</div>
<hr>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="MarcaCelular">Marca do celular</label>
          <input  type="text" class="form-control" id="MarcaCelular" required="true" name="marca">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="ModeloCelular">Modelo do celular</label>
          <input type="text" class="form-control" id="ModeloCelular" required="true"  name="modelo">
        </div>
      </div>
      <div class="col-md">
        <div class="form-group">
          <label for="InputImei1">IMEI</label>
          <input  type="text" class="form-control" id="InputImei1" name="imei" required>
        </div>
      </div> 
      <div class="col-md">
        <div class="form-group">
          <label for="InputImei2">IMEI 2 (Opcional)</label>
          <input  type="text" class="form-control" id="InputImei2" name="imei2">
        </div>
      </div> 
    </div>
    <div class="row">
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
 $('#formCreateCelular').submit(function(e){
  e.preventDefault();
   var serializedData = $(this).serialize();

  $.ajax({
    url: "{{ route('celular.store') }}",
    method: 'post',
    dataType: 'json',
    data: serializedData,
    success: function (response) {
      console.log(response)
      if(response.success) {
        Swal.fire({
          title: 'Sucesso!',
                text: response.message,
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Voltar ao cliente',
        }).then((result) => {
          if(result.value) {
            $(location).attr('href', "{{ route('cliente.show', $cliente->id) }}");
          } 
        })
      } else {
        //mostrarErros(response.errors);
      }
    }
  });
 });
 
 function mostrarErros(erros){
  let errors = '<ul>';
  $.each(erros, function(index, value){
    errors += '<li>'+ value +'</li';
  })
  errors += '</ul>';

  Swal.fire({
    title: 'Erro ao editar',
    html: errors,
    icon: 'error',
  })
 }
</script>
@endpush