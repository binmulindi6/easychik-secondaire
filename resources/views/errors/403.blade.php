@extends('errors::minimal')

@section('title', __('S.A.S'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Acces Refusé'))
