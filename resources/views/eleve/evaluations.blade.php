@extends('layouts.admin')

@section('content')
    <div class=" flex flex-col gap-5 md:p-5">
        <x-back :link="route('eleves.show', $eleve->id)"></x-back>


        @if (isset($periode))
            <x-eleve-profile-header :data="$eleve" :periode="$periode"> </x-eleve-profile-header> 
        @else
            <x-eleve-profile-header :data="$eleve" :trimestre="$trimestre"> </x-eleve-profile-header>
        @endif
        <div class=" flex flex-col gap-5  justify-between w-full ">
            @if (isset($examens))
                <div id="evaluations"
                    class="display  shadow-2xl p-4  flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid rounded-2xl bg-clip-border">

                    <div class=" flex justify-center p-4 pb-0 mb-0 rounded-t-2xl">
                        <h6>Examens {{ $trimestre->nom . ' Annee Scolaire ' . $trimestre->annee_scolaire->nom }}</h6>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                        Cours </th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                        Note Obtenu</th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                        Note Max</th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                        Date Examen</th>
                                    @if (!Auth::user()->isParent())
                                        <th
                                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                            Action</th>
                                    @endif

                                </thead>
                                <tbody>

                                    @foreach ($examens as $item)
                                        @if ($item->trimestre_id == $trimestre->id)
                                            <tr class=" rounded-2xl hover:bg-slate-100">
                                                <td
                                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                    {{ $item->cours->nom }}</td>
                                                <td
                                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                    {{ $item->pivot->note_obtenu }}</td>
                                                <td
                                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                    {{ $item->note_max }}</td>
                                                <td
                                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                    {{ $item->date_examen }}</td>
                                                @if (!Auth::user()->isParent())
                                                    <td
                                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                        <div class="flex justify-center gap-4 align-middle">
                                                            <a title="Modifier"
                                                                href="{{ route('eleves.examens.edit', [$eleve->id, $item->id]) }}"><i
                                                                    class="fa fa-solid fa-pen"></i></a>

                                                            {{-- <form action="{{ route('eleves.examens.destroy', $item->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="delete-btn" title="Effacer" type="submit"><i
                                                                        class="text-red-500 fa fa-solid fa-trash"></i></button>
                                                            </form> --}}
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>

                <div id="fiche-evaluation" class="display hidden shadow-2xl p-5  flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid rounded-2xl bg-clip-border">
                    <div class="conatiner w-full flex justify-center">
                        @if ($examens != null)
                        <table class="border-collapse w-full max-w-160">
                            <caption class="uppercase font-bold text-xs pb-2">Fiche des cotes Examens
                                {{ $trimestre->nom }} Annee Scolaire {{ $trimestre->annee_scolaire->nom }}
                            </caption>
                            <thead>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Cours </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Note </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Max</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Date</th>
                            </thead>
                            <tbody>
                                @if ($examens == null)
                                    1010
                                @else
                                    @foreach ($examens as $item)
                                    @if ($item->trimestre_id == $trimestre->id ) 
                                        <tr>
                                            <td class="p-1 border font-bold text-left uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-70"> {{ $item->cours->nom }} </td>
                                            <td class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-70"> {{$item->pivot->note_obtenu}} </td>
                                            <td class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-70"> {{ $item->note_max }} </td>
                                            <td class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-70"> {{ $item->date_examen }}</td>
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
                </div>
            @else
                <div id="evaluations" class="display  shadow-2xl p-4  flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid rounded-2xl bg-clip-border">

                    <div class=" flex justify-center p-4 pb-0 mb-0 rounded-t-2xl">
                        <h6>Evaluations
                            {{ $periode->nom . ' ' . $periode->trimestre->nom . ' Annee Scolaire' . $periode->trimestre->annee_scolaire->nom }}
                        </h6>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                        Cours </th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                        Note Obtenu</th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                        Note Max</th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                        Date Evaluation</th>
                                    @if (!Auth::user()->isParent())
                                        <th
                                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                            Action</th>
                                    @endif

                                </thead>
                                <tbody>

                                    @foreach ($evaluations as $item)
                                        @if ($item->periode_id == $periode->id)
                                            <tr class="">
                                                <td
                                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">

                                                    {{ $item->type_evaluation->nom . ' ' . $item->cours->nom }}
                                                </td>
                                                <td
                                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                    {{ $item->pivot->note_obtenu }}</td>
                                                <td
                                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                    {{ $item->note_max }}</td>
                                                <td
                                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                    {{ $item->date_evaluation }}</td>
                                                @if (!Auth::user()->isParent())
                                                    <td
                                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                        <div class="flex justify-center gap-4 align-middle">
                                                            <a title="Modifier"
                                                                href="{{ route('eleves.evaluations.edit', [$eleve->id, $item->id]) }}"><i
                                                                    class="fa fa-solid fa-pen"></i></a>

                                                            {{-- <form action="{{ route('eleves.examens.destroy', $item->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="delete-btn" title="Effacer" type="submit"><i
                                                                        class="text-red-500 fa fa-solid fa-trash"></i></button>
                                                            </form> --}}
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div id="fiche-evaluation" class="display hidden shadow-2xl p-5  flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid rounded-2xl bg-clip-border">
          
            
                    <div class="conatiner w-full flex justify-center">
                        @if ($evaluations != null)
                            <table class="border-collapse w-full max-w-160">
                                <caption class="uppercase font-bold text-xs pb-2">Fiche des cotes 
                                    {{ $periode->nom . ', ' . $periode->trimestre->nom . ' Annee Scolaire' . $periode->trimestre->annee_scolaire->nom }}
                                </caption>
                                <thead>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Cours </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Note </th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Max</th>
                                    <th class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-90" >Date</th>
                                </thead>
                                <tbody>
                                    @if ($evaluations == null)
                                        1010
                                    @else
                                        @foreach ($evaluations as $item)
                                        @if ($item->periode_id == $periode->id ) 
                                            <tr>
                                                <td class="p-1 border font-bold text-left uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-70"> {{ $item->type_evaluation->nom . " ". $item->cours->nom }} </td>
                                                <td class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-70"> {{$item->pivot->note_obtenu}} </td>
                                                <td class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-70"> {{ $item->note_max }} </td>
                                                <td class="p-1 border font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xs  tracking-none whitespace-nowrap text-slate-700 opacity-70"> {{ $item->date_evaluation }}</td>
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

                </div>
            @endif
        </div>

    </div>
@endsection


<script defer>
    // const btnShowFiche = document.getElementById('btn-show-fiche');
    // const ficheEvaluation = document.getElementById('fiche-evaluation');
    // const evaluations =  document.getElementById('evaluations');

    // btnShowFiche.addEventListener('click', ()=>{
    //     ficheEvaluation.classList.toggle('hidden');
    // })
</script>