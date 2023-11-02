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
        <x-classe-profile-header-presence :noHeader="true" :print="true" :today="$day" :data="$classe"
            :passation="true" />
        @if (isset($annee) && $annee !== null)
            <div id="display-reussite"
                class="display-passation shadow-2xl container p-4 bg-white rounded-5 flex justify-center items-center w-full">
                <div id="printable" class="flex flex-col px-0 pt-0 lg:w-8/12 md:w-10/12 w-full">
                    <table class="items-center w-full mb-0 align-top border-gray-700 text-slate-500">
                        <caption
                            class="font-bold pb-4 text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-base border-b-solid tracking-none whitespace-nowrap text-slate-500">
                            CLASSE DE  {{ $classe->nomComplet() }}
                        </caption>
                        <caption
                            class="font-bold pb-4 text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-base border-b-solid tracking-none whitespace-nowrap text-slate-500">
                            LISTE DE PRESENCE DU {{ date('d/m/Y') }}
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
                            @php
                                $today = date_format(date_create($day), 'd/m');
                            @endphp
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                le {{ $today }}
                            </th>
                        </thead>
                        <tbody>

                            @foreach ($eleves as $index => $eleve)
                                @if (count($eleves) - 1 === $index)
                                    <input id="last-id" type="hidden" value="{{ $eleve->id }}">
                                @endif
                                <tr id="tr{{ $eleve->id }}"
                                    class=" translate-x-2 duration-200 rounded-2xl hover:bg-slate-100 cursor-pointer">
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                        {{ $index + 1 }}
                                    </td>
                                    <td
                                        class="p-1 text-size-sm text-center uppercase align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                        <a href="{{ route('eleves.show', $eleve->id) }}">
                                            {{ $eleve->nomComplet() }}
                                        </a>
                                    </td>
                                    </td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                        @if ($eleve->presence($day))
                                            {{ $eleve->presence($day)->type_presence->abbreviation }}
                                        @else
                                            <form id="frm{{ $eleve->id }}" action="{{ route('presences.api.store') }}"
                                                method="POST" class="flex justify-center items-center gap-2">
                                                @csrf
                                                <input id="token{{ $eleve->id }}" type="hidden" name="token"
                                                    value="{{ csrf_token() }}">
                                                <input id="date{{ $eleve->id }}" type="hidden" name="date"
                                                    value="{{ $day }}">
                                                <input id="user{{ $eleve->id }}" type="hidden" name="eleve"
                                                    value="{{ Auth::user()->id }}">
                                                <input id="freq{{ $eleve->id }}" type="hidden" name="freq"
                                                    value="{{ $eleve->currentFrequentation()->id }}">
                                                @foreach ($types as $type)
                                                    @if ($type->abbreviation === 'P')
                                                        <input id="{{ $eleve->id }}" type="button"
                                                            placeholder="{{ $type->id }}"
                                                            value="{{ $type->abbreviation }}" title="{{ $type->nom }}"
                                                            class="btn-presence flex items-center justify-centerbtn-affecter px-2 h-8 w-8 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                                                    @else
                                                        @if ($type->abbreviation === 'A')
                                                            <input id="{{ $eleve->id }}" type="button"
                                                                placeholder="{{ $type->id }}"
                                                                value="{{ $type->abbreviation }}"
                                                                title="{{ $type->nom }}"
                                                                class="btn-presence flex items-center justify-centerbtn-affecter px-2 h-8 w-8 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                                                        @else
                                                            <input id="{{ $eleve->id }}" type="button"
                                                                placeholder="{{ $type->id }}"
                                                                value="{{ $type->abbreviation }}"
                                                                title="{{ $type->nom }}"
                                                                class="btn-presence flex items-center justify-centerbtn-affecter px-2 h-8 w-8 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                                                        @endif
                                                    @endif
                                                @endforeach

                                            </form>
                                        @endif
                                        <span id="err{{ $eleve->id }}" class="text-red-500 text-3"></span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class=" flex justify-center shadow-2xl container p-6 bg-white rounded-5">
                <span class="text-red-500 font-bold text-center text-5"> Listes de Presences Indisponibles </span>
            </div>
        @endif

    </div>
@endsection
