@extends('layouts.admin')

@section('content')

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
                
                    <table id="printable" border-collapse class=" w-full max-w-160 border border-collapse">
                        <caption class="uppercase font-bold text-xs pb-2">BULLETIN  {{ $trimestre->nom }}, Annee Scolaire {{ $trimestre->annee_scolaire->nom }}</caption>
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
                                            
                                            $examen[$i]->note = round($examen[$i]->note * $examen[$i]->total / $examen[$i]->max, 2);
                                            $noteEx += $examen[$i]->note;
                                            $maxEx += $examen[$i]->total;
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
                                <tr>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total Tri</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total </th>
                                </tr>
                                <tr>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" ></th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > {{$maxP1}} </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >{{$noteP1}}</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >{{$noteP2}}</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >{{$maxEx}}</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >{{$noteEx}}</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > {{ $maxEx*2 }} </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >  {{$noteTri}} </th>
                                </tr>
                                <tr>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >-</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > Pourc </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > Pourc </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >-</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Pourc</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >-</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Pourc</th>
                                </tr>
                                <tr>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >  </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > - </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > {{ round($noteP1 * 100 / $maxP1, 2) }} %</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > {{ round($noteP2 * 100 / $maxP2, 2) }} %</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > - </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >{{ round($noteEx * 100 / $maxEx, 2) }} %</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >-</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >{{ round($noteTri * 100 / ($maxEx*2), 2)}} %</th>
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
    {{-- @if (!$examen == null)
        <button id="cmd" class="btn bg-blue-500 px-2 py-1 text-white rounded">Imprimer le Bulletin</button>
    @endif --}}
    
@endsection

<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script-->

