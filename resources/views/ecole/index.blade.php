@extends('layouts.admin')

@section('content')
    
    <div class="container flex flex-col justify-between gap-5">
        <x-nav-ecole :pagename="($page_name)"></x-nav-ecole>

        <div class="flex flex-auto gap-5">
            <div class="bg-white rounded-5 p-5 shadow-2xl flex flex-col gap-1">
                <span class="font-base text-sm text-slate-500 uppercase">Annee Scolaire en cours:</span>
                <span class="font-bold text-2xl"> {{$annee ? $annee->nom  : "Not Defined" }} </span>
            </div>
            <div class="bg-white rounded-5 p-5 shadow-2xl flex flex-col gap-1">
                <span class="font-base text-sm text-slate-500 uppercase">Trimestre en cours:</span>
                <span class="font-bold text-2xl"> {{$trimestre ? $trimestre->nom : "Not Defined" }} </span>
            </div>
            <div class="bg-white rounded-5 p-5 shadow-2xl flex flex-col gap-1">
                <span class="font-base text-sm text-slate-500 uppercase">Periode en cours:</span>
                <span class="font-bold text-2xl"> {{$periode ? $periode->nom : "Not Defined" }} </span>
            </div>
        </div>

    </div>

@endsection