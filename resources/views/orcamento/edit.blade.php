@extends('layouts.app')

@section('content')
@php
    use App\Models\User;
    $user = User::find(auth()->user()->id);   
@endphp
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h3><i class="fas fa-coins text-primary"></i>&nbsp;
                @if ($user->hasRole('reparador'))
                    Informar orçamento
                @else
                    Editar orçamento
                @endif
            </h3>         
        </div>
    </div>
    <div class="card">
      <div class="card-body">
  <form method="post" id="editarOrcamento">
  @csrf  
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
                <label for="DescricaoProblema">Descrição do problema do celular (Cliente)</label>
                <textarea @cannot('gerenciar orcamento') disabled @endcannot class="form-control" id="DescricaoProblema" rows="4" required name="descricao_problema">{{$orcamento->descricao_problema}}</textarea>
            </div>
        </div>
    </div> 
    @can('informar orcamento')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="DescricaoServico">Descrição do serviço a ser executado (Reparador)</label>
                    <textarea class="form-control" id="DescricaoServico" rows="4" required name="descricao_problema_reparador">{{ $orcamento->descricao_problema_reparador }}</textarea>
                </div>
            </div>
        </div> 
        <hr>
        <div class="row">
            <div class="col-md-12">
                <label for="">Valor estimado (R$)</label>
                <input type="text" class="form-control number" id="ValorEstimado" required="true" name="valor_orcamento" value="{{ $orcamento->valor_orcamento }}">
            </div>
        </div> 
    @endcan
    <br>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-success float-right"><i class="fas fa-check"></i>&nbsp;Salvar</button>
        </div>
    </div>
  </form>
</div>
</div>
@endsection

@push('javascript')
<script>
    $(document).ready(function(){
        $('.number').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) event.preventDefault();
        });
    })

    $('#editarOrcamento').submit(function(e){
        e.preventDefault()
        // Temporariamente destrancando TODOS os campos para enviar os dados
        var disabled = $(this).find(':input:disabled').removeAttr('disabled');
        var serializedData = $(this).serialize();
        disabled.attr('disabled', 'disabled');

        $.ajax({
            url: "{{ route('orcamento.update', $orcamento->id) }}",
            method: 'put',
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
                    confirmButtonText: 'Ver este orçamento',
                    cancelButtonText: 'Voltar aos orçamentos'
                }).then((result) => {
                    if (result.value) {
                        $(location).attr('href',response.route);
                    } else {
                        $(location).attr('href', "{{ route('orcamento.index') }}")
                    }
                })
            } else {
                mostrarErros(response.errors);
            }
            }
        })
    })
    
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