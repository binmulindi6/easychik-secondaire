@extends('layouts.sas')

@section('content')
    <p class=" font-bold text-xl mt-5"><a href="{{route('eleves.index')}}" >Eleves</a></p>
    @if(isset($eleve))
        <p class=" font-bold text-xl mt-5"> {{ $eleve->nom . " " . $eleve->prenom }} </p>
    @endif
    <div class="container flex flex-row justify-between gap-5 mt-16" >
        

        @if (isset($examens))
            <div class="container p-4"> 
            
                <p class="font-bold text-xl m-4"> Examens {{ $trimestre->nom . " Annee Scolaire" . $trimestre->annee_scolaire->nom  }}</p>
                <table>
                        <thead>
                            <th class="p-1" >Cours </th>
                            <th class="p-1" >Note Obtenu</th>
                            <th class="p-1" >Note Max</th>
                            <th class="p-1" >Date Examen</th>
                            <th class="p-1" >Action</th>
                            <th class="p-1" >Action</th>
                        </thead>
                        <tbody>
                        
                                @foreach ($examens as $item)

                                    @if ($item->trimestre_id == $trimestre->id)
                                        <tr class="">
                                            <td class="p-1 ">{{$item->cours->nom}}</td>
                                            <td class="p-1 text-center ">{{$item->pivot->note_obtenu}}</td>
                                            <td class="p-1 text-center">{{$item->cours->max_examen}}</td>
                                            <td class="p-1 text-center">{{$item->date_examen}}</td>
                                            <td class="p-1 text-center text-blue-500 unde  rline"><a href="{{ route('eleves.examens.edit',[$eleve->id,$item->id]) }}">edit</a></td>
                                            <td >
                                                <form action="{{ route('eleves.destroy',$item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="p-1 text-blue-500 underline" type="submit">delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                        
                        </tbody>
                </table>
        
            </div>
        @else
            <div class="container p-4"> 
                
                <p class="font-bold text-xl m-4"> Evaluations {{$periode->nom . " " . $periode->trimestre->nom . " Annee Scolaire" . $periode->trimestre->annee_scolaire->nom  }}</p>
                <table>
                        <thead>
                            <th class="p-1" >Cours </th>
                            <th class="p-1" >Note Obtenu</th>
                            <th class="p-1" >Note Max</th>
                            <th class="p-1" >Date Evaluation</th>
                            <th class="p-1" >Action</th>
                            <th class="p-1" >Action</th>
                        </thead>
                        <tbody>
                        
                                @foreach ($evaluations as $item)

                                    @if ($item->periode_id == $periode->id)
                                        <tr class="">
                                            <td class="p-1 ">{{$item->type_evaluation->nom . " " . $item->cours->nom}}</td>
                                            <td class="p-1 text-center ">{{$item->pivot->note_obtenu}}</td>
                                            <td class="p-1 text-center">{{$item->note_max}}</td>
                                            <td class="p-1 text-center">{{$item->date_evaluation}}</td>
                                            <td class="p-1 text-center text-blue-500 unde  rline"><a href="{{ route('eleves.evaluations.edit',[$eleve->id,$item->id]) }}">edit</a></td>
                                            <td >
                                                <form action="{{ route('eleves.destroy',$item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="p-1 text-blue-500 underline" type="submit">delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                        
                        </tbody>
                </table>
        
            </div>
        @endif
    </div>

@endsection