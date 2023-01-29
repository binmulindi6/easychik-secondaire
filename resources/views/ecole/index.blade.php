@extends('layouts.admin')

@section('content')
    
    <div class="container flex flex-col justify-between gap-5">
        <x-nav-ecole :pagename="($page_name)"></x-nav-ecole>

        <div class="flex flex-auto gap-5">
            <div class="bg-white rounded-5 p-5 min-w-75 min-h-40 shadow-2xl">
                <p class="font-base text-sm text-slate-500 uppercase">Annee Scolaire encours:</p>
                <p class="font-bold text-2xl"> {{$annee->nom}} </p>
            </div>
            <div class="bg-white rounded-5 p-5 min-w-75 min-h-40 shadow-2xl">
                <p class="font-base text-sm text-slate-500 uppercase">Trimestre encours:</p>
                <p class="font-bold text-2xl"> {{$trimestre->nom}} </p>
            </div>
            <div class="bg-white rounded-5 p-5 min-w-75 min-h-40 shadow-2xl">
                <p class="font-base text-sm text-slate-500 uppercase">Periode encours:</p>
                <p class="font-bold text-2xl"> {{$periode->nom}} </p>
            </div>
        </div>
    </div>

@endsection