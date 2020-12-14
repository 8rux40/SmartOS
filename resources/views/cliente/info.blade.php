@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h3><i class="fas fa-users text-primary"></i> Dados do cliente</li> </h3>         
            </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="row mt-1">
                <div class="col-md-4 grupo-dados-info-cliente">
                    <label for="" class="label-info-cliente">Nome:</label>
                    <span class="dados-info-cliente">{{ $cliente->nome }}</span>
                </div>
                <div class="col-md-4 grupo-dados-info-cliente">
                    <label class="label-info-cliente" for="">CPF:</label>
                    <span class="dados-info-cliente">{{ $cliente->cpf }}</span>
                </div>
                <div class="col-md-4 grupo-dados-info-cliente">
                    <label class="label-info-cliente" for="">Número de telefone:</label>
                    <span class="dados-info-cliente">{{ $cliente->numero_tel }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 grupo-dados-info-cliente">
                    <label class="label-info-cliente" for="">Número de celular:</label>
                    <span class="dados-info-cliente">{{ $cliente->numero_cel }}</span>
                </div>
                <div class="col-md-4 grupo-dados-info-cliente">
                    <label class="label-info-cliente" for="">Email:</label>
                    <span class="dados-info-cliente">{{ $cliente->email }}</span>
                </div>
                <div class="col-md-4 grupo-dados-info-cliente">
                    <label class="label-info-cliente" for="">Endereço:</label>
                    <span class="dados-info-cliente">{{ $cliente->endereco }}</span>
                </div>
            </div>
          </div>
      </div>
<br>
        <div class="row mt-3">
            <div class="col-md-9">
                <h3><i class="fas fa-mobile-alt text-primary"></i> Celulares do cliente</li> </h3>         
            </div>
            <div class="col-md-3">
                <a href="{{ route('celular.create', $cliente->id) }}" class="btn btn-md bg-success text-light float-right"> <i class="fas fa-plus"></i>&nbsp;&nbsp;Novo</a>     
            </div>
            <div class="col-md-12 mt-2">
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
        $('table#celulares tbody tr').remove();
        const url = "{{ route('cliente.getCelulares', $cliente->id) }}";
        $.getJSON(url, function (data){
            if (Array.isArray(data) && data.length){
                data.forEach(celular => {
                    console.log(celular)
                    row = '<tr>';
                    row += '<td>'+ celular.imei +'</td>';
                    row += '<td>'+ ((celular.imei2 !== null && celular.imei2 !== undefined)?celular.imei2:'-') +'</td>';
                    row += '<td>'+ celular.marca +'</td>';
                    row += '<td>'+ celular.modelo +'</td>';
                    row += `<td class="text-center">                      
                                <a href="{{route('orcamento.create',':id')}}" class="btn btn-sm btn-warning" title="Solicitar orçamento"><li class="fa fa-coins text-light"></li></a>
                                <a href="{{route('celular.edit',':id')}}" class="btn btn-sm btn-secondary" title="Editar"><li class="fa fa-edit"></li></a>
                                <a onclick="excluir(:id)" class="btn btn-sm btn-danger" title="Excluir"><li class="fa fa-trash"></li></a>
                            </td>`.replaceAll(":id", celular.id); 
                    row += '</tr>'
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
        // $.ajaxSetup({ 
        //     headers: { 'X-CSRF-TOKEN': "{‌{csrf_token()}}" } 
        //   });
        $.ajax({
          url: "{{ route('celular.delete', ':id') }}".replace(':id', id),
          method: 'post',
          dataType: 'json',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response){
            if(response.success){
              Swal.fire({
                title: 'Excluido!',
                text: response.message,
                icon: 'success'
              })
              carregaValores();
            } else {
              mostraErros(response.errors)
            }
          }
        })
      }
    })
  }

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