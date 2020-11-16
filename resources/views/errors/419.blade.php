@extends('layouts.error')

@section('title', 'SmartOS - Página expirou')
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'A página que você está tentando acessar expirou... Tente novamente!'))


