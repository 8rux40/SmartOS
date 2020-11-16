@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-9">
        <h3><i class="fas fa-users text-primary"></i> Clientes</li>
        <a href="{{ route('cliente.create') }}" class="btn btn-md bg-success text-light float-lg-right">Novo</a> </h3> 
      </div>      
    </div>
  <div class="mt-2"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="responsive-table">
          <table class="table table-striped" id="clientes">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Telefone</th>
                <th scope="col">Celular</th>
                <th scope="col">E-mail</th>
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
    const url = "{{ route('cliente.getAll') }}";
    $.getJSON(url, function (data){
      if (Array.isArray(data) && data.length){
        data.forEach(cliente => {
          console.log(cliente)
          row = '<tr>';
          row += '<td>'+ cliente.nome +'</td>';
          row += '<td>'+ cliente.numero_tel +'</td>';
          row += '<td>'+ cliente.numero_cel +'</td>';
          row += '<td>'+ cliente.email +'</td>';
          row += `<td class="text-center">
                      <a href="{{route('cliente.show',':id')}}" class="btn btn-sm btn-primary" title="Ver Detalhes"><li class="fa fa-eye"></li></a>
                      <a href="{{route('cliente.edit',':id')}}" class="btn btn-sm btn-secondary" title="Editar"><li class="fa fa-edit"></li></a>
                      <a href="excluircliente(:id)" class="btn btn-sm btn-danger" title="Excluir"><li class="fa fa-trash"></li></a>
                  </td>`.replaceAll(':id',cliente.id,)
          row += '</tr>';
          $('table#clientes tbody').append(row);
        });
      } else {
        const row = 
          `
            <tr>
              <td colspan="13" class="text-center mx-auto">
                  <p style="padding-top:0.8rem;">Não existem clientes cadastrados.</p>
              </td>
            </tr>
          `;
        $('table#clientes tbody').append(row);
      }
    })
  }
</script>
@endpush