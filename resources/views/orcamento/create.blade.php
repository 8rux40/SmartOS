@extends('layouts.app')

@section('content')
<div class="container">
  <form action="{{ route('orcamento.solicitar') }}" method="post" id="solicitarOrcamento">
  @csrf
  <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
  <input type="hidden" name="celular_id" value="{{ $celular->id }}">
  <div class="row">
      <div class="col-md">
          <div class="form-group">
              <label for="InputImei1">Primeiro Imei do celular</label>
              <input disabled="disabled" type="text" class="form-control" id="InputImei1" name="celular_imei" value="{{ $celular->imei }}">
          </div>
      </div> 
      <div class="col-md">
          <div class="form-group">
              <label for="InputImei2">Segundo Imei do celular</label>
              <input disabled="disabled" type="text" class="form-control" id="InputImei2" name="celular_imei2" value="{{ $celular->imei2 }}">
          </div>
      </div> 
      <div class="col">
          <div class="form-group">
              <label for="MarcaCelular">Marca do celular</label>
              <input disabled="disabled" type="text" class="form-control" id="MarcaCelular" required="true" name="celular_marca" value="{{ $celular->marca }}">
          </div>
      </div>
      <div class="col">
          <div class="form-group">
              <label for="ModeloCelular">Modelo do celular</label>
              <input disabled="disabled" type="text" class="form-control" id="ModeloCelular" required="true"  name="celular_modelo" value="{{ $celular->modelo }}">
          </div>
      </div>          
  </div>

  <div class="row">
      <div class="col-md-5">
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
      <div class="col-md-7">
          <div class="form-group">
              <label for="EnderecoCliente">Endereço</label>
              <input disabled="disabled" type="text" class="form-control" id="EnderecoCliente" required="true" name="cliente_endereco" value="{{ $cliente->endereco }}">
          </div>
      </div>
      <div class="col-md-5">
          <div class="form-group">
              <label for="EmailCliente">Email</label>
              <input disabled="disabled" type="email" class="form-control" id="EmailCliente" aria-describedby="emailHelp" name="cliente_email" value="{{ $cliente->email }}">
              <small id="emailHelp" class="form-text text-muted">Nós nunca iremos compartilhar o seu e-mail.</small>         
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-7">
          <div class="form-group">
              <label for="DescricaoProblema">Descrição do problema do celular</label>
              <textarea class="form-control" id="DescricaoProblema" rows="4" required name="descricao_problema"></textarea>
          </div>
      </div>
  </div> 
  <div class="row">
      <div class="col-md-2">
          <button type="submit" class="btn btn-primary">Solicitar orçamento</button>
      </div>            
  </div>             
  </form>
@endsection

@push('javascript')
<script>
  $('#solicitarOrcamento').submit(function(e){
    e.preventDefault()
    // Temporariamente destrancando TODOS os campos para enviar os dados
    var disabled = $(this).find(':input:disabled').removeAttr('disabled');
    var serializedData = $(this).serialize();
    disabled.attr('disabled', 'disabled');

    $.ajax({
      url: "{{ route('orcamento.solicitar') }}",
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
                confirmButtonText: 'Ver orçamento cadastrado',
                cancelButtonText: 'Cadastrar outro orçamento'
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