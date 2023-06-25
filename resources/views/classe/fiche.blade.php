@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">
        <x-back :link="route('classes.show', $classe->id)"></x-back>
        <x-classe-profile-header :data="$classe" :print="false"></x-classe-profile-header>

        @if (isset($items))
            @if ($page_name == 'Eleves/Edit' || $page_name == 'Eleves/Create')
                <div
                    class="display container p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                @else
                    <div
                        class="display container  p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
            @endif

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="pt-5 overflow-x-auto">
                    <table id="printable" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <th
                                class="px-4 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Frais </th>
                            <th
                                class="px-4 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                On Soldé </th>
                            <th
                                class="px-1 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                n'On pas encore Soldé </th>
                            {{-- <th
                                class="px-4 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Total </th> --}}
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

                            @foreach ($items as $item)
                                <tr class=" rounded-2xl ">
                                    <td
                                        class="p-1 text-size-sm text-center uppercase align-middle bg-transparent border-b  shadow-transparent">
                                        {{ $item['frais']->nom }}
                                    </td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent text-green-500 hover:bg-slate-100">
                                        <a href="{{ route('classes.paiements.frais.solde', [$classe->id,$item['frais']->id]) }}"
                                            class="hover:text-blue-500 hover:underline font-semibold w-full h-full">
                                            {{ count($item['solde']) . '/' . count($classe->eleves()) }}
                                        </a>
                                    </td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent text-red-500 hover:bg-slate-100">
                                        <a href="{{ route('classes.paiements.frais.non_solde', [$classe->id,$item['frais']->id]) }}"
                                            class="hover:text-blue-500 hover:underline font-semibold w-full h-full">
                                            {{ count($item['non-solde']) . '/' . count($classe->eleves()) }}
                                        </a>
                                    </td>

                                    {{-- <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                        {{ $item['frais']->montant .' '. $item['frais']->type_frais->devise }}</td> --}}
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
