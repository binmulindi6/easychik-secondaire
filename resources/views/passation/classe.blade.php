@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        <x-classe-profile-header :data="$classe" :passation="true" />
        <div class="display shadow-2xl container p-4 bg-white rounded-5">
            <div id="printable" class="flex flex-col px-0 pt-0 ">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    {{-- <caption class="text-center font-bold text-base uppercase"> Resultats
                        @if (isset($periode))
                            {{ $periode->nom . ' ' . $periode->trimestre->nom . ' ' . 'annee scolaire ' . $annee_scolaire->nom }}
                        @else
                            @if (isset($trimestre))
                                {{ $trimestre->nom . ' ' . 'annee scolaire ' . $annee_scolaire->nom }}
                            @else
                                {{ 'annee scolaire ' . $annee_scolaire->nom }}
                            @endif
                        @endif
                    </caption> --}}
                    <caption
                        class="font-bold pb-4 text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-base border-b-solid tracking-none whitespace-nowrap text-slate-500">
                        ELEVES AYANT REUSSIS
                    </caption>
                    <thead class="align-bottom">
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            N°
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            ELEVE
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Pourcentage
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Affecter en
                        </th>
                    </thead>
                    <tbody>

                        @foreach ($resultats['reussites'] as $index => $resultat)
                            <tr class=" rounded-2xl hover:bg-slate-100 cursor-pointer">
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                    {{ $index + 1 }}
                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                    <a href="{{ route('eleves.show', $resultat->id) }}">
                                        {{ $resultat->nomComplet() }}
                                    </a>
                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                    <span>{{ $resultat->resultat()->annee }} %</span>

                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    <form id="frm{{ $resultat->id }}"
                                        action="{{ route('eleves.examens.update.api', $resultat->id) }}" method="POST"
                                        class="flex justify-center items-center gap-2">
                                        @method('PUT')
                                        @csrf
                                        {{-- <x-input id="ev{{ $resultat->id }}" class="px-2 py-2 rounded w-20 text-center h-8"
                                            type="number" name="note_obtenu"
                                            value="{{ '33'}}" /> --}}
                                            <x-select :collection="$classeNiveauSup" class="block w-60" name='classe_id' required> </x-select>
                                        <input type="hidden" name="back" value="00">
                                        <input id="token{{ $resultat->id }}" type="hidden" name="token"
                                            value="{{ csrf_token() }}">
                                        <x-button id="{{ $resultat->id }}" type="submit"
                                            class="btn-corriger px-2 h-7 hover:opacity-100"> ✅</x-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="display shadow-2xl container p-4 bg-white rounded-5">
            <div id="printable" class="flex flex-col px-0 pt-0 ">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    {{-- <caption class="text-center font-bold text-base uppercase"> Resultats
                        @if (isset($periode))
                            {{ $periode->nom . ' ' . $periode->trimestre->nom . ' ' . 'annee scolaire ' . $annee_scolaire->nom }}
                        @else
                            @if (isset($trimestre))
                                {{ $trimestre->nom . ' ' . 'annee scolaire ' . $annee_scolaire->nom }}
                            @else
                                {{ 'annee scolaire ' . $annee_scolaire->nom }}
                            @endif
                        @endif
                    </caption> --}}
                    <caption
                        class="font-bold pb-4 text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-base border-b-solid tracking-none whitespace-nowrap text-slate-500">
                        ELEVES AYANT ECHOUÉS
                    </caption>
                    <thead class="align-bottom">
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            N°
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            ELEVE
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Pourcentage
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Affecter En
                        </th>
                    </thead>
                    <tbody>

                        @foreach ($resultats['echecs'] as $index => $resultat)
                            <tr class=" rounded-2xl hover:bg-slate-100 cursor-pointer">
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                    {{ $index + 1 }}
                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                    <a href="{{ route('eleves.show', $resultat->id) }}">
                                        {{ $resultat->nomComplet() }}
                                    </a>
                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                    <span>{{ $resultat->resultat()->annee }} %</span>

                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    <form id="frm{{ $resultat->id }}"
                                        action="{{ route('frequentations.api.store') }}" method="POST"
                                        class="flex justify-center items-center gap-2">
                                        {{-- @method('PUT') --}}
                                        @csrf
                                        <x-select id="classe{{$resultat->id}}" :collection="$classeMemeNiveau" class="block w-60" name='classe_id' required> </x-select>
                                        <input id="token{{ $resultat->id }}" type="hidden" name="token"
                                            value="{{ csrf_token() }}">
                                        <input id="eleve{{ $resultat->id }}" type="hidden" name="token"
                                            value="{{$resultat->id}}">
                                        <input id="annee{{ $resultat->id }}" type="hidden" name="token"
                                            value="{{$annee->id}}">
                                        <x-button id="{{ $resultat->id }}" type="submit"
                                            class="btn-corriger px-2 h-7 hover:opacity-100"> ✅</x-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="display shadow-2xl container p-4 bg-white rounded-5">
            <div id="printable" class="flex flex-col px-0 pt-0 ">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    {{-- <caption class="text-center font-bold text-base uppercase"> Resultats
                        @if (isset($periode))
                            {{ $periode->nom . ' ' . $periode->trimestre->nom . ' ' . 'annee scolaire ' . $annee_scolaire->nom }}
                        @else
                            @if (isset($trimestre))
                                {{ $trimestre->nom . ' ' . 'annee scolaire ' . $annee_scolaire->nom }}
                            @else
                                {{ 'annee scolaire ' . $annee_scolaire->nom }}
                            @endif
                        @endif
                    </caption> --}}
                    <caption
                        class="font-bold pb-4 text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-base border-b-solid tracking-none whitespace-nowrap text-slate-500">
                        ELEVES NON CLASSÉS
                    </caption>
                    <thead class="align-bottom">
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            N°
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            ELEVE
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Pourcentage
                        </th>

                    </thead>
                    <tbody>

                        @foreach ($resultats['non_classe'] as $index => $resultat)
                            <tr class=" rounded-2xl hover:bg-slate-100 cursor-pointer">
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                    {{ $index + 1 }}
                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                    <a href="{{ route('eleves.show', $resultat->id) }}">
                                        {{ $resultat->nomComplet() }}
                                    </a>
                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                    <span>{{ $resultat->resultat()->annee }} %</span>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
