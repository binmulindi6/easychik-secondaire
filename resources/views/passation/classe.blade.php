@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        <x-classe-profile-header :data="$classe" :print="true" />
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
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            N°
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            ELEVE
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Pourcentage
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Conduite
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
                                {{-- <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    <form id="frm{{ $item->id }}"
                                        action="{{ route('eleves.evaluations.update.api', $item->id) }}" method="POST"
                                        class="flex justify-center items-center gap-2">
                                        @method('PUT')
                                        @csrf
                                        <x-input id="ev{{ $item->id }}" class="px-2 py-2 rounded w-20 text-center h-8"
                                            type="number" max='{{ $evaluation->note_max }}' name="note_obtenu"
                                            value="{{ $item->note_obtenu }}" />
                                        <input type="hidden" name="back" value="00">
                                        <input id="token{{ $item->id }}" type="hidden" name="token"
                                            value="{{ csrf_token() }}">
                                        <x-button id="{{ $item->id }}" type="submit"
                                            class="btn-corriger px-2 h-7 hover:opacity-100"> ✅</x-button>
                                        {{-- <x-button type="submit" class="btn-corriger px-2 h-7 hover:opacity-100" onclick="postData({{$item->id}})"> ✅</x-button> --}}
                                    {{--</form>
                                    <span id="err{{ $item->id }}" class="text-red-500 text-3"></span>
                                </td> --}}
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
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            N°
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            ELEVE
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Pourcentage
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
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
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            N°
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            ELEVE
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Pourcentage
                        </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Conduite
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
