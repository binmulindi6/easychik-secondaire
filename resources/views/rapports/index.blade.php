@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        <div class="display shadow-2xl container p-4 bg-white rounded-5">
            <div class="flex flex-col flex-wrap md:flex-row justify-between items-center">
                {{-- @foreach ($classes as $item) --}}
                @if (Auth::user()->isManager() || Auth::user()->isSecretaire())
                    <x-rapport-card to='rapports.annuel' title="Paiements Frais Scolaire Annuel" :icon="'fa-money-bill'"></x-rapport-card>
                    <x-rapport-card to='rapports.index' title="Paiements Frais Scolaire Periodique" :icon="'fa-money-bill'"></x-rapport-card>
                @endif
                @if (Auth::user()->isManager() || Auth::user()->isSecretaire() || Auth::user()->isDirecteur())
                <x-rapport-card  to='rapports.frequentations' title="Frequentations de Eleves" :icon="'fa-chart-line'"></x-rapport-card>
                @endif
                @if (Auth::user()->isManager() || Auth::user()->isLog())
                <x-rapport-card  to='rapports.stock' title="Etat de Stock" :icon="'fa-boxes-stacked'"></x-rapport-card>
                @endif
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
@endsection
