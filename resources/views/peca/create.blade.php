@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h3><i class="fas fa-tools text-primary"></i> Nova peça </li> </h3>         
        </div>
    </div>            
        <div class="card">
            <div class="card-body">
            <form method="post" id="formCreatePeca">
            @csrf                   
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TituloPeca">Título</label>
                            <input type="text" class="form-control" id="TituloPeca" required="true">
                        </div>
                    </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="CodigoPeca">Código</label>
                        <input type="text" class="form-control" id="CodigoPeca" required="true">
                    </div>
                </div> 
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="PrecoPeca">Preço</label>
                        <input type="text" class="form-control" id="PrecoPeca">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="QuantidadePeca">Quantidade</label>
                        <input type="text" class="form-control" id="QuantidadePeca">
                    </div>
                </div> 
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="DescricaoPeca">Descrição da peça</label>
                            <textarea class="form-control" id="DescricaoPeca" rows="4" required name="descricao_peca"></textarea>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success float-right"><i class="fas fa-check"></i>&nbsp;Salvar</button>
                    </div>
                </div>           
                                  
            </form>                     
        </div>
    </div>
</div>
@endsection

@push('javascript')

@endpush