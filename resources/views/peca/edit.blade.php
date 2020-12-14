@extends('layouts.app')

@section('content')
<div class="container">
  <form method="post" id="formEditPeca">
  @csrf   
  @method('PUT')
    <div class="row">
      <div class="col-md">
        <div class="form-group">
          <label for="TituloPeca">Título da peça</label>
          <input  type="text" class="form-control" id="TituloPeca" name="titulo" value= "{{ $peca->titulo }}">
        </div>
      </div> 
      <div class="col-md">
        <div class="form-group">
          <label for="CodigoPeca">Código da peça</label>
          <input  type="text" disabled class="form-control" id="CodigoPeca" name="codigo" value= "{{ $peca->codigo }}">
        </div>
      </div> 
      <div class="col">
        <div class="form-group">
          <label for="DescricaoPeca">Descrição da peça</label>
          <input  type="text" class="form-control" id="DescricaoPeca" required="true" name="descricao" value= "{{$peca->descricao}}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="PrecoPeca">Preço da peça</label>
          <input type="text" class="form-control number" id="PrecoPeca" required="true"  name="preco" value= "{{$peca->preco}}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="QuantidadePeca">Quantidade da peça</label>
          <input type="number" min="0" class="form-control" id="QuantidadePeca" required="true" name="quantidade_pecas" value= "{{$peca->quantidade_pecas}}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 float-right">
          <button type="submit" class="btn btn-success"><i class="fas fa-check"></i>&nbsp;Salvar alterações</button>
      </div>            
    </div>
  </form>
</div>
@endsection


@push('javascript')
<script>
  $('.number').keypress(function(event) {
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
      event.preventDefault();
    }
  });

 $('#formEditPeca').submit(function(e){
  e.preventDefault();
   var serializedData = $(this).serialize();

  $.ajax({
    url: "{{ route('peca.update', $peca->id) }}",
    method: 'put',
    dataType: 'json',
    data: serializedData,
    success: function (response) {
      console.log(response)
      if(response.success) {
        Swal.fire({
          title: 'Peça editada com sucesso!',
                text: response.message,
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Voltar a página de peças',
        }).then((result) => {
          if(result.value) {
            $(location).attr('href', "{{ route('peca.index') }}");
          } 
        })
      } else {
        mostrarErros(response.errors);
      }
    }
  });
 });

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