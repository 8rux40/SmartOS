@extends('layouts.error')

@section('title', 'SmartOS - Página não encontrada')
@section('code', '404')
@section('message', __($exception->getMessage() ?: 'A página que você tentou visitar não existe ou mudou de endereço.'))
