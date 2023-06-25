@extends('layouts.admin')
@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        @if (isset($search))
            <x-nav-eleves :search="$search" :pagename="$page_name"></x-nav-eleves>
        @else
            <x-nav-eleves :pagename="$page_name"></x-nav-eleves>
        @endif

        <x-eleve-profile-header :data="$item"> </x-eleve-profile-header>



        <div
            class="frm-identity flex flex-col justify-center items-center  gap-4 shadow-2xl relative bg-white rounded-5 p-5 w-full  z-20">

            <div class="flex flex-row justify-center w-full">
                <form action="{{ route('eleves.paiements.create', $item->id) }}" method="post">
                    @csrf
                    <div class="w-60 h-10 flex flex-row justify-end items-center gap-2">
                        <x-select :val="$freq" :collection="$annees" class="block mt-1 w-full" name='frequentation' required>
                        </x-select>
                        <x-button>choisir</x-button>
                    </div>
                </form>
            </div>


            <div class=" w-full lg:w-3/4 relative overflow-x-auto shadow-md sm:rounded-lg ">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Date
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

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($paiements) > 0)
                            @foreach ($paiements as $paie)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6">
                                        {{ $paie->date }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 pb-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $paie->frais->nom }}
                                    </th>
                                    <td class="px-6">
                                        {{ $paie->montant_paye . ' ' . $paie->frais->type_frais->devise }}
                                    </td>
                                    <td class="px-6">
                                        {{ $paie->moyen_paiement->nom }}
                                    </td>
                                </tr>
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
            </div>

            <div class="flex flex-col md:flex-row justify-center gap-4 w-full md:w-3/4">
                @foreach ($data as $frr)
                    <div class="flex flex-col gap-2 items-center w-full md:w-2/6">
                        <span class="font-semibold uppercase">{{ $frr['frais']->nom }}</span>
                        <table class="">
                            <thead>
                                <tr>
                                    <th class="text-left border-b">Montant Payé :</th>
                                    <th class="text-right border-b">
                                        {{ $frr['total'] . ' ' . $frr['frais']->type_frais->devise }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left">Montant dû :</td>
                                    <td class="text-right">
                                        {{ $frr['frais']->montant . ' ' . $frr['frais']->type_frais->devise }}</td>
                                </tr>
                                @if ($frr['total'] < $frr['frais']->montant)
                                    <tr class="text-red-500">
                                        <td class="text-left">Solde :</td>
                                        <td class="text-right">
                                            {{ $frr['total'] - $frr['frais']->montant . ' ' . $frr['frais']->type_frais->devise }}
                                        </td>
                                    </tr>
                                @else
                                    <tr class="text-green-500">
                                        <td class="text-left">Solde :</td>
                                        <td class="text-right">
                                            {{ $frr['total'] - $frr['frais']->montant . '' . $frr['frais']->type_frais->devise }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
