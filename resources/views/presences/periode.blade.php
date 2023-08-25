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
    <div class=" container flex flex-col justify-between gap-5 w-full">
        @if (isset($isPeriode))
            @if (Auth::user()->isParent())
            <x-classe-profile-header-presence :debut="$debut" :fin="$fin" :data="$classe"
            :passation="true" />
            @else
            <x-classe-profile-header-presence :print="true" :debut="$debut" :fin="$fin" :data="$classe"
            :passation="true" />
            @endif
        @else
            <x-classe-profile-header-presence :print="true" :today="$debut" :data="$classe" :passation="true" />
        @endif
        @if (isset($annee) && $annee !== null)
            <div id="display-reussite"
                class="display-passation shadow-2xl container p-4 bg-white rounded-5 flex justify-center items-center w-full overflow-scroll">
                <div id="printable" class="flex flex-col px-0 pt-0 w-full">
                    <table class="items-center w-full mb-0 align-top border-gray-700 text-slate-500 border-collapse">
                        <caption
                            class="font-bold p-2 text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-base border-solid tracking-none whitespace-nowrap text-slate-500">
                            LISTE DE PRESENCE DU {{ date_format(date_create($debut), 'd/m/Y') }} AU
                            {{ date_format(date_create($fin), 'd/m/Y') }}
                        </caption>
                        <thead class="align-bottom">
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap ">
                                N°
                            </th>
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap ">
                                ELEVE
                            </th>
                            @foreach ($days as $d)
                                @php
                                    $today = date_format(date_create($d), 'd/m');
                                @endphp
                                @if (date_format(date_create($d), 'w') === '0')
                                    <th
                                        class="p-1 font-bold text-center uppercase align-middle text-white bg-slate-850 border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap ">
                                        D {{ $today }}
                                    </th>
                                @else
                                    <th
                                        class="p-1 font-bold text-center uppercase align-middle border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap ">
                                        @switch(date_format(date_create($d), 'w'))
                                            @case(1)
                                                L {{ $today }}
                                            @break

                                            @case(2)
                                                M {{ $today }}
                                            @break

                                            @case(3)
                                                M {{ $today }}
                                            @break

                                            @case(4)
                                                J {{ $today }}
                                            @break

                                            @case(5)
                                                V {{ $today }}
                                            @break

                                            @case(6)
                                                S {{ $today }}
                                            @break
                                        @endswitch
                                    </th>
                                @endif
                            @endforeach
                        </thead>
                        <tbody>

                            @foreach ($eleves as $index => $eleve)
                                @if (Auth::user()->isParent())
                                    @if ($eleve->parrain && $eleve->parrain->id === Auth::user()->parrain->id)
                                        <tr id="tr{{ $eleve->id }}" class="duration-200 rounded-2xl  cursor-pointer">
                                            <td
                                                class="p-1 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap   ">
                                                {{ $index + 1 }}
                                            </td>
                                            <td
                                                class="p-1 after:font-bold text-center uppercase align-middle bg-transparent border shadow-none text-xs border-solid tracking-none whitespace-nowrap   ">
                                                <a href="{{ route('eleves.show', $eleve->id) }}">
                                                    {{ $eleve->nomComplet() }}
                                                </a>
                                            </td>

                                            @foreach ($days as $d)
                                                @if ($eleve->presence($d))
                                                    @if (date_format(date_create($d), 'w') === '0')
                                                        <td
                                                            class="p-1 font-bold text-center uppercase align-middle bg-slate-850 border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap ">
                                                            {{ $eleve->presence($d)->type_presence->abbreviation }}
                                                        </td>
                                                    @else
                                                        <td
                                                            class="p-1 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap ">
                                                            {{ $eleve->presence($d)->type_presence->abbreviation }}
                                                        </td>
                                                    @endif
                                                @else
                                                    @if (date_format(date_create($d), 'w') === '0')
                                                        <td
                                                            class="p-1 font-bold text-center uppercase align-middle bg-slate-850  border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap  ">

                                                        </td>
                                                    @else
                                                        <td
                                                            class="p-1 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap  ">
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach
                                            {{-- <span id="err{{ $eleve->id }}" class="text-red-500 text-3"></span> --}}
                                        </tr>
                                    @endif
                                @else
                                    <tr id="tr{{ $eleve->id }}" class="duration-200 rounded-2xl  cursor-pointer">
                                        <td
                                            class="p-1 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap   ">
                                            {{ $index + 1 }}
                                        </td>
                                        <td
                                            class="p-1 after:font-bold text-center uppercase align-middle bg-transparent border shadow-none text-xs border-solid tracking-none whitespace-nowrap   ">
                                            <a href="{{ route('eleves.show', $eleve->id) }}">
                                                {{ $eleve->nomComplet() }}
                                            </a>
                                        </td>

                                        @foreach ($days as $d)
                                            @if ($eleve->presence($d))
                                                @if (date_format(date_create($d), 'w') === '0')
                                                    <td
                                                        class="p-1 font-bold text-center uppercase align-middle bg-slate-850 border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap ">
                                                        {{ $eleve->presence($d)->type_presence->abbreviation }}
                                                    </td>
                                                @else
                                                    <td
                                                        class="p-1 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap ">
                                                        {{ $eleve->presence($d)->type_presence->abbreviation }}
                                                    </td>
                                                @endif
                                            @else
                                                @if (date_format(date_create($d), 'w') === '0')
                                                    <td
                                                        class="p-1 font-bold text-center uppercase align-middle bg-slate-850  border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap  ">

                                                    </td>
                                                @else
                                                    <td
                                                        class="p-1 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xs border-solid tracking-none whitespace-nowrap  ">
                                                    </td>
                                                @endif
                                            @endif
                                        @endforeach
                                        {{-- <span id="err{{ $eleve->id }}" class="text-red-500 text-3"></span> --}}
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class=" flex justify-center shadow-2xl container p-6 bg-white rounded-5">
                <span class="text-red-500 font-bold text-center text-5"> Passation de Classe Indisponible </span>
            </div>
        @endif

    </div>
@endsection
