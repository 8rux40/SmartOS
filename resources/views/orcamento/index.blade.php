@extends('layouts.app')

@section('content')
@php
    use App\Models\User;
@endphp

<div class="container">
  <div class="row">
    <div class="col-md-9">
      <h3><i class="fas fa-clock text-primary"></i> Orçamentos pendentes</li> </h3> 
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
        <h3><i class="fas fa-coins text-primary"></i> Orçamentos informados (Aguardando OS)</li> </h3> 
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

  function criarOS(id){
    $.ajax({
      method: 'post',
      url: "{{ route('ordemservico.store', ':id') }}".replace(':id', id),
      dataType: 'json',
      data: { _token: ' {{ csrf_token() }}' },
      success: function (response) {
        console.log(response)
        if (response.success) {
            Swal.fire({
                title: 'Sucesso!',
                text: response.message,
                icon: 'success',
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false, 
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ver OS',
                cancelButtonText: 'Continuar em vendo orçamentos'
            }).then((result) => {
                if (result.value) {
                    $(location).attr('href',response.route);
                } else {
                  carregaValores()
                }
            })
        } else {
            //mostrarErros(response.errors);
        }
      }
    })
  }
  
  function carregaValores(){
    const url = "{{ route('orcamento.getAll') }}";
    let admin = Boolean("{{ User::find(auth()->user()->id)->hasRole('Super Admin') }}")
    let reparador = Boolean("{{ User::find(auth()->user()->id)->can('informar orcamento') }}")

    $('table#orcamento-informado tbody tr').remove();

    $.getJSON(url, function (data){
      if (Array.isArray(data) && data.length){
        console.log('Array.isArray(data)', Array.isArray(data));
        console.log('data.length',data.length);
        data.forEach(orcamento => {
          if (orcamento.status == 1){
            row = '<tr>';
            row += '<td>'+ moment(orcamento.created_at).format('DD/MM/yyyy') +'</td>';
            row += '<td>'+ orcamento.cliente.nome +'</td>';
            row += '<td>'+ orcamento.celular.marca + ' ' + orcamento.celular.modelo +'</td>';
            if (admin) {
              row += `<td class="text-center">
                          <a href="{{route('orcamento.edit',':id')}}" class="btn btn-sm btn-success" title="Informar orçamento"><li class="fa fa-coins"></li></a>
                          <a href="{{route('orcamento.show',':id')}}" class="btn btn-sm btn-primary" title="Ver Detalhes"><li class="fa fa-eye"></li></a>
                          <a href="{{route('orcamento.edit',':id')}}" class="btn btn-sm btn-secondary" title="Editar"><li class="fa fa-edit"></li></a>
                          <a href="excluirOrcamento(:id)" class="btn btn-sm btn-danger" title="Excluir"><li class="fa fa-trash"></li></a>
                      </td>`
            } else {
              row += reparador ? `<td class="text-center">
                          <a href="{{route('orcamento.edit',':id')}}" class="btn btn-sm btn-success" title="Informar orçamento"><li class="fa fa-coins"></li></a>
                          <a href="{{route('orcamento.show',':id')}}" class="btn btn-sm btn-primary" title="Ver Detalhes"><li class="fa fa-eye"></li></a>
                      </td>` : 
                      `<td class="text-center">
                          <a href="{{route('orcamento.show',':id')}}" class="btn btn-sm btn-primary" title="Ver Detalhes"><li class="fa fa-eye"></li></a>
                          <a href="{{route('orcamento.edit',':id')}}" class="btn btn-sm btn-secondary" title="Editar"><li class="fa fa-edit"></li></a>
                          <a href="excluirOrcamento(:id)" class="btn btn-sm btn-danger" title="Excluir"><li class="fa fa-trash"></li></a>
                      </td>`;
            }
            row += '</tr>';
            row = row.replaceAll(':id',orcamento.id,)
            $('table#orcamento-pendente tbody').append(row);
          } else {
            row = '<tr>';
            row += '<td>'+ moment(orcamento.created_at).format('DD/MM/yyyy') +'</td>';
            row += '<td>'+ orcamento.cliente.nome +'</td>';
            row += '<td>'+ orcamento.celular.marca + ' ' + orcamento.celular.modelo +'</td>';
            row += '<td> R$ '+ orcamento.valor_orcamento.toLocaleString('pt-br', {minimumFractionDigits: 2}) +'</td>';
            if (admin){
              row += `<td class="text-center">
                        <a class="btn btn-sm btn-success" title="Criar Ordem de Serviço" onclick="criarOS(':id')"><li class="fa fa-clipboard-list"></li></a>
                        <a href="{{route('orcamento.show',':id')}}" class="btn btn-sm btn-primary" title="Ver Detalhes"><li class="fa fa-eye"></li></a>
                        <a href="{{route('orcamento.edit',':id')}}" class="btn btn-sm btn-secondary" title="Editar"><li class="fa fa-edit"></li></a>
                        <a href="excluirOrcamento(:id)" class="btn btn-sm btn-danger" title="Excluir"><li class="fa fa-trash"></li></a>
                    </td>`
            } else {
              row += reparador ? `<td class="text-center">
                        <a href="{{route('orcamento.show',':id')}}" class="btn btn-sm btn-primary" title="Ver Detalhes"><li class="fa fa-eye"></li></a>
                        <a href="{{route('orcamento.edit',':id')}}" class="btn btn-sm btn-secondary" title="Editar"><li class="fa fa-edit"></li></a>
                    </td>` : 
                    `<td class="text-center">
                        <a class="btn btn-sm btn-success" title="Criar Ordem de Serviço" onclick="criarOS(':id')"><li class="fa fa-clipboard-list"></li></a>
                        <a href="{{route('orcamento.show',':id')}}" class="btn btn-sm btn-primary" title="Ver Detalhes"><li class="fa fa-eye"></li></a>
                        <a href="{{route('orcamento.edit',':id')}}" class="btn btn-sm btn-secondary" title="Editar"><li class="fa fa-edit"></li></a>
                        <a href="excluirOrcamento(:id)" class="btn btn-sm btn-danger" title="Excluir"><li class="fa fa-trash"></li></a>
                    </td>`;
            }
            row += '</tr>';
            row = row.replaceAll(':id',orcamento.id,)
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