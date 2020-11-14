@extends('layouts.app')

@section('content')
    <form action="{{ route('orcamento.solicitar') }}" method="post">
    @csrf
        <input type="text" id="nome" name="nome">
        <input type="submit" value="Enviar">
    </form>
@endsection

@push('javascript')
<script>

</script>
@endpush