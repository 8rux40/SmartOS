@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3><i class="fas fa-mobile-alt text-primary"></i> Celulares</li> </h3>         
      </div>
    </div>
  <div class="mt-2"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="responsive-table">
          <table class="table table-striped" id="celulares">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Proprietário</th>
                <th scope="col">Primeiro Imei</th>
                <th scope="col">Segundo Imei</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>       
                <th></th>
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
          row += '<td>'+ celular.cliente.nome +'</td>';
          row += '<td>'+ celular.imei +'</td>';
          row += '<td>'+ ((celular.imei2 !== null && celular.imei2 !== undefined) ? celular.imei2 : '--') +'</td>';
          row += '<td>'+ celular.marca +'</td>';
          row += '<td>'+ celular.modelo +'</td>';
          row += `<td class="text-center"> 
                      <a href="{{route('orcamento.create',':id_celular')}}" class="btn btn-sm btn-warning" title="Solicitar orçamento"><li class="fa fa-coins text-light"></li></a>
                      <a href="{{route('cliente.show',':id_cliente')}}" class="btn btn-sm btn-primary" title="Detalhes do proprietário"><li class="fa fa-user"></li></a>                     
                      <a href="{{route('celular.edit',':id_celular')}}" class="btn btn-sm btn-secondary" title="Editar"><li class="fa fa-edit"></li></a>                      
                      <a onclick="excluir(:id_celular)" class="btn btn-sm btn-danger" title="Excluir"><li class="fa fa-trash"></li></a>                      
                  </td>`.replaceAll(':id_cliente', celular.cliente.id).replaceAll(':id_celular',celular.id,)
          row += '</tr>';
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

  function excluir(id){
    Swal.fire({
      title: 'Tem certeza?',
      text: "Não será possível reverter essa ação!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, excluir!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "{{ route('celular.delete') }}",
          method: 'delete',
          dataType: 'json',
          data: {
            id: id
          },
          success: function(response){
            if(response.success){
              Swal.fire(
              {
                title: 'Excluido!',
              text: response.message,
              icon: 'success'
              }
            )
            }
          }
        })
      }
      document.location.realod(true);
    })
  }
</script>
@endpush