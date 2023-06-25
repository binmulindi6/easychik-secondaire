@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">
        @if (isset($search))
            <x-nav-cotation-travails :search="$search" :pagename="$page_name"></x-nav-cotation-travails>
        @else
            <x-nav-cotation-travails :pagename="$page_name"></x-nav-cotation-travails>
        @endif


    @if (isset($items))
        @if ($page_name == 'Evaluations / Edit' || $page_name == 'Evaluations / Create')
            <div
                class="display container shadow-2xl p-4 hidden relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid rounded-2xl bg-clip-border">
            @else
                <div
                    class="display container shadow-2xl p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid rounded-2xl bg-clip-border">
        @endif

        <div class=" flex justify-between p-4 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Choisir une Evaluation à coter</h6>
        </div>
        @if (count($items) <= 0)
            <div class="text-red-500 font-semibold text-xl w-full m-auto text-center"> No Data to Display </div>
        @else
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Type Evaluation</th>
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Periode</th>
                            {{-- <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Classe </th> --}}
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Note Max</th>
                            
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Date de l'Evaluation</th>
                            {{-- <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Action</th> --}}
                        </thead>
                        <tbody>

                            @foreach ($items as $item)
                                @if (Auth::user()->isEnseignant() && Auth::user()->classe())
                                {{-- @die(Auth::user()->classe->id) --}}
                                    @if (Auth::user()->classe() && $item->cours->classe->id === Auth::user()->classe->id)
                                        <tr class="rounded-2xl hover:bg-slate-100">
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                <a href="{{route('cotations.evaluations.show', $item->id)}}" class="hover:cursor-pointer hover:text-blue-600">
                                                {{ $item->type_evaluation->nom . " " .$item->cours->nom }}</a>
                                            </td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                <a href="{{route('cotations.evaluations.show', $item->id)}}" class="hover:cursor-pointer hover:text-blue-600">
                                                {{ $item->periode->nom }}</a>
                                            </td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                <a href="{{route('cotations.evaluations.show', $item->id)}}" class="hover:cursor-pointer hover:text-blue-600">
                                                {{ $item->note_max }}</a>
                                            </td>
                                            {{-- <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                {{ $item->cours->classe->nomCourt() }}</td> --}}
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                {{ $item->date_evaluation }}</td>
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
                                    @endif
                                @else
                                    <tr class="rounded-2xl hover:bg-slate-100">
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                            {{ $item->type_evaluation->nom }}</td>
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                            {{ $item->cours->nom }}</td>
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                            {{ $item->cours->classe->nomCourt() }}</td>
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                            {{ $item->note_max }}</td>
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                            {{ $item->periode->nom }}</td>
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                            {{ $item->date_evaluation }}</td>
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
