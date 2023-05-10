@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">
        @if (isset($search))
            @if (isset($joker))
                <x-nav-eleves :search="$search" :pagename="$page_name" :joker="$joker"></x-nav-eleves>
            @else
                <x-nav-eleves :search="$search" :pagename="$page_name" ></x-nav-eleves>
            @endif
        @else
             @if (isset($joker))
                <x-nav-eleves :pagename="$page_name" :joker="$joker"></x-nav-eleves>
            @else
                <x-nav-eleves :pagename="$page_name" ></x-nav-eleves>
            @endif
        @endif

        @if (isset($error) && $error !== null)
            <div class=" flex text-center justify-center items-center p-2 bg-white rounded-2xl">
                <span class="text-red-500 font-semibold ">L'eleve Choisis : <span class="text-black">{{$error}}</span> ne frequente aucunne pour l'annee scolaire en cours veuillez l'ajouter dans une classe puis reesaayer</span>
            </div>
        @endif

    @if (isset($items))
        @if ($page_name == 'Eleves/Edit' || $page_name == 'Eleves/Create')
            <div
                class="display container p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
            @else
                <div
                    class="display container  p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
        @endif

        <div class=" flex justify-between pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Choisir Un Eleve</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Matricule </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Nom, Prenom </th>
                        <th
                            class="px-1 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Sexe </th>
                        {{-- <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Lieu, Date de Naissance </th> --}}
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Classe </th>
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            <tr class=" rounded-2xl hover:bg-slate-100">
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        <a href="{{ route('paiements.linkEleve', $item->id) }}">
                                            {{ $item->matricule }}
                                        </a>
                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    <a href="{{ route('paiements.linkEleve', $item->id) }}">
                                    {{ $item->nom . ' ' . $item->prenom }}</td>
                                    </a>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->sexe }}</td>
                                {{-- <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->lieu_naissance . ', ' . $item->date_naissance }}</td> --}}
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    @if ($item->classe(false) === null)
                                        <a class="text-blue-500 underline"
                                            href="{{ route('frequentations.link', $item->id) }}"> Ajouter dans une classe
                                        </a>
                                    @else
                                        {{ $item->classe(false) }}
                                    @endif
                                </td>
                        </tr>
    @endforeach

    </tbody>
    </table>
    </div>
    </div>
    </div>
    @endif
    </div>
    </div>

@endsection
