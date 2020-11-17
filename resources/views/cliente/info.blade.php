@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 barra-titulo">
                Dados do Cliente
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 grupo-dados-info-cliente">
                <label for="" class="label-info-cliente">Nome:</label>
                <span class="dados-info-cliente">Aroldo</span>
            </div>
            <div class="col-md-4 grupo-dados-info-cliente">
                <label class="label-info-cliente" for="">CPF:</label>
                <span class="dados-info-cliente">100100010</span>
            </div>
            <div class="col-md-4 grupo-dados-info-cliente">
                <label class="label-info-cliente" for="">Numero de telefone:</label>
                <span class="dados-info-cliente">000000000</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 grupo-dados-info-cliente">
                <label class="label-info-cliente" for="">Numero celular:</label>
                <span class="dados-info-cliente">000000000</span>
            </div>
            <div class="col-md-4 grupo-dados-info-cliente">
                <label class="label-info-cliente" for="">Email:</label>
                <span class="dados-info-cliente">eraldo@gmail.com</span>
            </div>
            <div class="col-md-4 grupo-dados-info-cliente">
                <label class="label-info-cliente" for="">Endereco:</label>
                <span class="dados-info-cliente">Rua do rodolfo, 123</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 barra-titulo">
                Celulares do cliente
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>0000000000</td>
                                <td>0000000000</td>
                                <td>LG</td>
                                <td>LG5x</td>
                            </tr>
                            <tr>
                                <td>0000000000</td>
                                <td>0000000000</td>
                                <td>Motorla</td>
                                <td>moto G</td>
                            </tr>
                            <tr>
                                <td>0000000000</td>
                                <td>0000000000</td>
                                <td>Xiaomi</td>
                                <td>Redmi5</td>
                            </tr>
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

      function carregaValores() {
          const url = "";
          $.getJSON(url, function(data){
            if (Array.isArray(data) && data.length) {
                data.forEach(celular => {
                    console.log(celular)
                    row = '<tr>';
                    row += '<td>'+ celular.imei +'</td>';
                    row += '<td>'+ celular.imei2 +'</td>';
                    row += '<td>'+ celular.marca +'</td>';
                    row += '<td>'+ celular.modelo +'</td>';

                    $('table#celulares tbody').append(row);
                })
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