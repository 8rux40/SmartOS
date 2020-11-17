@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h3><i class="fas fa-users text-primary"></i> Dados do cliente</li> </h3>         
            </div>
        </div>
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
                <label class="label-info-cliente" for="">Numero de telefone:</label>
                <span class="dados-info-cliente">{{ $cliente->numero_tel }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 grupo-dados-info-cliente">
                <label class="label-info-cliente" for="">Numero celular:</label>
                <span class="dados-info-cliente">{{ $cliente->numero_cel }}</span>
            </div>
            <div class="col-md-4 grupo-dados-info-cliente">
                <label class="label-info-cliente" for="">Email:</label>
                <span class="dados-info-cliente">{{ $cliente->email }}</span>
            </div>
            <div class="col-md-4 grupo-dados-info-cliente">
                <label class="label-info-cliente" for="">Endereco:</label>
                <span class="dados-info-cliente">{{ $cliente->endereco }}</span>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-9">
                <h3><i class="fas fa-mobile-alt text-primary"></i> Celulares</li> </h3>         
            </div>
            <div class="col-md-3">
                <a href="{{ route('celular.create') }}" class="btn btn-md bg-success text-light float-right"> <i class="fas fa-plus"></i>&nbsp;&nbsp;Novo</a>     
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
        const url = "{{ route('cliente.getCelulares', $cliente->id) }}";
        $.getJSON(url, function (data){
            if (Array.isArray(data) && data.length){
                data.forEach(celular => {
                    console.log(celular)
                    row = '<tr>';
                    row += '<td>'+ celular.imei +'</td>';
                    row += '<td>'+ celular.imei2 +'</td>';
                    row += '<td>'+ celular.marca +'</td>';
                    row += '<td>'+ celular.modelo +'</td>';
                    row += `<td class="text-center">                      
                                <a href="{{route('celular.edit',':id')}}" class="btn btn-sm btn-secondary" title="Editar"><li class="fa fa-edit"></li></a>
                                <a href="" class="btn btn-sm btn-danger" title="Excluir"><li class="fa fa-trash"></li></a>
                            </td>`
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
  </script>  
@endpush