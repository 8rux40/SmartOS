@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9">
      <h3><i class="fas fa-coins text-success"></i> Orçamentos pendentes</li> </h3> 
    </div>      
  </div>
  <div class="mt-2"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="responsive-table">
          <table class="table table-striped" id="orcamento-pendente">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Data</th>
                <th scope="col">Cliente</th>
                <th scope="col">Celular</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>          
    </div>  
    <br><br>
    <div class="row">
      <div class="col-md-9">
        <h3><i class="fas fa-coins text-success"></i> Orçamentos informados</li> </h3> 
      </div>      
    </div>
    <div class="mt-2"></div>
      <div class="row">
        <div class="col-md-12">
          <div class="responsive-table">
            <table class="table table-striped" id="orcamento-informado">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Data</th>
                  <th scope="col">Cliente</th>
                  <th scope="col">Celular</th>
                  <th scope="col">Valor (R$)</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>          
      </div>            
  </div>
@endsection

@push('javascript')
<script>
  $(document).ready(function(){
    carregaValores()
  })
  
  function carregaValores(){
    const url = "{{ route('orcamento.getAll') }}";
    $.getJSON(url, function (data){
      if (Array.isArray(data) && data.length){
        data.forEach(orcamento => {
          if (orcamento.status == 1){
            row = '<tr>';
            row += '<td>'+ moment(orcamento.created_at).format('DD/MM/yyyy') +'</td>';
            row += '<td>'+ orcamento.cliente.nome +'</td>';
            row += '<td>'+ orcamento.celular.marca + ' ' + orcamento.celular.modelo +'</td>';
            row += `<td class="text-center">
                        <a href="{{route('orcamento.show',':id')}}" class="btn btn-sm btn-primary" title="Ver Detalhes"><li class="fa fa-eye"></li></a>
                        <a href="{{route('orcamento.edit',':id')}}" class="btn btn-sm btn-secondary" title="Editar"><li class="fa fa-edit"></li></a>
                        <a href="excluirOrcamento(:id)" class="btn btn-sm btn-danger" title="Excluir"><li class="fa fa-trash"></li></a>
                    </td>`.replaceAll(':id',orcamento.id,)
            row += '</tr>';
            $('table#orcamento-pendente tbody').append(row);
          } else {
            row = '<tr>';
            row += '<td>'+ moment(orcamento.created_at).format('DD/MM/yyyy') +'</td>';
            row += '<td>'+ orcamento.cliente.nome +'</td>';
            row += '<td>'+ orcamento.celular.marca + ' ' + orcamento.celular.modelo +'</td>';
            row += '<td>'+ orcamento.valor_orcamento +'</td>';
            row += `<td class="text-center">
                        <a href="{{route('orcamento.show',':id')}}" class="btn btn-sm btn-primary" title="Ver Detalhes"><li class="fa fa-eye"></li></a>
                        <a href="{{route('ordemservico.create',':id')}}" class="btn btn-sm btn-primary" title="Ver Detalhes"><li class="fa fa-eye"></li></a>
                        <a href="{{route('orcamento.edit',':id')}}" class="btn btn-sm btn-secondary" title="Editar"><li class="fa fa-edit"></li></a>
                        <a href="excluirOrcamento(:id)" class="btn btn-sm btn-danger" title="Excluir"><li class="fa fa-trash"></li></a>
                    </td>`.replaceAll(':id',orcamento.id,)
            row += '</tr>';
            $('table#orcamento-informado tbody').append(row);
          }

        });
      } else {
        const row = 
          `
            <tr>
              <td colspan="13" class="text-center mx-auto">
                  <p style="padding-top:0.8rem;">Não existem orcamentos cadastrados.</p>
              </td>
            </tr>
          `;
        $('table#orcamentos tbody').append(row);
      }
    })
  }
</script>
@endpush