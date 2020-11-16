@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-9">
        <h3><i class="fas fa-mobile-alt text-primary"></i> Celulares</li> </h3>         
      </div>
      <div class="col-md-3">
        <a href="{{ route('celular.create') }}" class="btn btn-primary">Cadastrar Celular</a>
      </div>      
    </div>
  <div class="mt-2"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="responsive-table">
          <table class="table table-striped" id="celulares">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Primeiro Imei</th>
                <th scope="col">Segundo Imei</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>                
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
    const url = "{{ route('celular.getAll') }}";
    $.getJSON(url, function (data){
      if (Array.isArray(data) && data.length){
        data.forEach(celular => {
          console.log(celular)
          row = '<tr>';
          row += '<td>'+ celular.imei +'</td>';
          row += '<td>'+ celular.imei2 +'</td>';
          row += '<td>'+ celular.marca +'</td>';
          row += '<td>'+ celular.modelo +'</td>';
          /* row += `<td class="text-center">
                      <a href="{{route('cliente.show',':id')}}" class="btn btn-sm btn-primary" title="Ver Detalhes"><li class="fa fa-eye"></li></a>
                      <a href="{{route('cliente.edit',':id')}}" class="btn btn-sm btn-secondary" title="Editar"><li class="fa fa-edit"></li></a>
                      <a href="excluircliente(:id)" class="btn btn-sm btn-danger" title="Excluir"><li class="fa fa-trash"></li></a>
                  </td>`.replaceAll(':id',cliente.id,)
          row += '</tr>'; !-->*/
          $('table#celulares tbody').append(row);
        });
      } else {
        const row = 
          `
            <tr>
              <td colspan="13" class="text-center mx-auto">
                  <p style="padding-top:0.8rem;">Não existem celulares cadastrados.</p>
              </td>
            </tr>
          `;
        $('table#celulares tbody').append(row);
      }
    })
  }
</script>
@endpush