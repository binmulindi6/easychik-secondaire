@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">
        @if (isset($search))
            <x-nav-travails :search="$search" :pagename="$page_name"></x-nav-travails>
        @else
            <x-nav-travails :pagename="$page_name"></x-nav-travails>
        @endif

        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == 'Evaluations / Edit' || $page_name == 'Evaluations / Create')
                <div class="frm-create shadow-2xl relative bg-white rounded-5 p-5 w-full  z-20">
                @else
                    <div class="frm-create shadow-2xl relative hidden bg-white rounded-5 p-5 w-full  z-20">
            @endif
            @if (isset($self))
                <p class="font-bold text-base"> Edit Evaluation </p>
                <form method="PUT" action="{{ route('evaluations.update', $self->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="type_evaluation" :value="__('Type de L\'evaluation')" />
                        <x-select :val="$self->type_evaluation" :collection="$type_evaluations" class="block mt-1 w-full" name='type_evaluation'
                            required> </x-select>
                    </div>
                    <div class="mt-4">
                        <x-label for="cours" :value="__('Cours')" />
                        <x-select :val="$self->cours" :collection="$cours" class="block mt-1 w-full" name='cours' required>
                        </x-select>
                    </div>
                    <div class="mt-4">
                        <x-label for="note_max" :value="__('Note Maximum')" />
                        <x-input id="note-max" class="block mt-1 w-full" type="text" name="note_max" :value="$self->note_max"
                            placeholder="ex: 10" required />
                    </div>
                    <div class="mt-4">
                        <x-label for="periode" :value="__('Periode')" />
                        <x-select :val="$self->periode" :collection="$periodes" class="block mt-1 w-full" name='periode' required>
                        </x-select>
                    </div>
                    <div class="mt-4">
                        <x-label for="date" :value="__('Date de L\'Evaluation')" />
                        <x-input id="date-evaluation" class="block mt-1 w-full" type="date" name="date_evaluation"
                            :value="$self->date_evaluation" required />
                    </div>
                    <div class="mt-4">
                        <x-button>Enregistrer</x-button>
                    </div>
                </form>
            @else
                <p class="font-bold text-base"> Ajouter une Evaluation</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="" method="POST" action="{{ route('evaluations.store') }}">
                    @method('POST')
                    @csrf
                    <!-- Email Address -->

                    <div class="mt-4">
                        <x-label for="type_evaluation" :value="__('Type de L\'evaluation')" />
                        <x-select :collection="$type_evaluations" class="block mt-1 w-full" name='type_evaluation' required>
                        </x-select>
                    </div>
                    <div class="mt-4">
                        <x-label for="cours" :value="__('Cours')" />
                        <x-select :collection="$cours" class="block mt-1 w-full" name='cours' required> </x-select>
                    </div>
                    <div class="mt-4">
                        <x-label for="note_max" :value="__('Note Maximum')" />
                        <x-input id="note-max" class="block mt-1 w-full" type="text" name="note_max" :value="old('note_max')"
                            placeholder="ex: 1,2,3" required />
                    </div>
                    <div class="mt-4">
                        <x-label for="periode" :value="__('Periode')" />
                        <x-select :collection="$periodes" class="block mt-1 w-full" name='periode' required> </x-select>
                    </div>
                    <div class="mt-4">
                        <x-label for="date" :value="__('Date de L\'Evaluation')" />
                        <x-input id="date-evaluation" class="block mt-1 w-full" type="date" name="date_evaluation"
                            :value="old('date_evaluation')" required />
                    </div>

                    <div class="mt-4">
                        <x-button>ajouter</x-button>
                    </div>
                </form>
            @endif
    </div>
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
            <h6>Evaluations</h6>
        </div>
        @if ($items->count() <= 0)
            <div class="text-red-500 font-semibold text-xl w-full m-auto text-center"> No Data to Display </div>
        @else
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Type Evaluation</th>
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Cours </th>
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Note Max</th>
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Periode</th>
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Date Evaluation</th>
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Action</th>
                        </thead>
                        <tbody>

                            @foreach ($items as $item)
                                <tr class="rounded-2xl hover:bg-slate-100">
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        {{ $item->type_evaluation->nom }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                        {{ $item->cours->nom }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                        {{ $item->note_max }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                        {{ $item->periode->nom }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                        {{ $item->date_evaluation }}</td>
                                    <td
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
                                    </td>
                                </tr>
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
