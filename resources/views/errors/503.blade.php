@extends('layouts.error')

@section('title', 'SmartOS - Serviço indisponível')
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Serviço indisponível'))

