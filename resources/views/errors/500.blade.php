@extends('layouts.error')

@section('title', 'SmartOS - Erro no servidor')
@section('code', '500')
@section('message', __($exception->getMessage() ?: 'Erro no servidor'))

