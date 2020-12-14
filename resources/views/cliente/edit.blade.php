@extends('layouts.app')

@section('content')
<div class="container">
  <form method="post" id="formEditCliente">
  @csrf   
  @method('PUT')
    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <label for="NomeCliente">Nome</label>
          <input  type="text" class="form-control" id="NomeCliente" required="true" name="nome" value= "{{ $cliente->nome }}">                
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="CpfCliente">CPF</label>
          <input  type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value= "{{ $cliente->cpf }}">
        </div>
      </div> 
      <div class="col-md-2">
        <div class="form-group">
          <label for="TelefoneCliente">Número de telefone</label>
          <input  type="text" class="form-control" id="TelefoneCliente" name="numero_tel" value= "{{ $cliente->numero_tel}}">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="CelularCliente">Número de celular</label>
          <input  type="text" class="form-control" id="CelularCliente" name="numero_cel" value= "{{ $cliente->numero_cel}}">
        </div>
      </div>                       
    </div>
    <div class="row"> 
      <div class="col-md-3">
        <div class="form-group">
          <label for="EmailCliente">Email</label>
          <input required type="email" class="form-control" id="EmailCliente" aria-describedby="emailHelp" name="email" value= "{{ $cliente->email}}">
          <small id="emailHelp" class="form-text text-muted">Nós nunca iremos compartilhar o seu e-mail.</small>         
        </div>
      </div>      
      <div class="col-md-6">
        <div class="form-group">
          <label for="EnderecoCliente">Endereço</label>
          <input  type="text" class="form-control" id="EnderecoCliente" required="true" name="endereco" value= "{{ $cliente->endereco}}">
        </div>
      </div>                   
    </div>
    <div class="row">
      <div class="col-md-2">
          <button type="submit" class="btn btn-success">Salvar alterações</button>
      </div>            
    </div>
    </div>
  </form>
</div>
@endsection

@push('javascript')
<script>
 $('#formEditCliente').submit(function(e){
  e.preventDefault();
   var serializedData = $(this).serialize();

  $.ajax({
    url: "{{ route('cliente.update', $cliente->id) }}",
    method: 'put',
    dataType: 'json',
    data: serializedData,
    success: function (response) {
      console.log(response)
      if(response.success) {
        Swal.fire({
          title: 'Cliente editado com sucesso!',
                text: response.message,
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#888',
                confirmButtonText: 'Ver cliente editado',
                cancelButtonText: 'Cadastrar outro cliente'
        }).then((result) => {
          if(result.value) {
            $(location).attr('href', response.route);
          } else {
            //limparFormulario()
          }
        })
      } else {
        mostrarErros(response.errors);
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
        title: 'Erro ao tentar realizar operação',
        html: errors,
        icon: 'error',
    })
}
</script>
@endpush