@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        <div class="display shadow-2xl container p-4 bg-white rounded-5">
            <div class="flex flex-col flex-wrap md:flex-row justify-between items-center">
                {{-- @foreach ($classes as $item) --}}
                <x-rapport-card to='rapports.annuel' title="Paiements Frais Scolaire Annuel" :icon="'fa-money-bill'"></x-rapport-card>
                <x-rapport-card to='rapports.index' title="Paiements Frais Scolaire Periodique" :icon="'fa-money-bill'"></x-rapport-card>
                <x-rapport-card  to='rapports.frequentations' title="Frequentations" :icon="'fa-chart-line'"></x-rapport-card>
                <x-rapport-card  to='rapports.stock' title="Etat de Stock" :icon="'fa-boxes-stacked'"></x-rapport-card>
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
@endsection
