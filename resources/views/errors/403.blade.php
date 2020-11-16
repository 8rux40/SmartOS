@extends('layouts.error')

@section('title', 'SmartOS - Acesso Negado')
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Você não possui permissão para realizar esta ação.'))
