@extends('layouts.admin')

@section('content')

    <div id='print' class=" flex flex-col gap-5 md:p-5">

        <a href="{{ route('eleves.show', $eleve->id) }}"
            class="p-2 bg-white rounded-full w-8 h-8 flex justify-center items-center">
            <i class="fa fa-solid fa-arrow-left"></i>
        </a>
        <x-eleve-profile-header :data="$eleve" :print="true" > </x-eleve-profile-header> 


        <div  class="  flex flex-col gap-2 bg-white rounded-xl shadow-xxs w-full p-5  items-center">
            <div class="w-full flex flex-row justify-between">
            <div  class="container w-full flex justify-center"> 
                @if ($examenT1 != null && $periode1 != null && $periode2 != null )
                
                    <table id="printable" class="border-2xl print:w-60 border-collapse text-xs m-5">
                        <thead>
                            <th colspan="12" class="border p-0.5 uppercase text-left" >
                                <span class="upercase w-full">ecole:</span><br>
                                <span class="upercase w-full">ville:                                </span> <br>
                                <span class="upercase w-full">Commune/Ter (1)</span> <br>
                                <span class="upercase w-full">code : </span><br>
                            </th>
                            <th colspan="12" class="border py-1 px-2 uppercase text-left" >
                                
                                <span class="upercase w-full">ELEVE : {{$eleve->nomComplet()}} sexe: {{$eleve->sexe}}</span><br>
                                <span class="upercase w-full">NE (e) a : {{$eleve->lieu_naissance}} le: 
                                    @php
                                        $date = date_create($eleve->date_naissance);
                                        echo date_format($date, "d/m/Y");
                                        @endphp
                                </span> <br>
                                <span class="upercase w-full">Classe : {{$eleve->classe()->niveau . " " . 'ANNEE ' . $eleve->classe()->nom}}</span> <br>
                                <span class="upercase w-full">Matricule : {{$eleve->matricule}}</span><br>
                            </th>
                        </thead>
                        <thead>
                            <th colspan="12" class="border p-0.5 uppercase" >Bulletin de l'eleve : {{$eleve->classe()->niveau}}e Annee </th>
                            <th colspan="12" class="border p-0.5 uppercase" > Annee scolaire {{$annee_scolaire->nom}} </th>
                        </thead>
                        <thead>
                            <th class="border row-span-2" rowspan="2"></th>
                            <th colspan="7" class="border p-0.5">PREMIER TRIMESTRE</th>
                            <th colspan="7" class="border p-0.5">SECOND TRIMESTRE</th>
                            <th colspan="7" class="border p-0.5">TROISIEME TRIMESTRE</th>
                            <th colspan="2" class="border p-0.5">TOTAL</th>
                        </thead>
                        <thead>
                            <th class=" border p-0.5 text-left" >Cours </th>
                            <th class=" border p-0.5" >Max P</th>
                            <th class=" border p-0.5" >1e P</th>
                            <th class=" border p-0.5" >2e P</th>
                            <th class=" border p-0.5" >Max Ex</th>
                            <th class=" border p-0.5" >Pts Ex</th>
                            <th class=" border p-0.5" >Max Tri</th>
                            <th class=" border p-0.5" >Pts Ob</th>

                            <th class=" border p-0.5" >Max P</th>
                            <th class=" border p-0.5" >3e P</th>
                            <th class=" border p-0.5" >4e P</th>
                            <th class=" border p-0.5" >Max Ex</th>
                            <th class=" border p-0.5" >Pts Ex</th>
                            <th class=" border p-0.5" >Max Tri</th>
                            <th class=" border p-0.5" >Pts Ob</th>

                            <th class=" border p-0.5" >Max P</th>
                            <th class=" border p-0.5" >5e P</th>
                            <th class=" border p-0.5" >6e P</th>
                            <th class=" border p-0.5" >Max Ex</th>
                            <th class=" border p-0.5" >Pts Ex</th>
                            <th class=" border p-0.5" >Max Tri</th>
                            <th class=" border p-0.5" >Pts Ob</th>


                            <th class=" border p-0.5" >Max</th>
                            <th class=" border p-0.5" >PTS Ob</th>
                        </thead>
                        <tbody> 
                                @for ($i = 0; $i < $periode1->count(); $i++)
                                    
                                    @php
                                        //Trimestre 1

                                        if ($examenT1[$i]->max == $examenT1[$i]->total) {
                                            $noteExT1 += $examenT1[$i]->note;
                                            $maxExT1 += $examenT1[$i]->total;
                                        } else {
                                            
                                            $examenT1[$i]->note = round($examenT1[$i]->note * $examenT1[$i]->total / $examenT1[$i]->max, 2);
                                            $noteExT1 += $examenT1[$i]->note;
                                            $maxExT1 += $examenT1[$i]->total;
                                        }

                                        //Periode 1
                                        if ($periode1[$i]->max == $periode1[$i]->total) {
                                            $noteP1 += $periode1[$i]->note;
                                            $maxP1 += $periode1[$i]->total;
                                        } else {
                                            
                                            $periode1[$i]->note = round($periode1[$i]->note * $periode1[$i]->total / $periode1[$i]->max, 2);
                                            $noteP1 += $periode1[$i]->note;
                                            $maxP1 += $periode1[$i]->total;
                                        }

                                        //Periode 2
                                        if ($periode2[$i]->max == $periode2[$i]->total) {
                                            $noteP2 += $periode2[$i]->note;
                                            $maxP2 += $periode2[$i]->total;
                                        } else {
                                            
                                            $periode2[$i]->note = round($periode2[$i]->note * $periode2[$i]->total / $periode2[$i]->max, 2);
                                            $noteP2 += $periode2[$i]->note;
                                            $maxP2 += $periode2[$i]->total;
                                        }
                                        
                                        $noteTri1 += $periode1[$i]->note + $periode2[$i]->note + $examenT1[$i]->note;

                                        //Trimestre 2

                                        if ($examenT2[$i]->max == $examenT2[$i]->total) {
                                            $noteExT2 += $examenT2[$i]->note;
                                            $maxExT2 += $examenT2[$i]->total;
                                        } else {
                                            
                                            $examenT2[$i]->note = round($examenT2[$i]->note * $examenT2[$i]->total / $examenT2[$i]->max, 2);
                                            $noteExT2 += $examenT2[$i]->note;
                                            $maxExT2 += $examenT2[$i]->total;
                                        }
                                        
                                        //Periode 3
                                        if ($periode3[$i]->max == $periode3[$i]->total) {
                                            $noteP3 += $periode3[$i]->note;
                                            $maxP3 += $periode3[$i]->total;
                                        } else {
                                            
                                            $periode3[$i]->note = round($periode3[$i]->note * $periode3[$i]->total / $periode3[$i]->max, 2);
                                            $noteP3 += $periode3[$i]->note;
                                            $maxP3 += $periode3[$i]->total;
                                        }

                                        //Periode 4
                                        if ($periode4[$i]->max == $periode4[$i]->total) {
                                            $noteP4 += $periode4[$i]->note;
                                            $maxP4 += $periode4[$i]->total;
                                        } else {
                                            
                                            $periode4[$i]->note = round($periode4[$i]->note * $periode4[$i]->total / $periode4[$i]->max, 2);
                                            $noteP4 += $periode4[$i]->note;
                                            $maxP4 += $periode4[$i]->total;
                                        }

                                        $noteTri2 += $periode3[$i]->note + $periode4[$i]->note + $examenT2[$i]->note;

                                        //Trimestre 3

                                        if ($examenT3[$i]->max == $examenT3[$i]->total) {
                                            $noteExT3 += $examenT3[$i]->note;
                                            $maxExT3 += $examenT3[$i]->total;
                                        } else {
                                            
                                            $examenT3[$i]->note = round($examenT3[$i]->note * $examenT3[$i]->total / $examenT3[$i]->max, 2);
                                            $noteExT3 += $examenT3[$i]->note;
                                            $maxExT3 += $examenT3[$i]->total;
                                        }

                                        //Periode 5
                                        if ($periode5[$i]->max == $periode5[$i]->total) {
                                            $noteP5 += $periode5[$i]->note;
                                            $maxP5 += $periode5[$i]->total;
                                        } else {
                                            
                                            $periode5[$i]->note = round($periode5[$i]->note * $periode5[$i]->total / $periode5[$i]->max, 2);
                                            $noteP5 += $periode5[$i]->note;
                                            $maxP5 += $periode5[$i]->total;
                                        }

                                        //Periode 46
                                        if ($periode6[$i]->max == $periode6[$i]->total) {
                                            $noteP6 += $periode6[$i]->note;
                                            $maxP6 += $periode6[$i]->total;
                                        } else {
                                            
                                            $periode6[$i]->note = round($periode6[$i]->note * $periode6[$i]->total / $periode6[$i]->max, 2);
                                            $noteP6 += $periode6[$i]->note;
                                            $maxP6 += $periode6[$i]->total;
                                        }
                                        
                                        $noteTri3 += $periode5[$i]->note + $periode6[$i]->note + $examenT3[$i]->note;

                                    @endphp
                                    <tr>
                                        <td class="border p-0.5 text-left"> {{$examenT1[$i]->nom }} </td>
                                        <td class="border p-0.5 text-center font-bold"> {{$periode1[$i]->total}} </td>
                                        <td class="border p-0.5 text-center"> {{$periode1[$i]->note}} </td>
                                        <td class="border p-0.5 text-center"> {{$periode2[$i]->note}} </td>
                                        <td class="border p-0.5 text-center font-bold"> {{ $examenT1[$i]->total }} </td>
                                        <td class="border p-0.5 text-center"> {{$examenT1[$i]->note}} </td>
                                        <td class="border p-0.5 text-center font-bold"> {{ $examenT1[$i]->total * 2 }} </td>
                                        @php
                                            $PointsT1 = $periode1[$i]->note + $periode2[$i]->note + $examenT1[$i]->note;
                                        @endphp
                                        <td class="border p-0.5 text-center"> {{ $PointsT1 }} </td>
                                        

                                        <td class="border p-0.5 text-center font-bold"> {{$periode3[$i]->total}} </td>
                                        <td class="border p-0.5 text-center"> {{$periode3[$i]->note}} </td>
                                        <td class="border p-0.5 text-center"> {{$periode4[$i]->note}} </td>
                                        <td class="border p-0.5 text-center font-bold"> {{ $examenT2[$i]->total }} </td>
                                        <td class="border p-0.5 text-center"> {{$examenT2[$i]->note}} </td>
                                        <td class="border p-0.5 text-center font-bold"> {{ $examenT2[$i]->total * 2 }} </td>
                                        @php
                                            $PointsT2 = $periode3[$i]->note + $periode4[$i]->note + $examenT2[$i]->note;
                                        @endphp
                                        <td class="border p-0.5 text-center"> {{ $PointsT2 }} </td>

                                        <td class="border p-0.5 text-center font-bold"> {{$periode5[$i]->total}} </td>
                                        <td class="border p-0.5 text-center"> {{$periode5[$i]->note}} </td>
                                        <td class="border p-0.5 text-center"> {{$periode6[$i]->note}} </td>
                                        <td class="border p-0.5 text-center font-bold"> {{ $examenT3[$i]->total }} </td>
                                        <td class="border p-0.5 text-center"> {{$examenT3[$i]->note}} </td>
                                        <td class="border p-0.5 text-center font-bold"> {{ $examenT3[$i]->total * 2 }} </td>
                                        @php
                                            $PointsT3 = $periode5[$i]->note + $periode6[$i]->note + $examenT3[$i]->note;
                                        @endphp
                                        <td class="border p-0.5 text-center"> {{ $PointsT3 }} </td>


                                        <td class="border p-0.5 text-center font-bold"> {{$examenT1[$i]->total * 2 + $examenT2[$i]->total * 2 + $examenT3[$i]->total * 2 }} </td>
                                        <td class="border p-0.5 text-center"> {{ $PointsT1 + $PointsT2 + $PointsT3 }} </td>
                                        
                                    </tr>

                                @endfor
                                
                                
                            </tbody>
                            <tfoot>
                                
                                <tr>
                                    <th class="border p-0.5" > Maxima General </th>
                                    <th class="border p-0.5" > {{$maxP1}} </th>
                                    <th class="border p-0.5" >{{$noteP1}}</th>
                                    <th class="border p-0.5" >{{$noteP2}}</th>
                                    <th class="border p-0.5" >{{$maxExT1}}</th>
                                    <th class="border p-0.5" >{{$noteExT1}}</th>
                                    <th class="border p-0.5" > {{ $maxExT1*2 }} </th>
                                    <th class="border p-0.5" >  {{$noteTri1}} </th>

                                    <th class="border p-0.5" > {{$maxP3}} </th>
                                    <th class="border p-0.5" >{{$noteP3}}</th>
                                    <th class="border p-0.5" >{{$noteP4}}</th>
                                    <th class="border p-0.5" >{{$maxExT2}}</th>
                                    <th class="border p-0.5" >{{$noteExT2}}</th>
                                    <th class="border p-0.5" > {{ $maxExT2*2 }} </th>
                                    <th class="border p-0.5" >  {{$noteTri2}} </th>

                                    <th class="border p-0.5" > {{$maxP5}} </th>
                                    <th class="border p-0.5" >{{$noteP5}}</th>
                                    <th class="border p-0.5" >{{$noteP6}}</th>
                                    <th class="border p-0.5" >{{$maxExT3}}</th>
                                    <th class="border p-0.5" >{{$noteExT3}}</th>
                                    <th class="border p-0.5" > {{ $maxExT3*2 }} </th>
                                    <th class="border p-0.5" >  {{$noteTri3}} </th>
                                    @php
                                        $maxGeneral = $maxExT3 * 6;
                                    @endphp

                                    <th class="border p-0.5" >  {{$maxGeneral}} </th>
                                    @php
                                        $noteGeneral = $noteTri1 + $noteTri2 + $noteTri3;
                                    @endphp
                                    <th class="border p-0.5" >  {{$noteGeneral}} </th>

                                    
                                </tr>
        
                                <tr>
                                    <th class="border p-0.5" > Pourcentage </th>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" > {{ round($noteP1 * 100 / $maxP1, 2) }} %</td>
                                    <td class="border p-0.5 font-normal text-center" > {{ round($noteP2 * 100 / $maxP2, 2) }} %</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteExT1 * 100 / $maxExT1, 2) }} %</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteTri1 * 100 / ($maxExT1*2), 2)}} %</td>

                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" > {{ round($noteP3 * 100 / $maxP3, 2) }} %</td>
                                    <td class="border p-0.5 font-normal text-center" > {{ round($noteP4 * 100 / $maxP4, 2) }} %</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteExT2 * 100 / $maxExT2, 2) }} %</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteTri2 * 100 / ($maxExT2 * 2), 2)}} %</td>

                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" > {{ round($noteP5 * 100 / $maxP5, 2) }} %</td>
                                    <td class="border p-0.5 font-normal text-center" > {{ round($noteP6 * 100 / $maxP6, 2) }} %</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteExT3 * 100 / $maxExT3, 2) }} %</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteTri3 * 100 / ($maxExT3*2), 2)}} %</td>

                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteGeneral * 100 / ($maxGeneral), 2)}} %</td>
                                </tr>
                        </tfoot>
                    </table>
                @else
                    <p class="text-bold text-2xl text-red-500 text-center">
                       Buelletin Indisponible 
                    </p>
                @endif
            </div>
            </div>
        </div>
        
    </div>
    
@endsection

<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script-->

