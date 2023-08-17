@extends('errors::minimal')

@section('title', __(env('APP_NAME')))
@section('code', '500')
@section('message', __('Erreur du Serveur'))
