@extends('layouts.admin')

@section('content')
<div class=" flex flex-col gap-5 md:p-5">
    @if (isset($evaluation))
    <a href="{{ route('eleves.evaluations', [$eleve->id,$evaluation->periode->id]) }}"
        class="p-2 bg-white rounded-full w-8 h-8 flex justify-center items-center">
    @else
    <a href="{{ route('eleves.examens', [$eleve->id,$examen->trimestre->id]) }}"
        class="p-2 bg-white rounded-full w-8 h-8 flex justify-center items-center">
    @endif
        <i class="fa fa-solid fa-arrow-left"></i></a>
    <x-eleve-profile-header :data="$eleve"> </x-eleve-profile-header>


    <div class="container bg-white rounded-2xl p-5">
        @if (isset($evaluation))
            <p class="font-bold uppercase"> {{$evaluation->type_evaluation->nom . " " .$evaluation->cours->nom}} du {{ $evaluation->date_evaluation }}</p>
        @else
            <p class="font-bold uppercase">Examen de {{$examen->cours->nom}} du {{ $examen->date_examen }}</p>
        @endif
        @if (isset($evaluation))
        <form method="POST" action="{{ route('eleves.evaluations.update', $self->id) }}">
    @else
    <form method="POST" action="{{ route('eleves.examens.update', $self->id) }}">
    @endif
        @method('PUT')
        @csrf
        <!-- Email Address -->
        <div class="mt-4 w-40">
            @if (isset($evaluation))
                <x-label for="note_obtenu" :value="'Note Obtenu sur : ' . $evaluation->note_max" />
            @else
                <x-label for="note_obtenu" :value="'Note Obtenu sur : ' . $examen->note_max" />
            @endif
            <div class="flex w-full flex-row gap-2 ">
                <x-input id="matricule" class="block mt-1" type="text" name="note_obtenu" :value="($self->note_obtenu)" required />
                <input type="hidden" name="eleve" value="{{$eleve->id}}">
                @if (isset($evaluation))
                    <input type="hidden" name="periode" value="{{$evaluation->periode->id}}">
                    {{-- <p class="w-full">/ {{$evaluation->note_max}}</p>  --}}
                @else
                    <input type="hidden" name="trimestre" value="{{$examen->trimestre->id}}">
                    {{-- <p class="w-full">/ {{$examen->note_max}}</p>  --}}
                @endif
            </div>
        </div>
        <div class="mt-4">
            <x-button>Enregistrer</x-button>
        </div>
    </form>
</div>
    
    </div>

@endsection