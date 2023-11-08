@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        <x-nav-horaire :pagename="$page_name"> </x-nav-horaire>
        <div class="display shadow-2xl container p-4 bg-white rounded-5">
            <div class="flex flex-wrap w-full justify-center">
                @if (count($classes) > 0)
                    @foreach ($classes as $item)
                        <x-classe-card :to="'evaluations.classe'" :data="$item"></x-classe-card>
                    @endforeach
                @else
                    @if(Auth::user()->isDirecteur() || Auth::user()->isManager())
                    <div class="flex flex-col justify-center gap-2 p-5">
                        <span class="uppercase text-red-500 font-semibold text-4 sm:text-6 text-center">⚠️ Veuillez Ajouter des
                            classes Pour pouvoir gerer les travaux des eleves</span>
                        <a href="{{route('classes.create')}}" class="text-center">
                            <x-button>Ajouter une Classe</x-button></a>
                    </div>
                    @else
                    <div class="flex flex-col justify-center gap-2 p-5">
                        <span class="uppercase text-red-500 font-semibold text-4 sm:text-6 text-center">Vous devez enseigner un Cours Pour pouvoir gerer les travaux des eleves </span>
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
