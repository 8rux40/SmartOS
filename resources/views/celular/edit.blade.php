@extends('layouts.app')

@section('content')
<div class="container">
<<<<<<< HEAD
  <form method="post" id="formEditCelular">
  @csrf   
  @method('PUT')
=======
  <form action="{{ route('celular.edit') }}" method="post" id="formCreateCelular">
  @csrf   
>>>>>>> 7251066b81880d4a2b5ec48e4b82410d877bbfa6
    <div class="row">
      <div class="col-md">
        <div class="form-group">
          <label for="InputImei1">Primeiro Imei do celular</label>
<<<<<<< HEAD
          <input  type="text" class="form-control" id="InputImei1" name="celular_imei" value= "{{ $celular->imei }}">
=======
          <input  type="text" class="form-control" id="InputImei1" name="celular_imei">
>>>>>>> 7251066b81880d4a2b5ec48e4b82410d877bbfa6
        </div>
      </div> 
      <div class="col-md">
        <div class="form-group">
          <label for="InputImei2">Segundo Imei do celular</label>
<<<<<<< HEAD
          <input  type="text" class="form-control" id="InputImei2" name="celular_imei2" value= "{{ $celular->imei2 }}">
=======
          <input  type="text" class="form-control" id="InputImei2" name="celular_imei2">
>>>>>>> 7251066b81880d4a2b5ec48e4b82410d877bbfa6
        </div>
      </div> 
      <div class="col">
        <div class="form-group">
          <label for="MarcaCelular">Marca do celular</label>
<<<<<<< HEAD
          <input  type="text" class="form-control" id="MarcaCelular" required="true" name="celular_marca" value= "{{$celular->marca}}">
=======
          <input  type="text" class="form-control" id="MarcaCelular" required="true" name="celular_marca">
>>>>>>> 7251066b81880d4a2b5ec48e4b82410d877bbfa6
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="ModeloCelular">Modelo do celular</label>
<<<<<<< HEAD
          <input type="text" class="form-control" id="ModeloCelular" required="true"  name="celular_modelo" value= "{{$celular->modelo}}">
=======
          <input type="text" class="form-control" id="ModeloCelular" required="true"  name="celular_modelo">
>>>>>>> 7251066b81880d4a2b5ec48e4b82410d877bbfa6
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2">
<<<<<<< HEAD
          <button type="submit" class="btn btn-primary">Editar celular</button>
      </div>            
    </div>
  </form>
</div>
@endsection

@push('javascript')
<script>
</script>
@endpush