@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-light"> <i class="fas fa-tachometer-alt"></i> &nbsp; {{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @can('informar orcamento')
                        <div class="row">
                            <div class="col-md-3">
                                <h1 class="text-center text-success display-3">{{$qtde_orcamentos_pendentes}}</h1>
                            </div>
                            <div class="col-md-9">
                                <h3>Orçamentos pendentes</h3>
                                <p>Orçamentos pendentes de análise técnica para estimar o valor total do serviço. Informe o valor orçado para que o atendente possa entrar em contato com o cliente.</p>
                                <a href="{{ route('orcamento.index') }}" class="btn btn-success"><i class="fas fa-coins"></i>&nbsp;Ir para orçamentos</a>
                            </div>
                        </div>      
                        <hr>         
                    @endcan
                    @can('gerar os')
                        <div class="row">
                            <div class="col-md-3">
                                <h1 class="text-center text-success display-3">{{$qtde_orcamentos_informados}}</h1>
                            </div>
                            <div class="col-md-9">
                                <h3>Orçamentos informados</h3>
                                <p>Orçamentos informados pelos técnicos reparadores. Entre em contato com os clientes para abrir ordens de serviço a partir desses orçamentos.</p>
                                <a href="{{ route('orcamento.index') }}" class="btn btn-success"><i class="fas fa-coins"></i>&nbsp;Ir para orçamentos</a>
                            </div>
                        </div>      
                        <hr>         
                    @endcan
                    @can('fechar os')
                        <div class="row">
                            <div class="col-md-3">
                                <h1 class="text-center text-primary display-3">{{$qtde_os_abertas}}</h1>
                            </div>
                            <div class="col-md-9">
                                <h3>Ordens de serviço abertas</h3>
                                <p>Ordens de serviço abertas por atendentes. Execute os serviços solicitados e feche as ordens de serviços informando o valor de serviço e as peças utilizadas no reparo.</p>
                                <a href="{{ route('ordemservico.index') }}" class="btn btn-primary"><i class="fas fa-clipboard-list"></i>&nbsp;Ir para ordens de serviço</a>
                            </div>
                        </div>      
                        <hr>         
                    @endcan
                    @can('cancelar os')
                        <div class="row">
                            <div class="col-md-3">
                                <h1 class="text-center text-primary display-3">{{$qtde_os_concluidas}}</h1>
                            </div>
                            <div class="col-md-9">
                                <h3>Ordens de serviço concluídas</h3>
                                <p>Ordens de serviço concluídas pelos técnicos reparadores. Entre em contato com os clientes para avisar que o serviço foi concluído.</p>
                                <a href="{{ route('ordemservico.index') }}" class="btn btn-primary"><i class="fas fa-clipboard-list"></i>&nbsp;Ir para ordens de serviço</a>
                            </div>
                        </div>       
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection