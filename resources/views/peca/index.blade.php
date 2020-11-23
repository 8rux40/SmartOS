@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <h3><i class="fas fa-tools text-primary"></i> Peças </li> </h3> 
        </div>
        <div class="col-md-7">
            <form action="" method="POST" id="formPesquisarPeca">
            @csrf
                <div class="col-md-4">
                    <input type="text" class="form-control" id="PesquisaPeca" required="true" placeholder="Pesquisar peça...">
                    <select class="custom-select custom-select-sm">
                        <option selected>Selecione um filtro</option>
                        <option value="1">Título da peça</option>
                        <option value="2">Código da peça</option>               
                    </select>
                </div>
                <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Pesquisar peça</button>
                </div>
            </form>   
        </div>  
        

        <div class="col-md-3">
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
<script>
 
</script>
@endpush