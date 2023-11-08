@extends('layouts.admin')

@section('content')

    <div id="print" class=" flex flex-col gap-5 md:p-5">

        <a href="{{ route('eleves.show', $eleve->id) }}"
            class="p-2 bg-white rounded-full w-8 h-8 flex justify-center items-center">
            <i class="fa fa-solid fa-arrow-left"></i>
        </a>
        
        <x-eleve-profile-header :data="$eleve" :print="true"> </x-eleve-profile-header>

        <p class="text-bold text-xl"> Fiche de cote {{ $trimestre->nom }} Annee Scolaire {{ $trimestre->annee_scolaire->nom }}</p>

        <p class="text-bold text-2xl"> Eleve: {{$eleve->nom . " " . $eleve->prenom}} </p>

        <div class="flex flex-row justify-between">
            <div class="container p-4 mb-2 border-r-2 border-black-500"> 
            
                <p class="font-bold text-xl m-4">Fiche Examens </p>
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
                                @if ($item->trimestre_id == $trimestre->id ) 
                                    <tr>
                                        <td class="p-1"> {{ $item->cours->nom }} </td>
                                        <td class="p-1"> {{$item->pivot->note_obtenu}} </td>
                                        <td class="p-1"> {{ $item->note_max }} </td>
                                        <td class="p-1"> {{ $item->date_examen }}</td>
                                    </tr>
                                @endif
                                @endforeach
                            @endif
                                
                        </tbody>
                    </table>
                @else
                    <p class="text-bold text-2xl text-red-500 text-center">
                        Fiche Examens Indisponible 
                    </p>
                @endif

            </div>
    
            <div  class="container p-4"> 
                
                <p  class="font-bold text-xl m-4"> Bulletin </p>

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

        </div>
        
    </div>
    @if (!$bulletin == null)
        <button id="cmd" class="btn bg-blue-500 px-2 py-1 text-white rounded">Imprimer la Fiche</button>
    @endif
    
@endsection

