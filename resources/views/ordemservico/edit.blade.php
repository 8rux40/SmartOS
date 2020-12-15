@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-9">
    <h3>
        <i class="fas fa-clipboard-list text-primary"></i>        
        @can('fechar os') Fechar Ordem de serviço @else Editar Ordem de serviço @endcan
    </h3>         
    </div>
   </div>
   <div class="card">
    <div class="card-body">
        <form action="" method="post" id="formOrdemServico">
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
                            value="{{ $ordem_servico->cliente->nome . ' - ' .$ordem_servico->cliente->cpf }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label for="InputImei1">Primeiro Imei do celular</label>
                    <input  type="text" class="form-control" id="InputImei1" disabled name="imei" value= "{{ $ordem_servico->celular->imei }}">
                  </div>
                </div> 
                <div class="col-md">
                  <div class="form-group">
                    <label for="InputImei2">Segundo Imei do celular</label>
                    <input  type="text" class="form-control" id="InputImei2" disabled name="imei2" value= "{{ $ordem_servico->celular->imei2 }}">
                  </div>
                </div> 
                <div class="col">
                  <div class="form-group">
                    <label for="MarcaCelular">Marca do celular</label>
                    <input  type="text" class="form-control" id="MarcaCelular" disabled name="marca" value= "{{$ordem_servico->celular->marca}}">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="ModeloCelular">Modelo do celular</label>
                    <input type="text" class="form-control" id="ModeloCelular" disabled name="modelo" value= "{{$ordem_servico->celular->modelo}}">
                  </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Descrição Problema (relatado pelo Cliente)</label>
                    <textarea disabled class="form-control" name="" id="" cols="30" rows="6">{{ $ordem_servico->descricao_problema }} </textarea>
                </div>
                <div class="col-md-6">
                    <label for="">Descrição Problema (Reparador)</label>
                    <textarea disabled class="form-control" name="descricao_problema_reparador" id="DescProblemaReparador" cols="30" rows="6">{{$ordem_servico->descricao_problema_reparador}}</textarea>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="">Descrição do serviço executado</label>
                    <textarea class="form-control" name="descricao_servico_executado" id="DescServicoExecutado" cols="30" rows="10">{{$ordem_servico->descricao_servico_executado}}</textarea>
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
                    <input type="number" id="qtde_utilizada" class="form-control" min="1" value="1">
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
                <div class="col-md-4">
                    <label for="">Valor Orçamento (R$)</label>
                    <input disabled="disabled" type="text" class="form-control number" id="valor_orcamento" name="valor_orcamento" value="{{ number_format($ordem_servico->valor_orcamento, 2, ',', '.') }}">
                </div>
                <div class="col-md-4">
                    <label for="">Valor das Peças (R$)</label>
                    <input disabled type="text" class="form-control number" id="valor_pecas" required="true" name="valor_pecas" value="0">
                </div>
                <div class="col-md-4">
                    <label for="">Valor do Serviço (R$)</label>
                    <input type="text" class="form-control number" id="valor_servico" required="true" name="valor_servico" value="0">
                </div>
                <input type="hidden" id="valor_total" name="valor_total" value="0">
                {{-- <div class="col-md-3">
                    <label for="">Valor total (R$)</label>
                    <input disabled type="text" class="form-control number" id="valor_total" required="true" name="valor_total" value="{{$ordem_servico->valor_total}}">
                </div> --}}
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="">Termo Garantia</label>
                    <textarea @cannot('editar termo de garantia') disabled @endcannot class="form-control" name="termo_garantia" id="TermoGarantia" cols="30" rows="6">{{$ordem_servico->termo_garantia}}</textarea>
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
        $('.number').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) event.preventDefault();
        });
        carregarPecas()

        // muda o limite da quantidade utilizada conforme a disponibilidade em estoque
        $('#pecas').change(function(){
            let quantidade_pecas = parseInt($('#pecas option:selected').attr('quantidade_pecas'))
            let foraDeEstoque = Boolean(quantidade_pecas == 0)
            $('#qtde_utilizada').attr('max', quantidade_pecas).attr('min', (foraDeEstoque ? 0 : 1)).val((foraDeEstoque ? 0 : 1))
        })
    })

    function carregarPecas(){
        $.getJSON("{{ route('peca.getAll') }}", function (data){
            console.log(data);
            if (Array.isArray(data) && data.length){
                data.forEach(peca => {
                    let foraDeEstoque = Boolean(peca.quantidade_pecas == 0)
                    $('#pecas').append( $('<option value="'+ peca.id +'" valor="'+ peca.preco +'" quantidade_pecas="'+ peca.quantidade_pecas+'">'+ peca.codigo + ' - ' + peca.titulo + ' ('+ peca.quantidade_pecas+'un.) R$ '+ peca.preco.toLocaleString('pt-br', {minimumFractionDigits: 2}) + (foraDeEstoque ? ' - FORA DE ESTOQUE':'') +'</option>') )
                }) 
            } 
        })
        $('#pecas option').first().attr('selected','selected').change()
    }
    
    function adicionarPeca(){
        let qtde_utilizada = $('#qtde_utilizada').val()
        
        if (qtde_utilizada <= $('#qtde_utilizada').attr('max') && qtde_utilizada > 0){
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
        e.preventDefault();

        let valor_total_os = $('#valor_pecas').val() * 1.0 + $('#valor_servico').val() * 1.0;
        $('#valor_total').val( valor_total_os )

        var disabled = $(this).find(':input:disabled').removeAttr('disabled');
        var serializedData = $(this).serialize();
        disabled.attr('disabled', 'disabled');

        Swal.fire({
            title: 'Confirmação',
            html: '<p> Deseja confirmar o fechamento desta OS por <strong>R$ '+ valor_total_os.toLocaleString('pt-br', {minimumFractionDigits: 2}) +'</strong> </p>',
            icon: 'info',
            showCancelButton: true,
            cancelButtonText: 'Não',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Sim, fechar OS'
        }).then(result => {
            if(result.value){
                $.ajax({
                    url: "{{ route('ordemservico.update', $ordem_servico->id) }}",
                    method: 'put',
                    dataType: 'json',
                    data: serializedData,
                    success: function (response) {
                        //console.log(response)
                        if (response.success) {
                            Swal.fire({
                                title: 'Sucesso!',
                                text: response.message,
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#888',
                                confirmButtonText: 'Ver esta OS',
                                cancelButtonText: 'Voltar às OS'
                            }).then((result) => {
                                if (result.value) {
                                    $(location).attr('href',response.route);
                                } else {
                                    $(location).attr('href', "{{ route('ordemservico.index') }}")
                                }
                            })
                        } else {
                            mostrarErros(response.errors);
                        }
                    }
                })
            }
        })

        
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