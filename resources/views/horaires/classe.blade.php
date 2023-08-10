@extends('layouts.admin')
<style>
    body {
        /* display: none; */
    }

    /* @page{
                size: a4 portrait;
                /* margin: 500px;
                /* display: none; */
    /* background: #000; */
    /*} */

    @media print {

        /* @page{
                    size: a4 portrait;
                    margin: 1%;
                } */
        body {
            background: #fff;
        }

        #printable {
            /* min-width: 23cm; */
            margin: auto;
            transform: scale(0.90);
            position: fixed;
            top: 0;
            left: 0;
            /* transform-origin: auto 0; */
            /* padding: 10px; */
            /* display: none; */
            /* background: #000; */
        }

    }
</style>
@section('content')
    <div class="container flex flex-col justify-between gap-5">
        <x-nav-horaire :pagename="$page_name" :print="true"> </x-nav-horaire>
        <div id="display-reussite" class="display-passation hidden shadow-2xl container p-4 bg-white rounded-5 flex flex-col gap-2 justify-end">
            <div class="flex justify-end">
                <a class="hidden btn-horaire-terminer " href="{{ route('horaires.classe', $classe->id) }}">
                    <x-button> ✅ terminer </x-button>
                </a>
                <x-button id="btn-echecs" class='btn-horaire-retour btn-passation'> Retour </x-button>
            </div>

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="border-collapse border items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <caption
                            class="font-bold text-center uppercase align-middle bg-transparent shadow-none text-4 border tracking-none whitespace-nowrap p-2">
                            Horaire des cours
                            classe de {{ $classe->nomComplet() }}
                        </caption>
                        <thead>
                            <tr>
                                <td
                                    class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-4 border-solid tracking-none whitespace-nowrap">
                                    HEURES</td>
                                @foreach ($jours as $jour)
                                    <td
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-4 border-solid tracking-none whitespace-nowrap">
                                        {{ $jour->nom }}</td>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($heures as $heure)
                                <tr class=" rounded-2xl ">
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        {{ $heure->heures() }}</td>
                                    @foreach ($jours as $jour)
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($horaires as $horaire)
                                            @if ($horaire->heure->id === $heure->id && $horaire->jour->id === $jour->id)
                                                @php
                                                    $i = 1;
                                                @endphp
                                                <td
                                                    class="p-1 uppercase text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                    <form id="frm{{ $jour->id . $heure->id }}"
                                                        action="{{ route('api.horaires.store') }}" method="post"
                                                        class="mb-0 flex flex-col items-center gap-1">
                                                        @csrf
                                                        @if ($horaire->isRecreation === 1)
                                                            <x-select id="{{ $jour->id . $heure->id }}"
                                                                class="select-trigger border-none w-40" :isHoraire="true"
                                                                name="cours" :collection="$cours" :qq="true"
                                                                :val="'RECREATION'" />
                                                        @else
                                                            <x-select id="{{ $jour->id . $heure->id }}"
                                                                class="select-trigger border-none w-40" :isHoraire="true"
                                                                name="cours" :collection="$cours" :qq="true"
                                                                :val="$horaire->cours" />
                                                        @endif
                                                        <input id="classe{{ $jour->id . $heure->id }}" type="hidden"
                                                            name="classe" value="{{ $classe->id }}">
                                                        <input id="jour{{ $jour->id . $heure->id }}" type="hidden"
                                                            name="jour" value="{{ $jour->id }}">
                                                        <input id="heure{{ $jour->id . $heure->id }}" type="hidden"
                                                            name="heure" value="{{ $heure->id }}">
                                                        <input type="hidden" name="token"
                                                            id="token{{ $jour->id . $heure->id }}"
                                                            value="{{ csrf_token() }}">
                                                        <input type="hidden" name=""
                                                            id="user{{ $jour->id . $heure->id }}"
                                                            value="{{ Auth::user()->id }}">
                                                        <span id="err{{ $jour->id . $heure->id }}"
                                                            class="text-3 font-semibold text-red-500"></span>
                                                    </form>
                                                </td>
                                            @endif
                                        @endforeach
                                        @if (isset($i) && $i === 0)
                                            <td
                                                class="p-1 uppercase text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                <form id="frm{{ $jour->id . $heure->id }}"
                                                    action="{{ route('api.horaires.store') }}" method="post"
                                                    class="mb-0 flex flex-col items-center gap-1">
                                                    @csrf
                                                    <x-select id="{{ $jour->id . $heure->id }}"
                                                        class="select-trigger border-none w-40" :isHoraire="true"
                                                        name="cours" :collection="$cours" :qq="true"
                                                        :placeholder="'Choisir un Cours'" />
                                                    <input id="classe{{ $jour->id . $heure->id }}" type="hidden"
                                                        name="classe" value="{{ $classe->id }}">
                                                    <input id="jour{{ $jour->id . $heure->id }}" type="hidden"
                                                        name="jour" value="{{ $jour->id }}">
                                                    <input id="heure{{ $jour->id . $heure->id }}" type="hidden"
                                                        name="heure" value="{{ $heure->id }}">
                                                    <input type="hidden" name="token"
                                                        id="token{{ $jour->id . $heure->id }}" value="{{ csrf_token() }}">
                                                    <input type="hidden" name=""
                                                        id="user{{ $jour->id . $heure->id }}"
                                                        value="{{ Auth::user()->id }}">
                                                    <span id="err{{ $jour->id . $heure->id }}"
                                                        class="text-3 font-semibold text-red-500"></span>
                                                </form>
                                            </td>
                                        @endif
                                        {{-- @endforeach --}}
                                    @endforeach
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
                  <div id="display-echec" class="display-passation shadow-2xl  container p-4 bg-white rounded-5 flex flex-col gap-2 justify-end">
                    @if (Auth::user()->isEnseignant() || Auth::user()->isDirecteur())
                    <div class="flex justify-end">
                        <x-button id="btn-reussite" class='btn-passation'> Modifier </x-button>
                    </div>
                    @endif
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table id="printable"
                                class="border-collapse border items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <caption
                                    class="font-bold text-center uppercase align-middle bg-transparent shadow-none text-4 border tracking-none whitespace-nowrap p-1">
                                    Horaire des cours
                                    classe de {{ $classe->nomComplet() }}
                                </caption>
                                <thead class="align-bottom">

                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-4 border-solid tracking-none whitespace-nowrap">
                                        HEURES</th>
                                    @foreach ($jours as $jour)
                                        <th
                                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-4 border-solid tracking-none whitespace-nowrap">
                                            {{ $jour->nom }}</th>
                                    @endforeach

                                </thead>
                                <tbody>
                                    @foreach ($heures as $heure)
                                        <tr class=" rounded-2xl ">
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                {{ $heure->heures() }}</td>
                                            @foreach ($jours as $jour)
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($horaires as $horaire)
                                                    @if ($horaire->heure->id === $heure->id && $horaire->jour->id === $jour->id)
                                                        @php
                                                            $i = 1;
                                                        @endphp
                                                        <td
                                                            class="p-1 uppercase text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                            @if ($horaire->isRecreation === 1)
                                                                RECREATION
                                                            @else
                                                                {{ $horaire->cours->nom }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endforeach
                                                @if (isset($i) && $i === 0)
                                                    <td
                                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">

                                                    </td>
                                                @endif
                                                {{-- @endforeach --}}
                                            @endforeach
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                @endsection
