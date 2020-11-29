@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h3><i class="fas fa-users text-primary"></i> Dados da Ordem Serviço</li> </h3>         
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-title">
                    Dados do Cliente
                </div>
                <div class="card-body">
                    <form action="" method="post" id="solicitarOrcamento">
                    @csrf
                        <input type="hidden" name="cliente_id" value="">
                        <input type="hidden" name="celular_id" value="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NomeCliente">Nome do cliente</label>
                                    <input disabled="disabled" type="text" class="form-control" id="NomeCliente" required="true" name="cliente_nome" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="CpfCliente">CPF</label>
                                    <input disabled="disabled" type="text" class="form-control" id="CpfCliente" required="true" name="cpf" value="">
                                </div>
                            </div> 
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="TelefoneCliente">Número de telefone</label>
                                    <input disabled="disabled" type="text" class="form-control" id="TelefoneCliente" name="cliente_numero_tel" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="CelularCliente">Número de celular</label>
                                    <input disabled="disabled" type="text" class="form-control" id="CelularCliente" name="cliente_numero_cel" value="">
                                </div>
                            </div>                       
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="EnderecoCliente">Endereço</label>
                                    <input disabled="disabled" type="text" class="form-control" id="EnderecoCliente" required="true" name="cliente_endereco" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="EmailCliente">Email</label>
                                    <input disabled="disabled" type="email" class="form-control" id="EmailCliente" aria-describedby="emailHelp" name="cliente_email" value="">         
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>          
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-title">
                    Dados do celular
                </div>
                <div class="card-body">
                    <form action="" method="post" id="solicitarOrcamento">
                    @csrf
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="MarcaCelular">Marca do celular</label>
                                    <input disabled="disabled" type="text" class="form-control" id="MarcaCelular" required="true" name="marca" value="">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="ModeloCelular">Modelo do celular</label>
                                    <input disabled="disabled" type="text" class="form-control" id="ModeloCelular" required="true" name="modelo" value="">
                                </div>
                            </div> 
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="InputImei1">IMEI</label>
                                    <input disabled="disabled" type="text" class="form-control" id="InputImei1" name="imei" value="">
                                </div>
                            </div class="col-md">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="InputImei2">IMEI 2 (Opcional)</label>
                                    <input disabled="disabled" type="text" class="form-control" id="InputImei2" name="imei2" value="">
                                </div>
                            </div>                       
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="DescricaoProblema">Descrição do problema do celular</label>
                                    <textarea class="form-control" id="DescricaoProblema" rows="4" required name="descricao_problema"></textarea>
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>       
            </div>
        </div>
    </div>
</div>
    
        
@endsection

@push('javascript')
@endpush