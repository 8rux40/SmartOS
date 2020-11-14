@extends('layouts.app')

@section('content')
    <div class="row mt-2">
    <div class="container">
        <form action="{{ route('orcamento.solicitar') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <label for="InputImei1">Primeiro Imei do celular</label>
                    <input type="text" class="form-control" id="InputImei1" name="celular_imei">            
                </div>
            </div> 
            <div class="col-md">
                <div class="form-group">
                    <label for="InputImei2">Segundo Imei do celular</label>
                    <input type="text" class="form-control" id="InputImei2" name="celular_imei2">            
                </div>
            </div> 
            <div class="col">
                <div class="form-group">
                    <label for="MarcaCelular">Marca do celular</label>
                    <input type="text" class="form-control" id="MarcaCelular" name="celular_marca" required="true">            
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="ModeloCelular">Modelo do celular</label>
                    <input type="text" class="form-control" id="ModeloCelular"  name="celular_modelo" required="true">            
                </div>
            </div>          
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="NomeCliente">Nome do cliente</label>
                    <input type="text" class="form-control" id="NomeCliente" name="cliente_nome" required="true">            
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="CpfCliente">CPF</label>
                    <input type="text" class="form-control" id="CpfCliente" name="cliente_cpf" required="true">            
                </div>
            </div> 
            <div class="col-md-2">
                <div class="form-group">
                    <label for="TelefoneCliente">Número de telefone</label>
                    <input type="text" class="form-control" id="TelefoneCliente" name="cliente_numero_tel">            
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="CelularCliente">Número de celular</label>
                    <input type="text" class="form-control" id="CelularCliente" name="cliente_numero_cel">            
                </div>
            </div>                       
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label for="EnderecoCliente">Endereço</label>
                    <input type="text" class="form-control" id="EnderecoCliente" name="cliente_endereco" required="true">            
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="EmailCliente">Email</label>
                    <input type="email" class="form-control" id="EmailCliente" aria-describedby="emailHelp" name="cliente_email">   
                    <small id="emailHelp" class="form-text text-muted" name="descricao_problema">Nós nunca iremos compartilhar o seu e-mail.</small>         
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label for="DescricaoProblema">Descrição do problema do celular</label>
                    <textarea class="form-control" id="DescricaoProblema" rows="4" require></textarea>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Solicitar orçamento</button>
            </div>            
        </div>             
        </form>
    </div>
    
    
@endsection

@push('javascript')
<script>

</script>
@endpush