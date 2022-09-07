@extends('layouts.sas')

@section('content')
    <div class="container p-5">
        <div class="container">
            <p class="font-bold text-2xl">Eleve : {{$eleve->nom . " " . $eleve->prenom }}</p>
            @if (isset($evaluation))
                <p class="font-bold text-2xl"> {{$evaluation->type_evaluation->nom . " " .$evaluation->cours->nom}} du {{ $evaluation->date_evaluation }}</p>
            @else
                <p class="font-bold text-2xl">Examen de {{$examen->cours->nom}} du {{ $examen->date_examen }}</p>
            @endif
        </div>
    @if (isset($evaluation))
    <form method="POST" action="{{ route('eleves.evaluations.update', $self->id) }}">
    @else
    <form method="POST" action="{{ route('eleves.examens.update', $self->id) }}">
    @endif
        @method('PUT')
        @csrf
        <!-- Email Address -->
        <div class="mt-4 w-40">
            <x-label for="note_obtenu" :value="__('Point Obtenu sur')" />
            <div class="flex align-center">
                <x-input id="matricule" class="block mt-1" type="text" name="note_obtenu" :value="($self->note_obtenu)" required />
                <input type="hidden" name="eleve" value="{{$eleve->id}}">
                @if (isset($evaluation))
                    <input type="hidden" name="periode" value="{{$evaluation->periode->id}}">
                    <p class="text-xl font-bold ">/ {{$evaluation->note_max}}</p> 
                @else
                    <input type="hidden" name="trimestre" value="{{$examen->trimestre->id}}">
                    <p class="text-xl font-bold ">/ {{$examen->note_max}}</p> 
                @endif
            </div>
        </div>
        <div class="mt-4">
            <x-button>ajouter</x-button>
        </div>
    </form>
        
    </div>

@endsection