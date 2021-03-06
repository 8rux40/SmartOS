@extends('layouts.app')

@section('content')
<div class="container">
  <form method="post" id="formEditCelular">
  @csrf   
  @method('PUT')
    <div class="row">
      <div class="col-md">
        <div class="form-group">
          <label for="InputImei1">Primeiro Imei do celular</label>
          <input  type="text" class="form-control" id="InputImei1" name="imei" value= "{{ $celular->imei }}">
        </div>
      </div> 
      <div class="col-md">
        <div class="form-group">
          <label for="InputImei2">Segundo Imei do celular</label>
          <input  type="text" class="form-control" id="InputImei2" name="imei2" value= "{{ $celular->imei2 }}">
        </div>
      </div> 
      <div class="col">
        <div class="form-group">
          <label for="MarcaCelular">Marca do celular</label>
          <input  type="text" class="form-control" id="MarcaCelular" required="true" name="marca" value= "{{$celular->marca}}">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="ModeloCelular">Modelo do celular</label>
          <input type="text" class="form-control" id="ModeloCelular" required="true"  name="modelo" value= "{{$celular->modelo}}">
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
 $('#formEditCelular').submit(function(e){
  e.preventDefault();
   var serializedData = $(this).serialize();

  $.ajax({
    url: "{{ route('celular.update', $celular->id) }}",
    method: 'put',
    dataType: 'json',
    data: serializedData,
    success: function (response) {
      console.log(response)
      if(response.success) {
        Swal.fire({
          title: 'Celular editado com sucesso!',
                text: response.message,
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Voltar ao Cliente',
        }).then((result) => {
          if(result.value) {
            $(location).attr('href', "{{ route('cliente.show', $celular->cliente_id) }}");
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