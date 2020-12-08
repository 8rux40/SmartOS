@extends('layouts.app')

@section('content')

<div class="container">
   <div class="row">
    <div class="col-md-9">
         <h3><i class="fas fa-coins text-primary"></i>Nova Ordem de Serviço</h3>
    </div>
   </div>
   <div class="card">
    <div class="card-body">
        <form method="post" id="formOrdemServico">
            @csrf 
            <input type="hidden" name="ordemservico_id" value="">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Data da abertura</label>
                        <input type="date" name="data_abertura" id="DataOrcamento" class="form-control" disabled required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="{{ $orcamento->cliente->nome }}">
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
                <div class="col-md">
                  <div class="form-group">
                    <label for="InputImei1">Primeiro Imei do celular</label>
                    <input  type="text" class="form-control" id="InputImei1" disabled name="imei" value= "{{ $orcamento->celular->imei }}">
                  </div>
                </div> 
                <div class="col-md">
                  <div class="form-group">
                    <label for="InputImei2">Segundo Imei do celular</label>
                    <input  type="text" class="form-control" id="InputImei2" disabled name="imei2" value= "{{ $orcamento->celular->imei2 }}">
                  </div>
                </div> 
                <div class="col">
                  <div class="form-group">
                    <label for="MarcaCelular">Marca do celular</label>
                    <input  type="text" class="form-control" id="MarcaCelular" disabled name="marca" value= "{{$orcamento->celular->marca}}">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="ModeloCelular">Modelo do celular</label>
                    <input type="text" class="form-control" id="ModeloCelular" disabled name="modelo" value= "{{$orcamento->celular->modelo}}">
                  </div>
                </div>
              </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Status</label>
                    <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="">
                </div>                
                <div class="col-md-4">
                    <label for="">Termo de garantia</label>
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
    $(document).ready(function(){
        $('#DataOrcamento').val(moment().format('yyyy-MM-DD'));
    })
    $('#formOrdemServico').submit(function(e){
    e.preventDefault()
    // Temporariamente destrancando TODOS os campos para enviar os dados
    var disabled = $(this).find(':input:disabled').removeAttr('disabled');
    var serializedData = $(this).serialize();
    disabled.attr('disabled', 'disabled');

    $.ajax({
      url: "{{ route('ordemservico.store') }}",
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
                confirmButtonText: 'Ver ordem de serviço',
                cancelButtonText: 'Voltar aos orçamentos'
            }).then((result) => {
                if (result.value) {
                    $(location).attr('href',response.route);
                } else {
                    $(location).attr('href', "{{ route('orcamento.index') }}")
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