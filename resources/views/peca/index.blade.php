@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <form action="" class="form-inline my-2 my-lg-0">
                <input type="search" class="form-control mr-sm-2" placeholder="Pesquisar peças" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
            </form>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-9">
            <h3>Gerenciar Peças</h3>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-outline-dark">Cadastrar uma nova peça</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Código</th>
                            <th scope="col">Título</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>00001</td>
                            <td>Bateria para Xiaomi</td>
                            <td>Bateria super potente para Xiaomi</td>
                            <td>5</td>
                            <td>R$80,00</td>
                            <td>
                                <button type="button" class="btn btn-outline-success">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                        <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                                        <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                      </svg>
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-excel" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                      <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                                      <path fill-rule="evenodd" d="M5.18 6.616a.5.5 0 0 1 .704.064L8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 0 1 .064-.704z"/>
                                    </svg>
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