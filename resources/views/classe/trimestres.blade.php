@extends('layouts.admin')

@section('content')

    <div id='print' class="container m-5">

        <p class="font-bold text-xl"> Bulletin {{ $trimestre->nom }} Annee Scolaire {{ $trimestre->annee_scolaire->nom }}</p>

        <p class="text-bold text-2xl"> Eleve: {{$eleve->nom . " " . $eleve->prenom}} </p>

        <div class="flex flex-row justify-between">
    
            <div  class="container p-4"> 
                
                <p  class="font-bold text-xl m-4"> Bulletin  </p>
                @if ($examen != null && $periode1 != null && $periode2 != null )
                
                    <table class="border-2xl  border-collapse">
                        <thead>
                            <th class=" border p-1 text-left" >Cours </th>
                            <th class=" border p-1" >Max Periode</th>
                            <th class=" border p-1" >Periode 1</th>
                            <th class=" border p-1" >Periode 2</th>
                            <th class=" border p-1" >Max Examen</th>
                            <th class=" border p-1" >Examen</th>
                            <th class=" border p-1" >Max Tri</th>
                            <th class=" border p-1" >Points</th>
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
                                        <td class="border p-1 text-left"> {{$examen[$i]->nom }} </td>
                                        <td class="border p-1 text-center font-bold"> {{$periode1[$i]->total}} </td>
                                        <td class="border p-1 text-center"> {{$periode1[$i]->note}} </td>
                                        <td class="border p-1 text-center"> {{$periode2[$i]->note}} </td>
                                        <td class="border p-1 text-center font-bold"> {{ $examen[$i]->total }} </td>
                                        <td class="border p-1 text-center"> {{$examen[$i]->note}} </td>
                                        <td class="border p-1 text-center font-bold"> {{ $examen[$i]->total * 2 }} </td>
                                        <td class="border p-1 text-center"> {{ $periode1[$i]->note + $periode2[$i]->note + $examen[$i]->note }} </td>
                                        
                                        
                                    </tr>

                                @endfor
                                
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="border p-1" > </th>
                                    <th class="border p-1" >Total </th>
                                    <th class="border p-1" >Total</th>
                                    <th class="border p-1" >Total</th>
                                    <th class="border p-1" >Total</th>
                                    <th class="border p-1" >Total</th>
                                    <th class="border p-1" >Total Tri</th>
                                    <th class="border p-1" >Total </th>
                                </tr>
                                <tr>
                                    <th class="border p-1" ></th>
                                    <th class="border p-1" > {{$maxP1}} </th>
                                    <th class="border p-1" >{{$noteP1}}</th>
                                    <th class="border p-1" >{{$noteP2}}</th>
                                    <th class="border p-1" >{{$maxEx}}</th>
                                    <th class="border p-1" >{{$noteEx}}</th>
                                    <th class="border p-1" > {{ $maxEx*2 }} </th>
                                    <th class="border p-1" >  {{$noteTri}} </th>
                                </tr>
                                <tr>
                                    <th class="border p-1" > </th>
                                    <th class="border p-1" >-</th>
                                    <th class="border p-1" > Pourc </th>
                                    <th class="border p-1" > Pourc </th>
                                    <th class="border p-1" >-</th>
                                    <th class="border p-1" >Pourc</th>
                                    <th class="border p-1" >-</th>
                                    <th class="border p-1" >Pourc</th>
                                </tr>
                                <tr>
                                    <th class="border p-1" >  </th>
                                    <th class="border p-1" > - </th>
                                    <th class="border p-1" > {{ round($noteP1 * 100 / $maxP1, 2) }} %</th>
                                    <th class="border p-1" > {{ round($noteP2 * 100 / $maxP2, 2) }} %</th>
                                    <th class="border p-1" > - </th>
                                    <th class="border p-1" >{{ round($noteEx * 100 / $maxEx, 2) }} %</th>
                                    <th class="border p-1" >-</th>
                                    <th class="border p-1" >{{ round($noteTri * 100 / ($maxEx*2), 2)}} %</th>
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
    @if (!$examen == null)
        <button id="cmd" class="btn bg-blue-500 px-2 py-1 text-white rounded">Imprimer le Bulletin</button>
    @endif
    
@endsection

<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script-->

