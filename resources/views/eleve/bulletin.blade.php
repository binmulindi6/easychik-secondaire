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
        body{
            background: #fff;
        }
        #printable{
            min-width: 23cm;
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

    <div id='print' class=" flex flex-col gap-5 md:p-5">

        <a href="{{ route('eleves.show', $eleve->id) }}"
            class="p-2 bg-white rounded-full w-8 h-8 flex justify-center items-center">
            <i class="fa fa-solid fa-arrow-left"></i>
        </a>
        <x-eleve-profile-header :data="$eleve" :print="true" > </x-eleve-profile-header> 


        <div  class="  flex flex-col gap-2 bg-white rounded-xl shadow-xxs w-full p-5  items-center">
            <div class="w-full flex flex-row justify-between">
            <div  class="container w-full flex justify-center"> 
                @if ($examenT1 != null && $periode1 != null && $periode2 != null && $examenT2 != null && $periode3 != null && $periode4 != null && $examenT3 != null && $periode5 != null && $periode6 != null )
                    <div  class="w-full flex flex-col justify-center items-center h-full">
                    <table id="printable" class="border-2xl print:w-60 border-collapse text-xs m-5">
                        <thead>
                            <th colspan="12" class="border p-0.5 uppercase text-left" >
                                <span class="upercase w-full">ecole: {{env("ECOLE")}}</span><br>
                                <span class="upercase w-full">ville: {{env("VILLE")}}                               </span> <br>
                                <span class="upercase w-full">Commune/Ter (1) : {{env("COMMUNE")}}</span> <br>
                                <span class="upercase w-full">code : {{env("CODE")}}</span><br>
                            </th>
                            <th colspan="12" class="border py-1 px-2 uppercase text-left" >
                                
                                <span class="upercase w-full">ELEVE : {{$eleve->nomComplet()}} sexe: {{$eleve->sexe}}</span><br>
                                <span class="upercase w-full">NE (e) a : {{$eleve->lieu_naissance}} le: 
                                    @php
                                        $date = date_create($eleve->date_naissance);
                                        echo date_format($date, "d/m/Y");
                                        @endphp
                                </span> <br>
                                <span class="upercase w-full">Classe : {{$eleve->classe()->niveau->nom . " " . $eleve->classe()->nom}}</span> <br>
                                <span class="upercase w-full">Matricule : {{$eleve->matricule}}</span><br>
                            </th>
                        </thead>
                        <thead>
                            <th colspan="12" class="border p-0.5 uppercase" >Bulletin de l'eleve : {{$eleve->classe()->niveau->nom}} </th>
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
                            <th class=" border p-0.5 text-left uppercase" >Cours </th>
                            <th class=" border p-0.5 text-3" >Max P</th>
                            <th class=" border p-0.5 text-3" >1e P</th>
                            <th class=" border p-0.5 text-3" >2e P</th>
                            <th class=" border p-0.5 text-3" >Max Ex</th>
                            <th class=" border p-0.5 text-3" >Pts Ex</th>
                            <th class=" border p-0.5 text-3" >Max Tri</th>
                            <th class=" border p-0.5 text-3" >Pts Ob</th>

                            <th class=" border p-0.5 text-3" >Max P</th>
                            <th class=" border p-0.5 text-3" >3e P</th>
                            <th class=" border p-0.5 text-3" >4e P</th>
                            <th class=" border p-0.5 text-3" >Max Ex</th>
                            <th class=" border p-0.5 text-3" >Pts Ex</th>
                            <th class=" border p-0.5 text-3" >Max Tri</th>
                            <th class=" border p-0.5 text-3" >Pts Ob</th>

                            <th class=" border p-0.5 text-3" >Max P</th>
                            <th class=" border p-0.5 text-3" >5e P</th>
                            <th class=" border p-0.5 text-3" >6e P</th>
                            <th class=" border p-0.5 text-3" >Max Ex</th>
                            <th class=" border p-0.5 text-3" >Pts Ex</th>
                            <th class=" border p-0.5 text-3" >Max Tri</th>
                            <th class=" border p-0.5 text-3" >Pts Ob</th>


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
                                            
                                            $examenT1[$i]->note = round($examenT1[$i]->note * $examenT1[$i]->total / $examenT1[$i]->max, 1);
                                            $noteExT1 += $examenT1[$i]->note;
                                            $maxExT1 += $examenT1[$i]->total;
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
                                        
                                        $noteTri1 += $periode1[$i]->note + $periode2[$i]->note + $examenT1[$i]->note;

                                        //Trimestre 2

                                        if ($examenT2[$i]->max == $examenT2[$i]->total) {
                                            $noteExT2 += $examenT2[$i]->note;
                                            $maxExT2 += $examenT2[$i]->total;
                                        } else {
                                            
                                            $examenT2[$i]->note = round($examenT2[$i]->note * $examenT2[$i]->total / $examenT2[$i]->max, 1);
                                            $noteExT2 += $examenT2[$i]->note;
                                            $maxExT2 += $examenT2[$i]->total;
                                        }
                                        
                                        //Periode 3
                                        if ($periode3[$i]->max == $periode3[$i]->total) {
                                            $noteP3 += $periode3[$i]->note;
                                            $maxP3 += $periode3[$i]->total;
                                        } else {
                                            
                                            $periode3[$i]->note = round($periode3[$i]->note * $periode3[$i]->total / $periode3[$i]->max, 1);
                                            $noteP3 += $periode3[$i]->note;
                                            $maxP3 += $periode3[$i]->total;
                                        }

                                        //Periode 4
                                        if ($periode4[$i]->max == $periode4[$i]->total) {
                                            $noteP4 += $periode4[$i]->note;
                                            $maxP4 += $periode4[$i]->total;
                                        } else {
                                            
                                            $periode4[$i]->note = round($periode4[$i]->note * $periode4[$i]->total / $periode4[$i]->max, 1);
                                            $noteP4 += $periode4[$i]->note;
                                            $maxP4 += $periode4[$i]->total;
                                        }

                                        $noteTri2 += $periode3[$i]->note + $periode4[$i]->note + $examenT2[$i]->note;

                                        //Trimestre 3

                                        if ($examenT3[$i]->max == $examenT3[$i]->total) {
                                            $noteExT3 += $examenT3[$i]->note;
                                            $maxExT3 += $examenT3[$i]->total;
                                        } else {
                                            
                                            $examenT3[$i]->note = round($examenT3[$i]->note * $examenT3[$i]->total / $examenT3[$i]->max, 1);
                                            $noteExT3 += $examenT3[$i]->note;
                                            $maxExT3 += $examenT3[$i]->total;
                                        }

                                        //Periode 5
                                        if ($periode5[$i]->max == $periode5[$i]->total) {
                                            $noteP5 += $periode5[$i]->note;
                                            $maxP5 += $periode5[$i]->total;
                                        } else {
                                            
                                            $periode5[$i]->note = round($periode5[$i]->note * $periode5[$i]->total / $periode5[$i]->max, 1);
                                            $noteP5 += $periode5[$i]->note;
                                            $maxP5 += $periode5[$i]->total;
                                        }

                                        //Periode 46
                                        if ($periode6[$i]->max == $periode6[$i]->total) {
                                            $noteP6 += $periode6[$i]->note;
                                            $maxP6 += $periode6[$i]->total;
                                        } else {
                                            
                                            $periode6[$i]->note = round($periode6[$i]->note * $periode6[$i]->total / $periode6[$i]->max, 1);
                                            $noteP6 += $periode6[$i]->note;
                                            $maxP6 += $periode6[$i]->total;
                                        }
                                        
                                        $noteTri3 += $periode5[$i]->note + $periode6[$i]->note + $examenT3[$i]->note;

                                    @endphp
                                    <tr>
                                        <td class="border p-0.5 text-left uppercase"> {{$examenT1[$i]->nom }} </td>
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
                                    <th class="border p-0.5 uppercase" > Maxima General </th>
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
                                    <th class="border p-0.5 uppercase" > Pourcentage </th>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" > {{ round($noteP1 * 100 / $maxP1, 1) }}%</td>
                                    <td class="border p-0.5 font-normal text-center" > {{ round($noteP2 * 100 / $maxP2, 1) }}%</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteExT1 * 100 / $maxExT1, 1) }}%</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteTri1 * 100 / ($maxExT1*2), 1)}}%</td>

                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" > {{ round($noteP3 * 100 / $maxP3, 1) }}%</td>
                                    <td class="border p-0.5 font-normal text-center" > {{ round($noteP4 * 100 / $maxP4, 1) }}%</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteExT2 * 100 / $maxExT2, 1) }}%</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteTri2 * 100 / ($maxExT2 * 2), 1)}}%</td>

                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" > {{ round($noteP5 * 100 / $maxP5, 1) }}%</td>
                                    <td class="border p-0.5 font-normal text-center" > {{ round($noteP6 * 100 / $maxP6, 1) }}%</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteExT3 * 100 / $maxExT3, 1) }}%</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteTri3 * 100 / ($maxExT3*2), 1)}}%</td>

                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ round($noteGeneral * 100 / ($maxGeneral), 1)}}%</td>
                                </tr>
                                @php
                                    $pourcP1 = round($noteP1 * 100 / $maxP1, 1);
                                    $pourcP2 = round($noteP2 * 100 / $maxP2, 1);
                                    $pourcP3 = round($noteP3 * 100 / $maxP3, 1);
                                    $pourcP4 = round($noteP4 * 100 / $maxP4, 1);
                                    $pourcP5 = round($noteP5 * 100 / $maxP5, 1);
                                    $pourcP6 = round($noteP6 * 100 / $maxP6, 1);

                                    //examen

                                    $pourcEx1 = round($noteExT1 * 100 / $maxExT1, 1);
                                    $pourcEx2 = round($noteExT2 * 100 / $maxExT2, 1);
                                    $pourcEx3 = round($noteExT3 * 100 / $maxExT3, 1);

                                    //trimestre
                                    
                                    $pourcTrim1 = round($noteTri1 * 100 / ($maxExT1*2), 1);
                                    $pourcTrim2 = round($noteTri2 * 100 / ($maxExT2 * 2), 1);
                                    $pourcTrim3 = round($noteTri3 * 100 / ($maxExT3*2), 1);

                                    //annee

                                    $pourcAnnee = round($noteGeneral * 100 / ($maxGeneral), 1);
                                @endphp
                                <tr>
                                    <th class="border p-0.5 uppercase" > Application </th>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >

                                        @php
                                        function conduite($pourc){
                                            if($pourc > 80){
                                            return 'E';
                                            }else{
                                                if ($pourc > 70 && $pourc < 81){
                                                    return 'TB';
                                                }else{
                                                        if ($pourc > 60 && $pourc < 81 ){
                                                            return 'B';
                                                    }else{
                                                            if ($pourc > 49 && $pourc < 61){
                                                                return 'AB';
                                                    }else{
                                                        return 'M';
                                                    }
                                                    }
                                                    }
                                                }
                                            
                                            }
                                        @endphp
                                        {{ conduite(round($noteP1 * 100 / $maxP1, 1)) }}
                                    </td>
                                    <td class="border p-0.5 font-normal text-center" > {{ conduite(round($noteP2 * 100 / $maxP2, 1)) }}</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    {{-- <td class="border p-0.5 font-normal text-center" >{{ round($noteExT1 * 100 / $maxExT1, 1) }}%</td> --}}
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ conduite(round($noteTri1 * 100 / ($maxExT1*2), 1))}}</td>

                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" > {{ conduite(round($noteP3 * 100 / $maxP3, 1)) }}</td>
                                    <td class="border p-0.5 font-normal text-center" > {{ conduite(round($noteP4 * 100 / $maxP4, 1)) }}</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    {{-- <td class="border p-0.5 font-normal text-center" >{{ round($noteExT2 * 100 / $maxExT2, 1)) }}%</td> --}}
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ conduite(round($noteTri2 * 100 / ($maxExT2 * 2), 1))}}</td>

                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" > {{ conduite(round($noteP5 * 100 / $maxP5, 1)) }}</td>
                                    <td class="border p-0.5 font-normal text-center" > {{ conduite(round($noteP6 * 100 / $maxP6, 1)) }}</td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    {{-- <td class="border p-0.5 font-normal text-center" >{{ round($noteExT3 * 100 / $maxExT3, 1)) }}%</td> --}}
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >{{ conduite(round($noteTri3 * 100 / ($maxExT3*2), 1))}}</td>

                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    {{-- <td class="border p-0.5 font-normal text-center" >{{ round($noteGeneral * 100 / ($maxGeneral), 1))}}%</td> --}}
                                </tr>
                                <tr>
                                    <th class="border p-0.5 uppercase" > Conduite </th>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >
                                        @if ($cond1)
                                            {{$cond1->conduite->abbreviation}}
                                        @else
                                            <a href="{{route('conduites.link',[$eleve->id,$p1->id])}}" class="text-blue-500 text-5" title="enregistrer la conduite">+</a>
                                        @endif
                                    </td>
                                    <td class="border p-0.5 font-normal text-center" >
                                        @if ($cond2)
                                            {{$cond2->conduite->abbreviation}}
                                        @else
                                            <a href="{{route('conduites.link',[$eleve->id,$p2->id])}}" class="text-blue-500 text-5" title="enregistrer la conduite">+</a>
                                        @endif
                                    </td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    {{-- <td class="border p-0.5 font-normal text-center" >{{ round($noteExT1 * 100 / $maxExT1, 1) }}%</td> --}}
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    {{-- <td class="border p-0.5 font-normal text-center" >{{ round($noteTri1 * 100 / ($maxExT1*2), 1)}}%</td> --}}

                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >
                                        @if ($cond3)
                                            {{$cond3->conduite->abbreviation}}
                                        @else
                                            <a href="{{route('conduites.link',[$eleve->id,$p3->id])}}" class="text-blue-500 text-5" title="enregistrer la conduite">+</a>
                                        @endif
                                    </td>
                                    <td class="border p-0.5 font-normal text-center" >
                                        @if ($cond4)
                                            {{$cond4->conduite->abbreviation}}
                                        @else
                                            <a href="{{route('conduites.link',[$eleve->id,$p4->id])}}" class="text-blue-500 text-5" title="enregistrer la conduite">+</a>
                                        @endif
                                    </td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    {{-- <td class="border p-0.5 font-normal text-center" >{{ round($noteExT2 * 100 / $maxExT2, 1) }}%</td> --}}
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    {{-- <td class="border p-0.5 font-normal text-center" >{{ round($noteTri2 * 100 / ($maxExT2 * 2), 1)}}%</td> --}}

                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center" >
                                        @if ($cond6)
                                            {{$cond6->conduite->abbreviation}}
                                        @else
                                            <a href="{{route('conduites.link',[$eleve->id,$p5->id])}}" class="text-blue-500 text-5" title="enregistrer la conduite">+</a>
                                        @endif
                                    </td>
                                    <td class="border p-0.5 font-normal text-center" >
                                        @if ($cond6)
                                            {{$cond6->conduite->abbreviation}}
                                        @else
                                            <a href="{{route('conduites.link',[$eleve->id,$p6->id])}}" class="text-blue-500 text-5" title="enregistrer la conduite">+</a>
                                        @endif
                                    </td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    {{-- <td class="border p-0.5 font-normal text-center" >{{ round($noteExT3 * 100 / $maxExT3, 1) }}%</td> --}}
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    {{-- <td class="border p-0.5 font-normal text-center" >{{ round($noteTri3 * 100 / ($maxExT3*2), 1)}}%</td> --}}

                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    <td class="border p-0.5 font-normal text-center bg-slate-400" ></td>
                                    {{-- <td class="border p-0.5 font-normal text-center" >{{ round($noteGeneral * 100 / ($maxGeneral), 1)}}%</td> --}}
                                </tr>
                                <tr>
                                    <td colspan="24" class="border p-4">
                                        <form class="mr-4 flex flex-row justify-between" action="{{route('resultat.bulletin.store', [$annee_scolaire->id,$eleve->id])}}" method="post">
                                            <div class="flex flex-col gap-2">
                                                <div class="flex flex-row gap-1 items-center">
                                                    @if (Auth::user()->isEnseignant())
                                                        @if ($pourcAnnee >= env("REUSSITE"))
                                                            <x-input checked :submitOnChange="true" type="radio" name="decision" value="passe"></x-input>
                                                        @else
                                                            <x-input :submitOnChange="true" type="radio" name="decision" value="passe"></x-input>
                                                        @endif
                                                    @else
                                                        @if ($pourcAnnee >= env("REUSSITE"))
                                                            <x-input disabled checked type="radio" name="decision" value="passe"></x-input>
                                                        @else
                                                            <x-input disabled type="radio" name="decision" value="passe"></x-input>
                                                        @endif
                                                    @endif
                                                    <span class="uppercase">: L'eleve Passe dans la classe supperieure.</span>
                                                </div>
                                                <div class="flex flex-row gap-1 items-center">
                                                    @if (Auth::user()->isEnseignant())
                                                        @if ($pourcAnnee < env("REUSSITE"))
                                                            <x-input checked :submitOnChange="true" type="radio" name="decision" value="double"> </x-input>
                                                        @else
                                                            <x-input :submitOnChange="true" type="radio" name="decision" value="double"> </x-input>
                                                        @endif
                                                    @else
                                                        @if ($pourcAnnee < env("REUSSITE"))
                                                            <x-input checked disabled type="radio" name="decision" value="double"> </x-input>
                                                        @else
                                                            <x-input disabled type="radio" name="decision" value="double"> </x-input>
                                                        @endif
                                                    @endif
                                                     <span class="uppercase">: L'eleve double la classe.</span>
                                                </div>
                                            </div>    
                                                @csrf
                                                <input type="hidden" name="periode1" value="{{$pourcP1}}">
                                                <input type="hidden" name="periode2" value="{{$pourcP2}}">
                                                <input type="hidden" name="periode3" value="{{$pourcP3}}">
                                                <input type="hidden" name="periode4" value="{{$pourcP4}}">
                                                <input type="hidden" name="periode5" value="{{$pourcP5}}">
                                                <input type="hidden" name="periode6" value="{{$pourcP6}}">
                                                <input type="hidden" name="examen1" value="{{$pourcEx1}}">
                                                <input type="hidden" name="examen2" value="{{$pourcEx2}}">
                                                <input type="hidden" name="examen3" value="{{$pourcEx3}}">
                                                <input type="hidden" name="trimestre1" value="{{$pourcTrim1}}">
                                                <input type="hidden" name="trimestre2" value="{{$pourcTrim2}}">
                                                <input type="hidden" name="trimestre3" value="{{$pourcTrim3}}">
                                                <input type="hidden" name="annee" value="{{$pourcAnnee}}">
                                                @if (($resultatP1 !== $pourcP1 || $resultatP2 !== $pourcP2 || $resultatP3 !== $pourcP3 || $resultatP4 !== $pourcP4 || $resultatP5 !== $pourcP5 || $resultatP6 !== $pourcP6 || $resultatEx1 !== $pourcEx1 || $resultatEx2 !== $pourcEx2 || $resultatEx3 !== $pourcEx3 || $resultatTri1 !== $pourcTrim1 || $resultatTri2 !== $pourcTrim2 || $resultatTri3 !== $pourcTrim3 || $resultatAnnee !== $pourcAnnee) && Auth::user()->isEnseignant())
                                                    <x-button title="Valider le bulletin">Valider ✅</x-button>
                                                @endif
                                        </form>
                                        
                                    </td>
                                </tr>
                        </tfoot>
                    </table>
                    </div>
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

