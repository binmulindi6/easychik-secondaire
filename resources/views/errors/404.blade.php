@extends('errors::minimal')

@section('title', __(env('APP_NAME')))
@section('code', '404')
@section('message', __('Page non trouvée'))
@section('action')
    <form id="profile" class="flex items-center justify-center pt-2"
    action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit"
            class="p-0 text-black font-semibold transition-all text-size-sm ease-nav-brand ">
            {{-- <i fixed-plugin-button-nav class=" text-red-500 fa fa-lock"
                title="logout"></i> --}}
            {{-- <a href="{{$_SERVER['HTTP_REFERER']}}" class=" text-5 text-blue-500 hover:underline">Acceuil</a> --}}
            <button type="button" class=" text-5 text-blue-500 hover:underline" onclick="javascript:history.go(-1)">Retour</button>
        </button title="logout">
    </form>
@endsection