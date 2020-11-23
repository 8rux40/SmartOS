@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h3><i class="fas fa-users text-primary"></i> Dados da peça</li> </h3>         
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row mt-1">
                    <div class="col-md-4 grupo-dados-info-peca">
                        <label for="" class="label-info-peca">Título:</label>
                        <span class="dados-info-peca">{{ $peca->titulo }}</span>
                    </div>
                <div class="col-md-4 grupo-dados-info-peca">
                    <label class="label-info-peca" for="">Código:</label>
                    <span class="dados-info-peca">{{ $peca->codigo }}</span>
                </div>
                <div class="col-md-4 grupo-dados-info-peca">
                    <label class="label-info-peca" for="">Preço:</label>
                    <span class="dados-info-peca">{{ $peca->preco }}</span>
                </div>
                <div class="col-md-4 grupo-dados-info-peca">
                    <label class="label-info-peca" for="">Quantidade:</label>
                    <span class="dados-info-peca">{{ $peca->quantidade }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 grupo-dados-info-peca">
                    <label class="label-info-peca" for="">Descrição:</label>
                    <span class="dados-info-peca">{{ $peca->descricao }}</span>
                
                </div>
          </div>
        </div>       
    </div>
@endsection

@push('javascript')

 

@endpush