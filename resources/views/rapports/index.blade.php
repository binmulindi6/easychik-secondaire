@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        <div class="display shadow-2xl container p-4 bg-white rounded-5">
            <div class="flex flex-col md:flex-row justify-between items-center w-full ">
                {{-- @foreach ($classes as $item) --}}
                <x-rapport-card to='rapports.annuel' title="Paiements Frais Scolaire Annuel"></x-rapport-card>
                <x-rapport-card to='rapports.index' title="Paiements Frais Scolaire Periodique"></x-rapport-card>
                <x-rapport-card  to='rapports.frequentations' title="Frequentations"></x-rapport-card>
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
@endsection
