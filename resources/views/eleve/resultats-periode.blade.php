@extends('layouts.admin')

@section('content')

<div id="print" class=" flex flex-col gap-5 md:p-5">
    
        <a href="{{ route('eleves.evaluations', [$eleve->id,$periode->id]) }}"
            class="p-2 bg-white rounded-full w-8 h-8 flex justify-center items-center">
            <i class="fa fa-solid fa-arrow-left"></i>
        </a>
        <x-eleve-profile-header :data="$eleve" :print="true" > </x-eleve-profile-header> 
   
    <div class="flex flex-col gap-2 bg-white rounded-xl shadow-xxs w-full p-5  items-center">
        <div class="w-full flex flex-row justify-between">
            {{-- <div class="container p-4 mb-2 border-r-2 border-black-500"> 
            
                <p class="font-bold text-xl m-4">Fiche d'Evaluations </p>
                @if ($evaluations != null)
                    <table>
                        <thead>
                            <th class="p-1 border" >Cours </th>
                            <th class="p-1 border" >Note </th>
                            <th class="p-1 border" >Max</th>
                            <th class="p-1 border" >Date</th>
                        </thead>
                        <tbody>
                            @if ($evaluations == null)
                                1010
                            @else
                                @foreach ($evaluations as $item)
                                @if ($item->periode_id == $periode->id ) 
                                    <tr>
                                        <td class="p-1 border"> {{ $item->type_evaluation->nom . " ". $item->cours->nom }} </td>
                                        <td class="p-1 border"> {{$item->pivot->note_obtenu}} </td>
                                        <td class="p-1 border"> {{ $item->note_max }} </td>
                                        <td class="p-1 border"> {{ $item->date_evaluation }}</td>
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
        
            </div> --}}
            <div  class="container w-full flex justify-center"> 
                @if (!$bulletin == null)
                <table border-collapse class=" w-full max-w-160 border border-collapse">
                        <caption class="uppercase font-bold text-4-em">BULLETIN {{ $periode->nom }}, {{ $periode->trimestre->nom }} Annee Scolaire {{ $periode->trimestre->annee_scolaire->nom }}</caption>
                        <thead class="border">
                            <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Cours </th>
                            <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Note Obtenu</th>
                            <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Max Cours</th>
                            <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" ></th>
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
                                        <td class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90"> {{$cours->note}} </td>
                                        <td class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90"> {{ $cours->total }} </td>
                                        <td class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90"></td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <thead>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" > </th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total </th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Total</th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Pourc</th>
                            </thead>
                            <thead>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-900" > </th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-900" >{{$note}} </th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-900" >{{$max}}</th>
                                <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-900" >{{ round($note * 100 / $max, 2) }} %</th>
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
    </div>
    

    @if (!$bulletin == null)
        <button id="cmd" class="btn bg-blue-500 px-2 py-1 text-white rounded">Imprimer la Fiche</button>
    @endif
    
@endsection

<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script-->

