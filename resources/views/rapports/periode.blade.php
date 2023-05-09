@extends('layouts.admin')
@section('content')

    <div class=" container flex flex-col justify-between gap-5">
        <x-nav-rapports :pagename="$page_name"></x-nav-rapports>

        <div class="frm-identity flex flex-col justify-center items-center  gap-5 shadow-2xl relative bg-white rounded-5 p-5 w-full  z-20">
        
            <div class="flex flex-row justify-center w-full">
                <form action="{{route('rapports.periode.get')}}" method="POST" class="flex flex-row items-center gap-2">
                    @csrf
                    @if (isset($debut))
                    <x-label>Du:</x-label>
                    <x-input type="date" name="date_debut" id="" max="{{$today}}" value="{{$debut}}"></x-input>
                    <x-label>Au:</x-label>
                    <x-input type="date" name="date_fin" max="{{$today}}" id="" value="{{$fin}}"></x-input>
                    
                    @else
                    <x-label>Du:</x-label>
                    <x-input type="date" name="date_debut" max="{{$today}}" id=""></x-input>
                    <x-label>Au:</x-label>
                    <x-input type="date" name="date_fin" max="{{$today}}" value="{{$today}}" id=""></x-input>
                        
                    @endif
                    <x-button>choisir</x-button>
                </form>
            </div>

           
            <div id="printable" class=" w-full lg:w-10/12 relative overflow-x-auto shadow-md sm:rounded-lg ">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        @if (isset($debut))
                        <caption id="header" class="text-xs py-2 text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            
                                <span class="font-semibold text-8">
                                    Rapport de paiements des frais du {{$debut}} au {{$fin}}
                                </span>
                            
                        </caption>
                        @endif
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Periode
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Frais
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    mode paiement
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Montant payé
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($paiements) && count($paiements) > 0)
                            @foreach ($paiements as $frais)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 border-b" rowspan="4">DU: {{$debut ." AU ". $fin}}</td>
                                    <td class="px-6 border-b" rowspan="4">{{$frais['nom']}}</td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td></td>
                                    <td></td>
                                    <td class="px-6 border-b text-right font-semibold text-slate-900" rowspan="4">{{$frais['total'] . " " . $frais['devise']}}</td>
                                </tr>
                                @foreach ($frais['paiements'] as $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 border-b text-right">
                                            {{$item['nom']}}
                                        </td>
                                        <td class="px-6 border-b text-right">
                                            {{$item['montant'] . " " . $frais['devise']}}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
