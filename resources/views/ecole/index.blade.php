@extends('layouts.admin')

@section('content')
    
    <div class="container flex flex-col justify-between gap-5">
        <x-nav-ecole :pagename="($page_name)"></x-nav-ecole>

        <div class="flex flex-auto gap-5">
            <div class="bg-white rounded-5 p-5 shadow-2xl flex flex-col gap-1">
                <span class="font-base text-sm text-slate-500 uppercase">Annee Scolaire encours:</span>
                <span class="font-bold text-2xl"> {{$annee->nom}} </span>
            </div>
            <div class="bg-white rounded-5 p-5 shadow-2xl flex flex-col gap-1">
                <span class="font-base text-sm text-slate-500 uppercase">Trimestre encours:</span>
                <span class="font-bold text-2xl"> {{$trimestre->nom}} </span>
            </div>
            <div class="bg-white rounded-5 p-5 shadow-2xl flex flex-col gap-1">
                <span class="font-base text-sm text-slate-500 uppercase">Periode encours:</span>
                <span class="font-bold text-2xl"> {{$periode->nom}} </span>
            </div>
        </div>

    </div>

@endsection