@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">        
            <h3><i class="fas fa-concierge-bell text-primary"></i> Ordem de serviço</li> </h3> 
        </div>      
    </div>
    <div class="mt-2"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="responsive-table">
                    <table class="table table-striped" id="ordemservico">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Status</th>
                                <th scope="col">Descrição do problema informado pelo reparador</th>
                                <th scope="col">Valor total</th>
                                <th scope="col">Valor serviço</th>
                                <th scope="col">Data de abertura</th>
                                <th scope="col">Data de fechamento</th>
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
</div>
@endsection

@push('javascript')
<script>
  $(document).ready(function(){
    carregaValores()
  })
  
  function carregaValores(){
    const url = "{{ route('ordemservico.getAll') }}";
    $.getJSON(url, function (data){
      if (Array.isArray(data) && data.length){
        data.forEach(ordemservico => {          
            row = '<tr>';
            row += '<td>'+ ordemservico.status+'</td>';
            row += '<td>'+ ordemservico.descricao_problema_reparador +'</td>';
            row += '<td>'+ ordemservico.valor_total +'</td>';
            row += '<td>'+ ordemservico.valor_servico +'</td>';
            row += '<td>'+ ordemservico.data_abertura +'</td>';
            row += '<td>'+ ordemservico.data_fechamento +'</td>';            
            row += '</tr>';
            $('table#ordemservico tbody').append(row);
          } 
        });
      } else {
        const row = 
          `
            <tr>
              <td colspan="13" class="text-center mx-auto">
                  <p style="padding-top:0.8rem;">Não existem ordem de servicos cadastrados.</p>
              </td>
            </tr>
          `;
        $('table#ordemservico tbody').append(row);
      }
    })
  }
</script>
@endpush