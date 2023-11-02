@extends('layouts.admin')
@section('content')
    <div class=" container flex flex-col justify-between gap-5">

        <x-nav-rapports :pagename="$page_name"></x-nav-rapports>

        <div
            class="frm-identity flex flex-col justify-center items-center  gap-5 shadow-2xl relative bg-white rounded-5 p-5 w-full  z-20">

            {{-- <div class="flex flex-row justify-center w-full">
                <form action="{{ route('rapports.annuel.get') }}" method="post" class="flex items-center gap-2">
                    @csrf
                    <x-label class="">Annee Scolaire :</x-label>
                    <div class="w-40 h-10 flex flex-row justify-end items-center gap-2 text-center">
                        <x-select :val="$current" :submitOnChange="true" :collection="$annees" class="block mt-1 w-full"
                            name='annee' required></x-select>
                        {{-- <x-button>choisir</x-button> --}}
                    {{--</div>
                </form>
            </div> --}}


            <div id="printable" class=" w-full lg:w-10/12 relative overflow-x-auto shadow-md sm:rounded-lg ">
                <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
                    <caption id="header"
                        class="text-xs py-2 text-gray-900 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                        <span class="font-semibold text-4">
                            Rapport annuel des Frequentations Annnee scolaire {{ $current->nom }}
                        </span>

                    </caption>
                    <thead class="text-xs text-gray-900 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Classes
                            </th>
                            {{-- <th scope="col" class="px-6 py-3">
                                Frais
                            </th> --}}
                            <th scope="col" class="px-6 py-3">
                                Eleves
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nombres
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($items) && count($items) > 0)
                            @foreach ($items as $freq)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    {{-- <td class="px-6 border-b" rowspan="4">{{ $current->nom }}</td> --}}
                                    <td class="px-6 border-b" rowspan="4">{{ $freq['classe']->nomComplet() }}</td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td></td>
                                    <td></td>
                                    <td class="px-6 border-b text-center font-semibold text-slate-900" rowspan="4">
                                        {{count($freq['filles']) + count($freq['garcons']) }}</td>
                                </tr>
                                {{-- @foreach ($frais['paiements'] as $item) --}}
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 border-b text-right">
                                            {{ 'Filles' }}
                                        </td>
                                        <td class="px-6 border-b text-right">
                                            {{ count($freq['filles']) }}
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 border-b text-right">
                                            {{ 'Garcons' }}
                                        </td>
                                        <td class="px-6 border-b text-right">
                                            {{ count($freq['garcons']) }}
                                        </td>
                                    </tr>
                                {{-- @endforeach --}}
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                </tr>
                            @endforeach
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                {{-- <td class="px-6 border-b" rowspan="4">{{ $current->nom }}</td> --}}
                                <td class="px-6 border-b  text-gray-700 text-5 font-semibold uppercase text-center" rowspan="4">Total</td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td></td>
                                <td></td>
                                <td class="px-6 border-b text-center font-semibold text-slate-900" rowspan="4">
                                    {{$total}}</td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 border-b text-right text-gray-700">
                                    Filles
                                </td>
                                <td class="px-6 border-b text-right  text-gray-700">
                                    {{ $filles }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 border-b text-right text-gray-700">
                                    {{ 'Garcons' }}
                                </td>
                                <td class="px-6 border-b text-right text-gray-700">
                                    {{ $garcons }}
                                </td>
                            </tr>
                            
                        @else
                            <tr>
                                <th colspan="4" class="px-6 py-3 text-center text-red-500">
                                    Aucune Frequetation Enregisté
                                </th>
                            </tr>
                        @endif
                    </tbody>
                </table>

                {{-- <table class="border">
                        <thead >
                            <tr class="border">
                                <th scope="col" class="px-6 py-3">
                                    Periode
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Frais
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Montant payé
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    mode paiement
                                </th>
                                <th scope="col" class="px-6 py-3">
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
