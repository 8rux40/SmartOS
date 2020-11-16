@extends('layouts.error')

@section('title', 'SmartOS - Credenciais requeridas')
@section('code', '401')
@section('message', __($exception->getMessage() ?: 'Você não possui permissão para acessar essa parte do sistema.'))
