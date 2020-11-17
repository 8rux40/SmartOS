@extends('layouts.app')

@section('content')
<div class="container">
  <form method="post" id="formCreateCelular">
  @csrf   
  <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
    <div class="row">
      <div class="col-md">
        <div class="form-group">
          <label for="InputImei1">Primeiro Imei do celular</label>
          <input  type="text" class="form-control" id="InputImei1" name="imei">
        </div>
      </div> 
      <div class="col-md">
        <div class="form-group">
          <label for="InputImei2">Segundo Imei do celular</label>
          <input  type="text" class="form-control" id="InputImei2" name="imei2">
        </div>
      </div> 
      <div class="col">
        <div class="form-group">
          <label for="MarcaCelular">Marca do celular</label>
          <input  type="text" class="form-control" id="MarcaCelular" required="true" name="marca">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="ModeloCelular">Modelo do celular</label>
          <input type="text" class="form-control" id="ModeloCelular" required="true"  name="modelo">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2">
          <button type="submit" class="btn btn-primary">Cadastrar celular</button>
      </div>            
    </div>
  </form>
</div>
@endsection

@push('javascript')
<script>
 $('#formCreateCelular').submit(function(e){
  e.preventDefault();
   var serializedData = $(this).serialize();

  $.ajax({
    url: "{{ route('celular.store') }}",
    method: 'post',
    dataType: 'json',
    data: serializedData,
    success: function (response) {
      console.log(response)
      if(response.success) {
        Swal.fire({
          title: 'Sucesso!',
                text: response.message,
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#888',
                confirmButtonText: 'Ver cliente cadastrado',
                cancelButtonText: 'Cadastrar outro cliente'
        }).then((result) => {
          if(result.value) {
            $(location).attr('href', response.route);
          } else {
            //limparFormulario()
          }
        })
      } else {
        //mostrarErros(response.errors);
      }
    }
  });
 });
</script>
@endpush