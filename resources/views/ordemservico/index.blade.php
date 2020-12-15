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
        <li><a data-toggle="tab" href="#canceladas">Canceladas</a></li>
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
      {{-- CONCLUIDAS --}}
    <div class="row">
        <div class="col-md-12">
          <br>
          <p>Mostrando ordens de serviço concluídas, ou seja, que foram executadas por um reparador técnico. </p>
            <div class="responsive-table">
                <table class="table table-striped" id="ordensdeservico">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Data</th>
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
    <div id="canceladas" class="tab-pane fade">
      {{-- CANCELADAS --}}
      <div class="row">
        <div class="col-md-12">
          <br>
          <p>Mostrando ordens de serviço canceladas</p>
          <div class="responsive-table">
            <table class="table table-striped" id="os-canceladas">
              <thead class="thead-dark">
                <tr>
                 <th scope="col">Dt. de abertura</th>
                 <th scope="col">Dt. de cancelamento</th>
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

  function carregaValores(){
    carregaAbertas()
    carregaConcluidas()
    carregaCanceladas()
  }

  function carregaCanceladas(){
    $('#os-canceladas tbody tr').remove()
    $.getJSON("{{ route('ordemservico.getCanceladas') }}", function(data){
      if (Array.isArray(data) && data.length){
        data.forEach(ordemservico => {  
          console.log(ordemservico);                
            row = '<tr>';
            row += '<td>'+ moment(ordemservico.data_abertura).format('DD/MM/yyyy') +'</td>';
            row += '<td>'+ moment(ordemservico.data_cancelamento).format('DD/MM/yyyy') +'</td>';
            row += '<td>'+ ordemservico.celular.marca +' '+  ordemservico.celular.modelo +'</td>';
            row += '<td>'+ ordemservico.cliente.nome +'</td>';
            row += '<td>'+ 'R$ ' + ordemservico.valor_orcamento.toLocaleString('pt-br', {minimumFractionDigits: 2}) +'</td>';
            row += '<td class="text-right">'
            row += `<a href="{{route('ordemservico.show',':id')}}" class="btn btn-sm btn-primary" title="Detalhes da ordem de serviço"><li class="fa fa-eye"></li></a>`;
            row += '</td></tr>';
            row = row.replaceAll(':id',ordemservico.id,)            
          $('table#os-canceladas tbody').append(row);      
        });
      }
      else {
        const row = 
          `
            <tr>
              <td colspan="6" class="text-center mx-auto">
                  <p style="padding-top:0.8rem;">Não existem ordem de servicos canceladas.</p>
              </td>
            </tr>
          `;
        $('table#os-canceladas tbody').append(row);
      }
    })
  }

  function carregaAbertas(){
    // Permissões
    let fecharOs = Boolean("{{ User::find(auth()->user()->id)->can('fechar os') }}")    
    let cancelarOs = Boolean("{{ User::find(auth()->user()->id)->can('cancelar os') }}")    
    let editarOs = Boolean("{{ User::find(auth()->user()->id)->can('editar os') }}")    

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
            row += '<td class="text-right">'
            if (fecharOs){
              row += `<a href="{{route('ordemservico.edit',':id')}}" class="btn btn-sm btn-success ml-1" title="Fechar"><li class="fa fa-check"></li></a>`;
            }
            row += `<a href="{{route('ordemservico.show',':id')}}" class="btn btn-sm btn-primary ml-1" title="Detalhes da ordem de serviço"><li class="fa fa-eye"></li></a>`;
            // if (editarOs){
            //   row += `<a href="{{route('ordemservico.edit',':id')}}" class="btn btn-sm btn-secondary ml-1" title="Editar"><li class="fa fa-edit"></li></a>`;
            // }
            if (cancelarOs){
              row += `<a onclick="cancelar(:id)" class="btn btn-sm btn-danger ml-1" title="Cancelar"><li class="fas fa-times"></li></a>`;
            }
            row += '</td></tr>';
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
  
  function carregaConcluidas(){
    // Permissões
    let fecharOs = Boolean("{{ User::find(auth()->user()->id)->can('fechar os') }}")    
    let cancelarOs = Boolean("{{ User::find(auth()->user()->id)->can('cancelar os') }}")    
    let editarOs = Boolean("{{ User::find(auth()->user()->id)->can('editar os') }}")    

    const url = "{{ route('ordemservico.getConcluidas') }}";
    $.getJSON(url, function (data){
      if (Array.isArray(data) && data.length){
        data.forEach(ordemservico => {                    
            row = '<tr>';
            row += '<td>'+ moment(ordemservico.created_at).format('DD/MM/yyyy') +'</td>';
            row += '<td> R$ '+ ordemservico.valor_total.toLocaleString('pt-br', {minimumFractionDigits: 2}) +'</td>';
            row += '<td> R$ '+ ordemservico.valor_servico.toLocaleString('pt-br', {minimumFractionDigits: 2}) +'</td>';
            row += '<td>'+ moment(ordemservico.data_abertura).format('DD/MM/yyyy') +'</td>';
            row += '<td>'+ moment(ordemservico.data_fechamento).format('DD/MM/yyyy') +'</td>';
            row += `<td class="text-right d-flex">                       
                      <a href="{{route('ordemservico.show',':id')}}" class="btn btn-sm btn-primary" title="Detalhes da ordem de serviço"><li class="fa fa-eye"></li></a>
                    </td>`;
            row += '</tr>'
            row = row.replaceAll(':id',ordemservico.id,)            
          $('table#ordensdeservico tbody').append(row);
        });
      } else {
        const row = 
          `
            <tr>
              <td colspan="12" class="text-center mx-auto">
                  <p style="padding-top:0.8rem;">Não existem ordem de servicos concluídas.</p>
              </td>
            </tr>
          `;
        $('table#ordensdeservico tbody').append(row);
      }
    })
  }

  function cancelar(id){
    Swal.fire({
      title: 'Tem certeza?',
      text: "Deseja cancelar esta OS? Não será possível reverter essa ação!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Não',
      confirmButtonText: 'Sim, cancelar OS!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "{{ route('ordemservico.cancelar', ':id') }}".replace(':id', id),
          method: 'post',
          dataType: 'json',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response){
            if(response.success){
              Swal.fire({
                title: 'OS cancelada!',
                text: response.message,
                icon: 'success'
              })
              carregaCanceladas()
              carregaAbertas()
            } else {
              mostraErros(response.errors)
            }
          }
        })
      }
    })
  }
</script>
@endpush