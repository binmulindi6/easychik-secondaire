@extends('layouts.admin')

@section('content')
    <div class=" flex flex-col gap-5 md:p-5">
        <a href="{{ route('eleves.show', $eleve->id) }}"
            class="p-2 bg-white rounded-full w-8 h-8 flex justify-center items-center"><i
                class="fa fa-solid fa-arrow-left"></i></a>
        <x-eleve-profile-header :data="$eleve"> </x-eleve-profile-header>
        <div class=" flex flex-row justify-between w-full ">
            @if (isset($examens))
                <div
                    class="display  shadow-2xl p-4  flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid rounded-2xl bg-clip-border">

                    <div class=" flex justify-center p-4 pb-0 mb-0 rounded-t-2xl">
                        <h6>Examens {{ $trimestre->nom . ' Annee Scolaire ' . $trimestre->annee_scolaire->nom }}</h6>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Cours </th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Note Obtenu</th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Note Max</th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Date Examen</th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Action</th>

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
                                                    {{ $item->cours->max_examen }}</td>
                                                <td
                                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                    {{ $item->date_examen }}</td>
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
                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            @else
                <div
                    class="display  shadow-2xl p-4  flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid rounded-2xl bg-clip-border">

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
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Cours </th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Note Obtenu</th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Note Max</th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Date Evaluation</th>
                                    <th
                                        class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Action</th>

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
                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
