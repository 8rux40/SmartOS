@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-9">
        <h3><i class="fas fa-users text-primary"></i> Clientes</li>
          
        </h3> 
      </div>
      <div class="col-md-3">
        <a href="{{ route('cliente.create') }}" class="btn btn-md bg-success text-light float-right"> <i class="fas fa-plus"></i>&nbsp;&nbsp;Novo</a>
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
    $('table#clientes tbody tr').remove();
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
                      <a onclick="excluir(:id)" class="btn btn-sm btn-danger" title="Excluir"><li class="fa fa-trash"></li></a>
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
          url: "{{ route('cliente.delete', ':id') }}".replace(':id', id),
          method: 'post',
          dataType: 'json',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
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
            carregaValores()
          }
        })
      }
      //document.location.reload(true);
    })
  }
</script>
@endpush