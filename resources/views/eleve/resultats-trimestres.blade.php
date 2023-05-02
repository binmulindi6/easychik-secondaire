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
            transform: scale(0.9);
            position: fixed;
            top: 0;
            /* transform-origin: auto 0; */
            /* padding: 10px; */
            /* display: none; */
            /* background: #000; */
        }

    }
    
</style>

    <div id='print' class=" flex flex-col gap-5 md:p-5">

        <a href="{{ route('eleves.examens', [$eleve->id,$trimestre->id]) }}"
            class="p-2 bg-white rounded-full w-8 h-8 flex justify-center items-center">
            <i class="fa fa-solid fa-arrow-left"></i>
        </a>
        <x-eleve-profile-header :data="$eleve" :print="true" > </x-eleve-profile-header> 


        <div class="flex flex-col gap-2 bg-white rounded-xl shadow-xxs w-full p-5  items-center">
            <div class="w-full flex flex-row justify-between">
                <div  class="container w-full flex justify-center"> 
                @if ($examen != null && $periode1 != null && $periode2 != null )
                @if((!Auth::user()->isParent()) || (Auth::user()->isParent() && ($resultat1 > 1 || $resultat2 > 1 || $resultatTrim > 1 || $resultatExam > 1)))

                    <table id="printable" border-collapse class=" w-full max-w-160 border border-collapse">
                        <thead>
                            <th colspan="8" class="border px-2 py-1 uppercase text-left text-xs" >
                                <span class="upercase w-full">ecole: {{env('ECOLE')}}</span><br>
                                <span class="upercase w-full">ville: {{env('VILLE')}}</span> <br>
                                {{-- <span class="upercase w-full">Commune/Ter (1)</span> <br>
                                <span class="upercase w-full">code : </span><br> --}}
                            </th>
                        </thead>
                        <thead>
                            <th colspan="8" class="border py-1 px-2 uppercase text-left text-xs" >
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
                            <th colspan="8"class="uppercase font-bold text-xs py-2">BULLETIN {{ $trimestre->nom }}, Annee Scolaire {{ $trimestre->annee_scolaire->nom }}</th>
                        </thead>
                        {{-- <caption class="uppercase font-bold text-xs pb-2">BULLETIN  {{ $trimestre->nom }}, Annee Scolaire {{ $trimestre->annee_scolaire->nom }}</caption> --}}
                        <thead>
                            <th class="p-1 border font-bold text-left uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Cours </th>
                            <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Max Periode</th>
                            <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Periode 1</th>
                            <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Periode 2</th>
                            <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Max Examen</th>
                            <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Examen</th>
                            <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Max Tri</th>
                            <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Points</th>
                        </thead>
                        <tbody> 
                                @for ($i = 0; $i < $periode1->count(); $i++)
                                    
                                    @php
                                        if ($examen[$i]->max == $examen[$i]->total) {
                                            $noteEx += $examen[$i]->note;
                                            $maxEx += $examen[$i]->total;
                                        } else {
                                            
                                            $examen[$i]->note = round($examen[$i]->note * $examen[$i]->total / $examen[$i]->max, 1);
                                            $noteEx += $examen[$i]->note;
                                            $maxEx += $examen[$i]->total;
                                        }

                                        //Periode 1
                                        if ($periode1[$i]->max == $periode1[$i]->total) {
                                            $noteP1 += $periode1[$i]->note;
                                            $maxP1 += $periode1[$i]->total;
                                        } else {
                                            
                                            $periode1[$i]->note = round($periode1[$i]->note * $periode1[$i]->total / $periode1[$i]->max, 1);
                                            $noteP1 += $periode1[$i]->note;
                                            $maxP1 += $periode1[$i]->total;
                                        }

                                        //Periode 2
                                        if ($periode2[$i]->max == $periode2[$i]->total) {
                                            $noteP2 += $periode2[$i]->note;
                                            $maxP2 += $periode2[$i]->total;
                                        } else {
                                            
                                            $periode2[$i]->note = round($periode2[$i]->note * $periode2[$i]->total / $periode2[$i]->max, 1);
                                            $noteP2 += $periode2[$i]->note;
                                            $maxP2 += $periode2[$i]->total;
                                        }
                                        
                                        $noteTri += $periode1[$i]->note + $periode2[$i]->note + $examen[$i]->note;
                                        
                                        

                                    @endphp
                                    <tr>
                                        <td class="p-1 border text-left uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90"> {{$examen[$i]->nom }} </td>
                                        <td class="p-1 border text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 font-bold"> {{$periode1[$i]->total}} </td>
                                        <td class="p-1 border text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 "> {{$periode1[$i]->note}} </td>
                                        <td class="p-1 border text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 "> {{$periode2[$i]->note}} </td>
                                        <td class="p-1 border text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 font-bold"> {{ $examen[$i]->total }} </td>
                                        <td class="p-1 border text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 "> {{$examen[$i]->note}} </td>
                                        <td class="p-1 border text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 font-bold"> {{ $examen[$i]->total * 2 }} </td>
                                        <td class="p-1 border text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 "> {{ $periode1[$i]->note + $periode2[$i]->note + $examen[$i]->note }} </td>
                                        
                                        
                                    </tr>

                                @endfor
                                
                                
                            </tbody>
                            <tfoot>
                                {{-- <tr>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total Tri</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total </th>
                                </tr> --}}
                                <tr>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >TOTAUX</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > {{$maxP1}} </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >{{$noteP1}}</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >{{$noteP2}}</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >{{$maxEx}}</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >{{$noteEx}}</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > {{ $maxEx*2 }} </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >  {{$noteTri}} </th>
                                </tr>
                                <tr>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > POURCENTAGE </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 bg-slate-400" ></th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > {{ round($noteP1 * 100 / $maxP1, 1) }} %</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > {{ round($noteP2 * 100 / $maxP2, 1) }} %</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 bg-slate-400" ></th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >{{ round($noteEx * 100 / $maxEx, 1) }} %</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 bg-slate-400" ></th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >{{ round($noteTri * 100 / ($maxEx*2), 1)}} %</th>
                                </tr>
                                <tr>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > APPLICATION </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 bg-slate-400" ></th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >
                                        @php
                                        $pourc1 = round($noteP1 * 100 / $maxP1, 1);
                                        $pourc2 = round($noteP2 * 100 / $maxP2, 1);
                                        $pourcExam = round($noteEx * 100 / $maxEx, 1);
                                        $pourcTrim = round($noteTri * 100 / ($maxEx*2), 1);

                                        @endphp

                                        @if($pourc1 > 80)
                                            E
                                        @else
                                            @if ($pourc1 > 70 && $pourc1 < 81)
                                                TB
                                            @else
                                                @if ($pourc1 > 60 && $pourc1 < 81 )
                                                    B
                                                @else
                                                    @if ($pourc1 > 49 && $pourc1 < 61)
                                                        AB
                                                    @else
                                                        M
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >

                                        @if($pourc2 > 80)
                                            E
                                        @else
                                            @if ($pourc2 > 70 && $pourc2 < 81)
                                                TB
                                            @else
                                                @if ($pourc2 > 60 && $pourc2 < 81 )
                                                    B
                                                @else
                                                    @if ($pourc2 > 49 && $pourc2 < 61)
                                                        AB
                                                    @else
                                                        M
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 bg-slate-400" ></th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 bg-slate-400" ></th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 bg-slate-400" ></th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 bg-slate-400" ></th>
                                </tr>
                                <tr>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > CONDUITE </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 bg-slate-400" ></th>
                                    <th class="p-1 border font-bold text-center  align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >
                                        @if ($conduite1 !== null)
                                        {{$conduite1->conduite->abbreviation}}
                                        @else
                                            @if (!Auth::user()->isParent())
                                                <a href="{{route('conduites.link',[$eleve->id,$p1])}}" class="text-blue-500 underline">conduite indisponible</a>
                                            @else
                                                <span class="text-blue-500">conduite indisponible</span>
                                            @endif
                                    @endif
                                    </th>
                                    <th class="p-1 border font-bold text-center  align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >
                                        @if ($conduite2 !== null)
                                        {{$conduite2->conduite->abbreviation}}
                                        @else
                                            @if (!Auth::user()->isParent())
                                                <a href="{{route('conduites.link',[$eleve->id,$p2])}}" class="text-blue-500 underline">conduite indisponible</a>
                                            @else
                                                <span class="text-blue-500">conduite indisponible</span>
                                            @endif
                                    @endif
                                    </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 bg-slate-400" ></th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 bg-slate-400" ></th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 bg-slate-400" ></th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90 bg-slate-400" ></th>
                                </tr>
                        </tfoot>
                    </table>
                    @if (($resultat1 !== $pourc1 || $resultat2 !== $pourc2 || $resultatExam !== $pourcExam || $resultatTrim !== $pourcTrim) && Auth::user()->isEnseignant())
                        <form class="ml-2 self-end" action="{{route('resultat.trimestre.store', [$trimestre->id,$eleve->id])}}" method="post">
                            @csrf
                            <input type="hidden" name="periode1" value="{{$pourc1}}">
                            <input type="hidden" name="periode2" value="{{$pourc2}}">
                            <input type="hidden" name="examen" value="{{$pourcExam}}">
                            <input type="hidden" name="trimestre" value="{{$pourcTrim}}">
                            <x-button title="Valider le bulletin">Valider ✅</x-button>
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
    {{-- @if (!$examen == null)
        <button id="cmd" class="btn bg-blue-500 px-2 py-1 text-white rounded">Imprimer le Bulletin</button>
    @endif --}}
    
@endsection

<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script-->

