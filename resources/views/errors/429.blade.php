@extends('layouts.error')

@section('title', 'SmartOS - Muitas requisições')
@section('code', '429')
@section('message', __($exception->getMessage() ?: 'Muitas requisições estão vindo de sua máquina.'))

