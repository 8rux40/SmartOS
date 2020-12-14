@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 float-left">
            <h3><i class="fas fa-tools text-primary"></i> Peças </li> </h3> 
        </div>
        <div class="col-md-6 float-right">
          <a href="{{ route('peca.create') }}" class="btn btn-md bg-success text-light float-right"> <i class="fas fa-plus"></i>&nbsp;&nbsp;Nova peça</a>
        </div> 
    </div>
    <div class="mt-2"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="responsive-table">
                <table class="table table-striped" id="pecas">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Qtde. em Estoque</th>       
                        <th></th>
                    </tr>
                </thead>
            <tbody>
            </tbody >
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
      const url = "{{ route('peca.getAll') }}";
      $.getJSON(url, function (data){
        if (Array.isArray(data) && data.length){
          data.forEach(peca => {
            console.log(peca)
            row = '<tr>';
            row += '<td>'+ peca.codigo +'</td>';
            row += '<td>'+ peca.titulo +'</td>';
            row += '<td>'+ peca.descricao +'</td>';
            row += '<td>'+ peca.preco +'</td>';
            row += '<td>'+ peca.quantidade_pecas +'</td>';
            row += `<td class="text-center">                        
                        <a href="{{route('peca.edit',':id')}}" class="btn btn-sm btn-secondary" title="Editar"><li class="fa fa-edit"></li></a>
                        <a onclick="excluir(:id)" class="btn btn-sm btn-danger" title="Desativar"><li class="fa fa-trash"></li></a>
                    </td>`.replaceAll(':id',peca.id,)
            row += '</tr>';
            $('table#pecas tbody').append(row);
          });
        } else {
          const row = 
            `
              <tr>
                <td colspan="13" class="text-center mx-auto">
                    <p style="padding-top:0.8rem;">Não existem pecas cadastradas.</p>
                </td>
              </tr>
            `;
          $('table#pecas tbody').append(row);
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
            url: "{{ route('peca.delete',':id') }}".replaceAll(':id',id),
            method: 'delete',
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
            }
          })
        }
        document.location.reload(true);
      })
    }
  </script>
@endpush