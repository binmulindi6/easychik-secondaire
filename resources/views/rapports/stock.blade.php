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

    <div class=" container flex flex-col justify-between gap-5">
        <x-nav-rapports :isStock="true" :pagename="$page_name"></x-nav-rapports>

        <div
            class="frm-identity flex flex-col justify-center items-center  gap-5 shadow-2xl relative bg-white rounded-5 p-5 w-full  z-20">

            <div class="flex flex-col sm:flex-row justify-center w-full">
                <form action="{{ route('rapports.stock.store') }}" method="POST" class="flex flex-col sm:flex-row items-center gap-2">
                    @csrf
                    @if (isset($debut))
                        <div class="flex flex-row gap-2 justify-center items-center">
                            <x-label>Du:</x-label>
                            <x-input type="date" name="date_debut" id="" max="{{ $today }}"
                                value="{{ $debut }}"></x-input>
                        </div>
                        <div class="flex flex-row gap-2 justify-center items-center">
                            <x-label>Au:</x-label>
                            <x-input type="date" name="date_fin" max="{{ $today }}" id=""
                                value="{{ $fin }}"></x-input>
                        </div>
                    @else 
                        <div class="flex flex-row gap-2 justify-center items-center">
                            <x-label>Du:</x-label>
                            <x-input type="date" name="date_debut" max="{{ $today }}" id=""></x-input>
                        </div>
                        <div class="flex flex-row gap-2 justify-center items-center">
                            <x-label>Au:</x-label>
                            <x-input :submitOnChange="true" type="date" name="date_fin" max="{{ $today }}" value="{{ $today }}"
                                id=""></x-input>
                        </div>
                    @endif
                    <x-button>choisir</x-button>
                </form>
            </div>


            <div id="printable" class=" w-full lg:w-10/12 relative overflow-x-auto shadow-md sm:rounded-lg ">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    @if (isset($debut))
                        <caption id="header"
                            class="text-xs py-2 text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                            <span class="font-semibold text-4 uppercase">
                                Rapport Etat de Stock du {{ $debut }} au {{ $fin }}
                            </span>

                        </caption>
                    @endif
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="border-b">
                            <th class="px-6 py-3 text-center">
                                Num Serie
                            </th>
                            <th class="px-6 py-3 text-center">
                                Nom
                            </th>
                            <th class="px-6 py-3 text-center">
                                Categorie
                            </th>
                            <th class="px-6 py-3 text-center">
                                Entrées
                            </th>
                            <th class="px-6 py-3 text-center">
                                Sorties
                            </th>
                            <th class="px-6 py-3 text-center">
                                Stock
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($data) > 0)
                            @foreach ($data as $frais)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 border-b text-center">{{ $frais['num_serie'] }}</td>
                                    <td class="px-6 border-b text-center font-semibold text-slate-900">{{ $frais['nom'] }}
                                    </td>
                                    <td class="px-6 border-b text-center font-semibold text-slate-900">
                                        {{ $frais['categorie'] }}</td>

                                    <td class="px-6 border-b text-center font-semibold text-slate-900">
                                        {{ $frais['entrees'] . " " . $frais['unite'] }}</td>

                                    <td class="px-6 border-b text-center font-semibold text-slate-900">
                                        {{ $frais['sorties'] . " " . $frais['unite'] }}</td>
                                    <td class="px-6 border-b text-center font-semibold text-slate-900">
                                        {{ ($frais['entrees'] - $frais['sorties']) . " " . $frais['unite']}}</td>
                                </tr>
                                {{-- <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                </tr> --}}
                            @endforeach
                        @else
                            <tr>
                                <th colspan="4" class="px-6 py-3 text-center text-red-500">
                                    Aucun Paiement Enregisté
                                </th>
                            </tr>
                        @endif
                    </tbody>
                </table>

                {{-- <table class="border">
                        <thead >
                            <tr class="border">
                                <th class="px-6 py-3">
                                    Periode
                                </th>
                                <th class="px-6 py-3">
                                    Frais
                                </th>
                                <th class="px-6 py-3">
                                    Montant payé
                                </th>
                                <th class="px-6 py-3">
                                    mode paiement
                                </th>
                                <th class="px-6 py-3">
                                   total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border" rowspan="4">DATE</td>
                                <td class="border" rowspan="4">frais</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td rowspan="4" class="border">ee</td>
                            </tr>
                            <tr>
                                <td class="border">ee</td>
                                <td class="border">dd</td>
                            </tr>
                            <tr>
                                <td class="border">ee</td>
                                <td class="border">dd</td>
                            </tr>
                        </tbody>
                    </table> --}}
            </div>
        </div>

    </div>
@endsection
