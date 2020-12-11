@extends('layouts.app')

@section('content')
@php use App\Models\User; @endphp
<div class="container">
  <div class="row">
    <div class="col-md-9">        
      <h3><i class="fas fa-clipboard-list text-primary"></i> Ordens de serviço</li> </h3> 
    </div>      
  </div>
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#abertas">Abertas</a></li>
        <li><a data-toggle="tab" href="#concluidas">Concluídas</a></li>
      </ul>
    </div>
  </div>

  <div class="tab-content">
    <div id="abertas" class="tab-pane fade in active">
      {{-- OS ABERTAS --}}
    <div class="row">
        <div class="col-md-12">
          <br>
          <p>Mostrando ordens de serviço abertas. </p>
            <div class="responsive-table">
                <table class="table table-striped" id="os-abertas">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Data de abertura</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Valor do orçamento</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>          
    </div> 
    </div>
    <div id="concluidas" class="tab-pane fade">
      {{-- TUDO --}}
    <div class="row">
        <div class="col-md-12">
          <br>
          <p>Mostrando ordens de serviço concluídas, ou seja, que foram executadas por um reparador técnico. </p>
            <div class="responsive-table">
                <table class="table table-striped" id="ordensdeservico">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Data</th>
                            <th scope="col">Status</th>
                            <th scope="col">Problema informado pelo reparador</th>
                            <th scope="col">Valor total</th>
                            <th scope="col">Valor serviço</th>
                            <th scope="col">Data de abertura</th>
                            <th scope="col">Data de fechamento</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>          
    </div> 
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
    
    


  </div>               
</div>
@endsection

@push('javascript')
<script>
  $(document).ready(function(){
    $('a[href="#abertas"]').tab('show');
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var target = $(e.target).attr("href");
      $('ul.nav-tabs li').attr('class', '')
      $('a[href="'+target+'"').closest('li').attr('class', 'active')
    });
    carregaValores()
  })

  function carregaAbertas(){
    let reparador = Boolean("{{ User::find(auth()->user()->id)->can('fechar os') }}")    
    $('#os-abertas tbody tr').remove()
    $.getJSON("{{ route('ordemservico.getAbertas') }}", function(data){
      if (Array.isArray(data) && data.length){
        data.forEach(ordemservico => {  
          console.log(ordemservico);                
            row = '<tr>';
            row += '<td>'+ moment(ordemservico.data_abertura).format('DD/MM/yyyy') +'</td>';
            row += '<td>'+ ordemservico.celular.marca +' '+  ordemservico.celular.modelo +'</td>';
            row += '<td>'+ ordemservico.cliente.nome +'</td>';
            row += '<td>'+ 'R$ ' + ordemservico.valor_orcamento.toLocaleString('pt-br', {minimumFractionDigits: 2}) +'</td>';
            if (reparador){
              row += `<td class="text-right">                       
                      <a href="{{route('ordemservico.edit',':id')}}" class="btn btn-sm btn-success ml-1" title="Fechar"><li class="fa fa-check"></li></a>                        
                      <a href="{{route('ordemservico.show',':id')}}" class="btn btn-sm btn-primary" title="Detalhes da ordem de serviço"><li class="fa fa-eye"></li></a>                     
                      </td>`;
            } else {
              row += `<td class="text-right">                       
                      <a href="{{route('ordemservico.show',':id')}}" class="btn btn-sm btn-primary" title="Detalhes da ordem de serviço"><li class="fa fa-eye"></li></a>                     
                      <a href="{{route('ordemservico.edit',':id')}}" class="btn btn-sm btn-secondary ml-1" title="Editar"><li class="fa fa-edit"></li></a>  
                      <a onclick="cancelar(:id)" class="btn btn-sm btn-danger ml-1" title="Cancelar"><li class="fas fa-times"></li></a>
                      </td>`;
            }
            row += '</tr>'
            row = row.replaceAll(':id',ordemservico.id,)            
          $('table#os-abertas tbody').append(row);           
                
        });



      }
      else {
        const row = 
          `
            <tr>
              <td colspan="4" class="text-center mx-auto">
                  <p style="padding-top:0.8rem;">Não existem ordem de servicos abertas.</p>
              </td>
            </tr>
          `;
        $('table#os-abertas tbody').append(row);
      }
    })
  }
  
  function carregaValores(){
    carregaAbertas()
    const url = "{{ route('ordemservico.getAll') }}";
    let reparador = Boolean("{{ User::find(auth()->user()->id)->can('fechar os') }}")    
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
            row += reparador ? `<td class="text-right d-flex">                       
                      <a href="{{route('ordemservico.show',':id')}}" class="btn btn-sm btn-primary" title="Detalhes da ordem de serviço"><li class="fa fa-eye"></li></a>                     
                      <a href="{{route('ordemservico.edit',':id')}}" class="btn btn-sm btn-secondary ml-1" title="Editar"><li class="fa fa-edit"></li></a>                        
                      </td>` :
                      `<td class="text-right d-flex">                       
                      <a href="{{route('ordemservico.show',':id')}}" class="btn btn-sm btn-primary" title="Detalhes da ordem de serviço"><li class="fa fa-eye"></li></a>                     
                      <a href="{{route('ordemservico.edit',':id')}}" class="btn btn-sm btn-secondary ml-1" title="Editar"><li class="fa fa-edit"></li></a>  
                      <a onclick="cancelar(:id)" class="btn btn-sm btn-danger ml-1" title="Cancelar"><li class="fas fa-times"></li></a>
                      </td>`;
            row += '</tr>'
            row = row.replaceAll(':id',ordemservico.id,)            
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
        $('table#ordensdeservico tbody').append(row);
      }
    })
  }
</script>
@endpush