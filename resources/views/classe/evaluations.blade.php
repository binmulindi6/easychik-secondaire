@extends('layouts.sas')

@section('content')

    <div class="container m-5">

        <p class="text-bold text-xl"> Fiche de cote {{ $periode->nom }}, {{ $periode->trimestre->nom }} Annee Scolaire {{ $periode->trimestre->annee_scolaire->nom }}</p>

        <p class="text-bold text-2xl"> Eleve: {{$eleve->nom . " " . $eleve->prenom}} </p>

        
        <div class="flex flex-row justify-between">
            <div class="container p-4 mb-2 border-r-2 border-black-500"> 
            
                <p class="font-bold text-xl m-4">Fiche d'Evaluations </p>
                @if ($evaluations != null)
                    <table>
                        <thead>
                            <th class="p-1" >Cours </th>
                            <th class="p-1" >Note </th>
                            <th class="p-1" >Max</th>
                            <th class="p-1" >Date</th>
                        </thead>
                        <tbody>
                            @if ($evaluations == null)
                                1010
                            @else
                                @foreach ($evaluations as $item)
                                @if ($item->periode_id == $periode->id ) 
                                    <tr>
                                        <td class="p-1"> {{ $item->type_evaluation->nom . " ". $item->cours->nom }} </td>
                                        <td class="p-1"> {{$item->pivot->note_obtenu}} </td>
                                        <td class="p-1"> {{ $item->note_max }} </td>
                                        <td class="p-1"> {{ $item->date_evaluation }}</td>
                                    </tr>
                                @endif
                                @endforeach
                            @endif
                                
                        </tbody>
                    </table>
                @else
                    <p class="text-bold text-2xl text-red-500 text-center">
                        Fiche D'evaluations Indisponible 
                    </p>
                @endif
        
            </div>
    
            <div id='content' class="container p-4"> 
                
                <p  class="font-bold text-xl m-4"> Bulletin </p>
                <button id="cmd" class="btn bg-blue-500 px-2 py-1 text-white rounded">generate PDF</button>

                @if (!$bulletin == null)
                <table>
                        <thead>
                            <th class="p-1 text-left" >Cours </th>
                            <th class="p-1" >Note Obtenu</th>
                            <th class="p-1" >Max Cours</th>
                            <th class="p-1" ></th>
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
                                        <td class="p-1 text-left"> {{$cours->nom }} </td>
                                        <td class="p-1 text-center"> {{$cours->note}} </td>
                                        <td class="p-1 text-center"> {{ $cours->total }} </td>
                                        <td class="p-1 text-center"></td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <thead>
                                <th class="p-1" > </th>
                                <th class="p-1" >Total </th>
                                <th class="p-1" >Total</th>
                                <th class="p-1" >Pourcentatge</th>
                            </thead>
                            <thead>
                                <th class="p-1" > </th>
                                <th class="p-1" >{{$note}} </th>
                                <th class="p-1" >{{$max}}</th>
                                <th class="p-1" >{{ round($note * 100 / $max, 2) }} %</th>
                            </thead>
                        </tfoot>
                    </table>
                @else
                    <p class="text-bold text-2xl text-red-500 text-center">
                       Buelletin Indisponible 
                    </p>
                @endif
            </div>
            <div id='content'></div>
        </div>

    </div>
    
@endsection

<script src="https://code.jquery.com/jquery-3.6.1.min.js"
integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
crossorigin="anonymous">

        

</script>