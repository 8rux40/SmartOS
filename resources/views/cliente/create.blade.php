@extends('layouts.app')

@section('content')

<div class="container">
  <form action="{{ route('cliente.create') }}" method="post" id="create">
  @csrf            
  </form>
</div>

@endsection

@push('javascript')
<script>
 
</script>
@endpush