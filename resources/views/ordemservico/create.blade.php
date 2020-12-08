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
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <input disabled="disabled" type="text" class="form-control" id="CpfCliente" name="cpf" 
                            value="{{ $orcamento->cliente->nome . ' - ' .$orcamento->cliente->cpf }}">
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
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="">Descrição Problema (relatado pelo Cliente)</label>
                    <textarea disabled class="form-control" name="" id="" cols="30" rows="6">{{ $orcamento->descricao_problema }} </textarea>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="">Descrição Serviço Executado</label>
                    <textarea class="form-control" name="teste[]" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="">Termo Garantia</label>
                    <textarea class="form-control" name="teste[]" id="" cols="30" rows="6"></textarea>
                </div>
            </div>
            <hr>
            <div class="row mt-2">
                <div class="col-md-9">
                    <label for="">Peça</label>
                    <select name="peca_id[]" id="pecas" class="form-control" >
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Qtde. Utilizada</label>
                    <input type="number" id="qtde_utilizada" class="form-control" min="1" value="1" name="quantidade_utilizada[]">
                </div>
                <div class="col-md-1">
                    <label>&nbsp;</label>
                    <button type="button" class="form-control btn btn-primary" onclick="adicionarPeca()"><i class="fas fa-plus"></i>&nbsp;</button>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12" id="pecas_utilizadas">
                    
                </div>
            </div>
            <hr>
            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="">Valor Orçamento (R$)</label>
                    <input disabled="disabled" type="text" class="form-control number" id="valor_orcamento" name="valor_orcamento" value="{{$orcamento->valor_orcamento}}">
                </div>
                <div class="col-md-3">
                    <label for="">Valor do Serviço (R$)</label>
                    <input type="text" class="form-control number" id="valor_servico" required="true" name="valor_servico" value="0">
                </div>
                <div class="col-md-3">
                    <label for="">Valor das Peças (R$)</label>
                    <input type="text" class="form-control number" id="valor_pecas" required="true" name="valor_pecas" value="0">
                </div>
                <div class="col-md-3">
                    <label for="">Valor total (R$)</label>
                    <input disabled type="text" class="form-control number" id="valor_total" required="true" name="valor_total" value="0">
                </div>
            </div>
            <hr>
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
        $('.number').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) event.preventDefault();
        });
        carregarPecas()
    })

    function carregarPecas(){
        $.getJSON("{{ route('peca.getAll') }}", function (data){
            if (Array.isArray(data) && data.length){
                data.forEach(peca => {
                    $('#pecas').append( $('<option value="'+ peca.id +'" valor="'+ peca.preco +'">'+ peca.codigo + ' - ' + peca.titulo +'</option>') )
                }) 
            } 
        })
        $('#pecas option').first().attr('selected','selected')
    }
    
    function adicionarPeca(){

        let valor_pecas = parseFloat($('#pecas option:selected').attr('valor')) * 1.0 * parseInt($('#qtde_utilizada').val());
        let row = 
            `<div class="row" id="peca_peca_rand" style="margin-bottom: 5px;"><div class="col-md-7">
                <input type="hidden" name="peca_utilizada_id[]" value="peca_id">
                <input disabled type="text" class="form-control" value="peca_titulo">
            </div>
            <div class="col-md-2">
                <input disabled type="number" class="form-control" min="1" value="peca_qtde" name="quantidade_utilizada[]">
            </div>
            <div class="col-md-2">
                <input disabled type="text" class="form-control number" id="valor_peca_peca_rand" value="peca_valor">
            </div>
            <div class="col-md-1">
                <button type="button" class="form-control btn btn-danger" onclick="removerPeca('peca_rand')"><i class="fas fa-minus"></i>&nbsp;</button>
            </div></div>`
            .replaceAll( 'peca_id', $('#pecas option:selected').val() )
            .replaceAll( 'peca_rand', Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 7) )
            .replace( 'peca_titulo', $('#pecas option:selected').text() )
            .replace( 'peca_qtde', $('#qtde_utilizada').val())
            .replace( 'peca_valor', valor_pecas) 
        $('#pecas_utilizadas').append( row )
        atualizaValorTotal(valor_pecas)
    }

    function atualizaValorTotal(valor){
        let valor_total = parseFloat($('#valor_pecas').val())
        valor_total += valor
        valor_total = (valor_total < 0) ? 0 : valor_total;
        $('#valor_pecas').val( valor_total )
    }

    function removerPeca(id){
        let valor_removido = parseFloat($('#valor_peca_'+id).val())
        $('#peca_'+id).remove()
        atualizaValorTotal( (0.0 - valor_removido ) )
    }

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