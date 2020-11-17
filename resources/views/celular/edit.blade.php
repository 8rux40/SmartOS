@extends('layouts.app')

@section('content')
<div class="container">
  <form action="{{ route('celular.edit') }}" method="post" id="formCreateCelular">
  @csrf   
    <div class="row">
      <div class="col-md">
        <div class="form-group">
          <label for="InputImei1">Primeiro Imei do celular</label>
          <input  type="text" class="form-control" id="InputImei1" name="celular_imei">
        </div>
      </div> 
      <div class="col-md">
        <div class="form-group">
          <label for="InputImei2">Segundo Imei do celular</label>
          <input  type="text" class="form-control" id="InputImei2" name="celular_imei2">
        </div>
      </div> 
      <div class="col">
        <div class="form-group">
          <label for="MarcaCelular">Marca do celular</label>
          <input  type="text" class="form-control" id="MarcaCelular" required="true" name="celular_marca">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="ModeloCelular">Modelo do celular</label>
          <input type="text" class="form-control" id="ModeloCelular" required="true"  name="celular_modelo">
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

</script>
@endpush