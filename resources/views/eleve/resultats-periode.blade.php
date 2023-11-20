@extends('layouts.admin')

@section('content')
<style>
    body{
        /* display: none; */
    }
    /* @page{
        size: a4 portrait;
        /* margin: 500px;
        /* display: none; */
        /* background: #000; */ 
    /*} */

    @media print{
        /* @page{
            size: a4 portrait;
            margin: 1%; 
        } */
        #printable{
            /* min-width: 23cm; */
            margin: none;
            transform: scale(0.90);
            position: fixed;
            top: 0;
            /* transform-origin: auto 0; */
            /* padding: 10px; */
            /* display: none; */
            /* background: #000; */
        }

    }
    
</style>
<div id="print" class=" flex flex-col gap-5 md:p-5">
    
        <a href="{{ route('eleves.evaluations', [$eleve->id,$periode->id]) }}"
            class="p-2 bg-white rounded-full w-8 h-8 flex justify-center items-center">
            <i class="fa fa-solid fa-arrow-left"></i>
        </a>
        <x-eleve-profile-header :data="$eleve" :print="true" > </x-eleve-profile-header> 
   
    <div class="flex flex-col gap-2 bg-white rounded-xl shadow-xxs w-full p-5  items-center">
        <div class="w-full flex flex-row justify-between">
            <div id="bulletin"  class="container w-full flex justify-center"> 
                @if (!$bulletin == null)
                @if((!Auth::user()->isParent()) || (Auth::user()->isParent() && $resultat > 1))
                <table id="printable" border-collapse class=" w-full max-w-160 border border-collapse">
                        <thead>
                            <th colspan="3" class="border px-2 py-1 uppercase text-left text-xs" >
                                <span class="upercase w-full">ecole: {{$ecole->nom}}</span><br>
                                <span class="upercase w-full">ville: {{$ecole->ville}}</span> <br>
                                {{-- <span class="upercase w-full">Commune/Ter (1)</span> <br>
                                <span class="upercase w-full">code : </span><br> --}}
                            </th>
                        </thead>
                        <thead>
                            <th colspan="3" class="border py-1 px-2 uppercase text-left text-xs" >
                                <span class="upercase w-full">ELEVE : {{$eleve->nomComplet()}} </span><br>
                                <span class="upercase w-full">Matricule : {{$eleve->matricule}}</span><br>
                                <span class="upercase w-full">sexe: {{$eleve->sexe}}</span><br>
                                {{-- <span class="upercase w-full">NE (e) a : {{$eleve->lieu_naissance}} le: 
                                    @php
                                        $date = date_create($eleve->date_naissance);
                                        echo date_format($date, "d/m/Y");
                                        @endphp
                                </span> <br> --}}
                                <span class="upercase w-full">Classe : {{$eleve->classe()->niveau->nom . " " . $eleve->classe()->nom}}</span> <br>
                            </th>
                        </thead>
                        <thead class="">
                            <th colspan="3"class="uppercase font-bold text-xs py-2">BULLETIN {{ $periode->nom }}, {{ $periode->trimestre->nom }} Annee Scolaire {{ $periode->trimestre->annee_scolaire->nom }}</th>
                        </thead>
                        <thead class="border">
                            <th class="p-1 border font-bold text-left uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Cours </th>
                            <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Max Cours</th>
                            <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Note Obtenu</th>

                        </thead>
                        <tbody>
                                @foreach ($bulletin as $cours)
                                    @php
                                        if ($cours->max == $cours->total) {
                                            $note += $cours->note;
                                            $max += $cours->total;
                                        } else {
                                            
                                            $cours->note = round($cours->note * $cours->total / $cours->max, 2);
                                            $note += $cours->note;
                                            $max += $cours->total;
                                        }
                                        
                                    @endphp
                                    <tr>
                                        <td class="p-1 border font-bold text-left uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90"> {{$cours->nom }} </td>
                                        <td class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90"> {{ $cours->total }} </td>
                                        <td class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90"> {{$cours->note}} </td>
                                        
                                    </tr>
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                {{-- <thead>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > </th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total </th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total</th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Pourc</th>
                            </thead> --}}
                            <thead>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-900" >TOTAUX</th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-900" >{{$max}}</th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-900" >{{$note}} </th>
                                
                            <thead>
                                <th class="p-1 border font-bold text-left uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Pourcentage </th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-900 bg-slate-300" ></th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-900" >{{ round($note * 100 / $max, 1) }} %</th>
                                
                            </thead>
                            <thead>
                                <th class="p-1 border font-bold text-left uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Application </th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-900 bg-slate-300" ></th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-900" >
                                    @php
                                        $pourc = round($note * 100 / $max, 1);
                                    @endphp

                                    @if($pourc > 80)
                                        E
                                    @else
                                        @if ($pourc > 70 && $pourc < 81)
                                            TB
                                        @else
                                            @if ($pourc > 60 && $pourc < 81 )
                                                B
                                            @else
                                                @if ($pourc > 49 && $pourc < 61)
                                                    AB
                                                @else
                                                    M
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                    
                                </th>
                               
                            </thead>
                            <thead>
                                <th class="p-1 border font-bold text-left uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Conduite </th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-900 bg-slate-300" ></th>
                                <th class="p-1 border font-bold text-center align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-900" >
                                    @if ($conduite !== null)
                                        {{$conduite->conduite->abbreviation}}
                                    @else
                                        @if (!Auth::user()->isParent())
                                            <a href="{{route('conduites.link',[$eleve->id,$periode->id])}}" class="text-blue-500 underline">conduite indisponible</a>
                                        @else
                                            <span class="text-blue-500 ">conduite indisponible</span>
                                        @endif
                                    @endif
                                </th>

                            </thead>
                        </tfoot>
                    </table>


                        @if ($resultat !== $pourc && Auth::user()->isEnseignant())
                        <form action="{{route('resultat.periode.store', [$periode->id,$eleve->id])}}" method="post" class="ml-2 self-end">
                            @csrf
                            <input type="hidden" name="resultat" value={{$pourc}}>
                            <x-button title="Valider le bulletin" class=""> Valider ✅ </x-button>
                        </form>
                        @endif

                    @else
                        <p class="text-bold text-2xl text-red-500 text-center">
                        Buelletin Indisponible 
                        </p>
                    @endif
                @else
                    <p class="text-bold text-2xl text-red-500 text-center">
                       Buelletin Indisponible 
                    </p>
                @endif
            </div>

        </div>
        
    </div>
    </div>
    

    {{-- @if (!$bulletin == null)
        <button id="cmd" class="btn bg-blue-500 px-2 py-1 text-white rounded">Imprimer la Fiche</button>
    @endif --}}
    
@endsection

<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script-->

