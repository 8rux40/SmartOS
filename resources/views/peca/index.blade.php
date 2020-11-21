@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h3><i class="fas fa-tools text-primary"></i> Peças </li> </h3> 
        </div>      
    </div>
    <div class="mt-2"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="responsive-table">
                <table class="table table-striped" id="pecas">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Código</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Quantidade</th>       
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

</script>
@endpush