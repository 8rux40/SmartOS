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
                    <table class="table table-striped" id="ordensdeservico">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Data</th>
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
            status = parseInt(ordemservico.status);
            descricao_status = ''
            if (status == 1) {
                descricao_status = 'Orçamento pendente';
            } else if (status == 2) {
                descricao_status = 'Aguardando';
            } else if (status == 3) {
                descricao_status = 'Aberta';
            } else if (status == 4) {
                descricao_status = 'Concluída';
            } else if (status == 5) {
                descricao_status = 'Cancelada';
            }                 
                      
            row = '<tr>';
            row += '<td>'+ moment(ordemservico.created_at).format('DD/MM/yyyy') +'</td>';
            row += '<td>'+ descricao_status +'</td>';
            row += '<td>'+ ordemservico.descricao_problema_reparador +'</td>';
            row += '<td>'+ ordemservico.valor_total +'</td>';
            row += '<td>'+ ordemservico.valor_servico +'</td>';
            row += '<td>'+ ordemservico.data_abertura +'</td>';
            row += '<td>'+ ordemservico.data_fechamento +'</td>';            
            row += '</tr>';
            $('table#ordensdeservico tbody').append(row);     
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
        $('table#ordensservicos tbody').append(row);
      }
    })
  }
</script>
@endpush