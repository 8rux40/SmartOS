@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-9">
        <h3><i class="fas fa-coins"></i> Orçamentos</li> </h3> 
      </div>
      <div class="col-md-3">
        <button type="button" class="btn btn-outline-dark">Solicitar orçamento</button>
      </div>
    </div>
  <div class="mt-2"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="responsive-table">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>
                  <button type="button" class="btn btn-outline-success">
                    <i class="fas fa-check"></i>
                  </button>
                  <button type="button" class="btn btn-outline-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>          
    </div>        
  </div>
@endsection

@push('javascript')
<script>

</script>
@endpush