@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">
        <x-back :link="route('classes.show', $classe->id)"></x-back>
        <x-classe-profile-header :data="$classe" :print="true"></x-classe-profile-header>

        @if (isset($items))
            @if ($page_name == 'Eleves/Edit' || $page_name == 'Eleves/Create')
                <div
                    class="display container p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                @else
                    <div
                        class="display container  p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
            @endif

            {{-- <div class=" flex justify-between pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Eleves</h6>
        </div> --}}
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="pt-5 overflow-x-auto">
                    <table id="printable" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <caption
                            class="font-bold text-center uppercase align-middle bg-transparent shadow-none text-xl border-b-solid tracking-none whitespace-nowrap ">
                            liste des eleves
                        </caption>
                        <caption
                            class="font-bold pb-4 text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap ">
                            classe de {{ $classe->nomComplet() }}
                        </caption>
                        <thead class="align-bottom">
                            <th
                                class="px-4 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                N° </th>
                            <th
                                class="px-4 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Matricule </th>
                            <th
                                class="px-4 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Num Permanent </th>
                            <th
                                class="px-4 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Nom, Prenom </th>
                            <th
                                class="px-1 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Sexe </th>
                            <th
                                class="px-4 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Lieu, Date de Naissance </th>
                            {{-- <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Nom du Pere </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Nom de la Mere </th> --}}
                            {{-- <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Adresse </th> --}}
                            {{-- <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Classe </th> --}}
                            {{-- @if (Auth::user()->isAdmin() || !Auth::user()->isEnseignant() || !Auth::user()->isParent() || !isset($parent) || $parent === null)
                            <th class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap "
                                colspan="2">action</th>
                        @endif --}}
                        </thead>
                        <tbody>

                            @foreach ($items as $index => $item)
                                <tr class=" rounded-2xl hover:bg-slate-100">
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                        {{ $index + 1 }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        @if (isset($parent) && $parent != null)
                                            <a class="hover:text-blue-600 hover:font-semibold"
                                                href="{{ route('parent-eleve.link', [$parent, $item->id]) }}">
                                                {{ $item->matricule }}
                                            </a>
                                        @else
                                            <a class="hover:text-blue-600 hover:font-semibold"
                                                href="{{ route('eleves.show', $item->id) }}">
                                                {{ $item->matricule }}
                                            </a>
                                        @endif
                                    </td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        @if (isset($parent) && $parent != null)
                                            <a class="hover:text-blue-600 hover:font-semibold"
                                                href="{{ route('parent-eleve.link', [$parent, $item->id]) }}">
                                                {{ $item->num_permanent }}
                                            </a>
                                        @else
                                            <a class="hover:text-blue-600 hover:font-semibold"
                                                href="{{ route('eleves.show', $item->id) }}">
                                                {{ $item->num_permanent }}
                                            </a>
                                    </td>
                            @endif
                            <td
                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                @if (isset($parent) && $parent != null)
                                    <a class="hover:text-blue-600 hover:font-semibold"
                                        href="{{ route('parent-eleve.link', [$parent, $item->id]) }}">
                                        {{ $item->nom . ' ' . $item->prenom }}
                                    </a>
                                @else
                                    <a class="hover:text-blue-600 hover:font-semibold"
                                        href="{{ route('eleves.show', $item->id) }}">
                                        {{ $item->nom . ' ' . $item->prenom }}

                                    </a>
                                @endif
                            </td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                        {{ $item->sexe }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                        {{ $item->lieu_naissance . ', ' . $item->date_naissance }}</td>
                                    {{-- <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->nom_pere }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->nom_mere }}</td> --}}
                                    {{-- <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->adresse }}</td> --}}
                                    {{-- <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    @if ($item->classe(false) === null)
                                        <a class="text-blue-500 underline"
                                            href="{{ route('frequentations.link', $item->id) }}"> Ajouter dans une classe
                                        </a>
                                    @else
                                        {{ $item->classe(false) }}
                                    @endif
                                </td> --}}
                                    {{-- @if (Auth::user()->isAdmin() || !Auth::user()->isEnseignant() || !Auth::user()->isParent() || !isset($parent) || $parent === null)
                            <td
                                class="p-1 text-size-sm hidden text-center align-middle bg-transparent border-b  shadow-transparent  text-blue-500 underline">
                                <div class="flex justify-center gap-4 align-middle">
                                    <a href="{{ route('eleves.edit', $item->id) }}" title="Modifier">
                                        <i class="fa fa-solid fa-pen"></i>
                                    </a>
                                    <form class="delete-form" class="delete-form"
                                        action="{{ route('eleves.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete-btn" type="submit" title="Effacer">
                                            <i class="text-red-500 fa fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif --}}
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
