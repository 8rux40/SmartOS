@extends('layouts.app')

@section('content')
<div class="container">
  <form action="{{ route('cliente.create') }}" method="post" id="cadastrarCliente">
  @csrf   
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="NomeCliente">Nome</label>
                <input disabled="disabled" type="text" class="form-control" id="NomeCliente" required="true" name="cliente_nome">                
            </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
              <label for="CpfCliente">CPF</label>
              <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf">
          </div>
      </div> 
      <div class="col-md-2">
          <div class="form-group">
              <label for="TelefoneCliente">Número de telefone</label>
              <input disabled="disabled" type="text" class="form-control" id="TelefoneCliente" name="cliente_numero_tel">
          </div>
      </div>
      <div class="col-md-2">
          <div class="form-group">
              <label for="CelularCliente">Número de celular</label>
              <input disabled="disabled" type="text" class="form-control" id="CelularCliente" name="cliente_numero_cel">
          </div>
      </div>                       
    </div>
    <div class="row"> 
        <div class="col-md-3">
            <div class="form-group">
                <label for="EmailCliente">Email</label>
                <input disabled="disabled" type="email" class="form-control" id="EmailCliente" aria-describedby="emailHelp" name="cliente_email">
                <small id="emailHelp" class="form-text text-muted">Nós nunca iremos compartilhar o seu e-mail.</small>         
          </div>
        </div>      
        <div class="col-md-6">
          <div class="form-group">
              <label for="EnderecoCliente">Endereço</label>
              <input disabled="disabled" type="text" class="form-control" id="EnderecoCliente" required="true" name="cliente_endereco">
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
   $('#cadastrarCliente').submit(function(e){
    e.preventDefault()
    // Temporariamente destrancando TODOS os campos para enviar os dados
    var disabled = $(this).find(':input:disabled').removeAttr('disabled');
    var serializedData = $(this).serialize();
    disabled.attr('disabled', 'disabled');

    $.ajax({
      url: "{{ route('cliente.create') }}",
      method: 'post',
      dataType: 'json',
      data: serializedData,
      success: function (response) {
        console.log(response)
        if (response.success) {
            Swal.fire({
                title: 'Sucesso!',
                text: response.message,
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#888',
                confirmButtonText: 'Ver cliente cadastrado',
                cancelButtonText: 'Cadastrar outro cliente'
            }).then((result) => {
                if (result.value) {
                    $(location).attr('href',response.route);
                } else {
                    //limparFormulario()
                }
            })
        } else {
            //mostrarErros(response.errors);
        }
      }
    })
  })
</script>
@endpush