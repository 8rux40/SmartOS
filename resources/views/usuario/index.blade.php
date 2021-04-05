@extends('layouts.app')

@section('content')
    @livewire('usuario')
@endsection

@push('javascript')
<script>
    window.livewire.on('userStore', () => { $('#createModal').modal('hide'); });
    window.livewire.on('userUpdate', () => { $('#updateModal').modal('hide'); });
</script>
@endpush