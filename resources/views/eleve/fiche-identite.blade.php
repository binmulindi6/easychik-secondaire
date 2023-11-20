@extends('layouts.admin')

@section('content')
    <div class=" flex flex-col gap-5 md:p-5">
        <x-back :link="route('eleves.show', $item->id)"></x-back>
        <x-eleve-profile-header :data="$item" :print="true"> </x-eleve-profile-header>

        <div class="containe bg-white rounded-2xl w-full p-5 shadow-xs">
            <div id="printable" class="flex flex-col items-center w-full p-5">
                <div class="flex items-center justify-center">
                    <span class="uppercase font-semibold text center text-5">
                        FICHE D'IDENTITE DE L'ELEVE
                    </span>
                </div>
                <div class="flex flex-row items-center w-full py-5">
                    <div class="flex justify-center items-center w-4/12">
                        @if ($item->avatar)
                            <div class="border border-zinc-700 p-2 h-40 w-40 flex justify-center items-center bg-center bg-contain"
                                style=" background-image : url('{{ asset('storage/flag.png') }}')';" alt="flag"> </div>
                        @else
                            <div class="border border-zinc-700 p-2 h-40 w-40 flex justify-center items-center">
                                <span class="font-semibold">Photo</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex justify-center items-center w-8/12">
                        <table class="w-full border border-zinc-700 border-collapse  p-1">
                            <tr>
                                <td class="border border-zinc-700 uppercase w-4/12 font-semibold p-1">Matricule</td>
                                <td class="border border-zinc-700 uppercase w-8/12 p-1"> : {{ $item->matricule }}</td>
                            </tr>
                            <tr>
                                <td class="border border-zinc-700 uppercase font-semibold p-1">Num Permanent</td>
                                <td class="border border-zinc-700 uppercase p-1"> : {{ $item->num_permanent }}</td>
                            </tr>
                            <tr>
                                <td class="border border-zinc-700 uppercase font-semibold p-1">Nom & Postnom</td>
                                <td class="border border-zinc-700 uppercase p-1"> : {{ $item->nom }}</td>
                            </tr>
                            <tr>
                                <td class="border border-zinc-700 uppercase font-semibold p-1">Prénom</td>
                                <td class="border border-zinc-700 uppercase p-1"> : {{ $item->prenom }}</td>
                            </tr>
                            <tr>
                                <td class="border border-zinc-700 uppercase font-semibold p-1">sexe</td>
                                <td class="border border-zinc-700 uppercase p-1"> : {{ $item->sexe }}</td>
                            </tr>
                            <tr>
                                <td class="border border-zinc-700 uppercase font-semibold p-1">Lieu de Naissance</td>
                                <td class="border border-zinc-700 uppercase p-1"> : {{ $item->lieu_naissance }}</td>
                            </tr>
                            <tr>
                                <td class="border border-zinc-700 uppercase font-semibold p-1">Date de Naissance</td>
                                <td class="border border-zinc-700 uppercase p-1"> : le
                                    {{ date_format(date_create($item->date_naissance), 'd/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td class="border border-zinc-700 uppercase font-semibold p-1">Nationalité</td>
                                <td class="border border-zinc-700 uppercase p-1"> : {{ $item->nationalite }}</td>
                            </tr>
                            <tr>
                                <td class="border border-zinc-700 uppercase font-semibold p-1">Adresse du domicile</td>
                                <td class="border border-zinc-700 uppercase p-1"> : {{ $item->adresse }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <table class="w-full border border-zinc-700 border-collapse  uppercase py-5">
                    <thead>
                        <td colspan="4" class="text-center border border-zinc-700 uppercase font-semibold p-1">INFORMATIONS SUR LES
                            PARANTS DE L'ELEVE</td>
                    </thead>
                    <tr>
                        <td class="border border-zinc-700 uppercase font-semibold p-1">Nom & Prenom</td>
                        <td class="border border-zinc-700 uppercase font-semibold p-1">PROFESSION</td>
                        <td class="border border-zinc-700 uppercase font-semibold p-1">CONTACT</td>
                        <td class="border border-zinc-700 uppercase font-semibold p-1">Statut</td>
                    </tr>
                    <tr>
                        <td class="border border-zinc-700 uppercase p-1">{{ $item->nom_pere }}</td>
                        <td class="border border-zinc-700 uppercase p-1">{{ $item->profession_pere }}</td>
                        <td class="border border-zinc-700 uppercase p-1">{{ $item->telephone_pere }}</td>
                        <td class="border border-zinc-700 uppercase p-1">{{ 'PERE' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-zinc-700 uppercase p-1">{{ $item->nom_mere }}</td>
                        <td class="border border-zinc-700 uppercase p-1">{{ $item->profession_mere }}</td>
                        <td class="border border-zinc-700 uppercase p-1">{{ $item->telephone_mere }}</td>
                        <td class="border border-zinc-700 uppercase p-1">{{ 'MERE' }}</td>
                    </tr>
                </table>
                <table class="w-full border border-zinc-700 border-collapse  uppercase my-5">
                    <thead>
                        <td colspan="4" class="text-center border border-zinc-700 uppercase font-semibold p-1">HISTORIQUE DES
                            FREQUENTATIONS DE L'ELEVE</td>
                    </thead>
                    <tr>
                        <td class="border border-zinc-700 uppercase font-semibold p-1">ANNEES SCOLAIRES</td>
                        <td class="border border-zinc-700 uppercase font-semibold p-1">CLASSE</td>
                        <td class="border border-zinc-700 uppercase font-semibold p-1">POURCENTAGE</td>
                        <td class="border border-zinc-700 uppercase font-semibold p-1">DECISION</td>
                    </tr>
                    @foreach ($item->frequentations as $freq)
                        <tr>
                            <td class="border border-zinc-700 uppercase p-1">{{ $freq->annee_scolaire->nom }}</td>
                            <td class="border border-zinc-700 uppercase p-1">{{ $freq->classe->nomComplet() }}</td>
                            <td class="border border-zinc-700 uppercase p-1">{{ $freq->resultat->annee }}% </td>
                            <td class="border border-zinc-700 uppercase p-1">{{ $freq->resultat->decision }}</td>
                            {{-- <td class="border border-zinc-700 uppercase p-1">{{'PERE'}}</td> --}}
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>

    </div>
@endsection
