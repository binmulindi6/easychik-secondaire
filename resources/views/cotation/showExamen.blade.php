@extends('layouts.admin')

@section('content')

    <div class="container flex flex-col justify-between gap-5">
        @if (isset($search))
            <x-nav-cotation-travails :search="$search" :pagename="$page_name"></x-nav-cotation-travails>
        @else
            <x-nav-cotation-travails :pagename="$page_name"></x-nav-cotation-travails>
        @endif

    @if (isset($items))
        @if ($page_name == 'Examens / Edit' || $page_name == 'Examens / Create')
            <div
                class="display container shadow-2xl p-4 hidden relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid rounded-2xl bg-clip-border">
            @else
                <div
                    class="display container shadow-2xl p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid rounded-2xl bg-clip-border">
        @endif

        <div class=" flex justify-center p-4 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6 class="text-center uppercase">{{"Examen " . $examen->cours->nom . " " . $examen->trimestre->nom . " " . $examen->trimestre->annee_scolaire->nom }}</h6>
        </div>
        @if (count($items) <= 0)
            <div class="text-red-500 font-semibold text-xl w-full m-auto text-center"> No Data to Display </div>
        @else
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-700 opacity-70">
                                Eleve</th>
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-700 opacity-70">
                                Note / {{$examen->note_max}}</th>
                            {{-- <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Classe </th> --}}
                            {{-- <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Note Max</th>
                            
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Date de l'Evaluation</th> --}}
                            {{-- <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Action</th> --}}
                        </thead>
                        <tbody>

                            @foreach ($items as $item)
                                @if (Auth::user()->isEnseignant() && Auth::user()->classe())
                                {{-- @die(Auth::user()->classe->id) --}}
                                    {{-- @if (Auth::user()->classe() && $item->cours->classe->id === Auth::user()->classe->id) --}}
                                        <tr class="rounded-2xl hover:bg-slate-100">
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                <a href="{{route('eleves.show', $item->eleve_id)}}" class="hover:cursor-pointer hover:text-blue-600">
                                                {{ $item->nom . " " .$item->prenom }}</a>
                                            </td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                <form  id="frm{{$item->id}}" action="{{route('eleves.examens.update.api', $item->id)}}" method="POST" class="flex justify-center items-center gap-2">
                                                    @method('PUT')
                                                    @csrf
                                                    <x-input id="ev{{$item->id}}" class="px-2 py-2 rounded w-20 text-center h-8" type="number" max='{{$examen->note_max}}' name="note_obtenu" value="{{ $item->note_obtenu }}"/>
                                                    <input type="hidden" name="back" value="00">
                                                    <input id="token{{$item->id}}" type="hidden" name="token" value="{{ csrf_token() }}">
                                                    <x-button id="{{$item->id}}" type="submit" class="btn-corriger px-2 h-7 hover:opacity-100"> ✅</x-button>
                                                </form>
                                            </td>
                                            {{-- <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                <a href="{{route('cotations.evaluations.show', $item->id)}}" class="hover:cursor-pointer hover:text-blue-600">
                                                {{ $item->note_max }}</a> 
                                            </td>--}}
                                            {{-- <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                {{ $item->cours->classe->nomCourt() }}</td> --}}
                                            {{-- <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                {{ $item->date_evaluation }}</td> --}}
                                            {{-- <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  text-blue-500 underline">
                                                <div class="flex justify-center gap-4 align-middle">
                                                    <a href="{{ route('evaluations.edit', $item->id) }}" title="Modifier">
                                                        <i class="fa fa-solid fa-pen"></i>
                                                    </a>
                                                    <form class="delete-form" class="delete-form"
                                                        action="{{ route('evaluations.destroy', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="delete-btn" type="submit" title="Effacer">
                                                            <i class="text-red-500 fa fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td> --}}
                                        </tr>
                                    {{-- @endif --}}
                            
                                    @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        </div>
    @endif
    </div>

@endsection
