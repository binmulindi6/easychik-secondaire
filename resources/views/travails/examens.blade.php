@extends('layouts.admin')

@section('content')

    <div class="container flex flex-col justify-between gap-5">
        @if (isset($search))
            @if (isset($classe))
                <x-nav-travails :search="$search" :pagename="$page_name" :classe="$classe"></x-nav-travails>
            @else
                <x-nav-travails :search="$search" :pagename="$page_name"></x-nav-travails>
            @endif
        @else
            @if (isset($classe))
                <x-nav-travails :pagename="$page_name" :classe="$classe"></x-nav-travails>
            @else
                <x-nav-travails :pagename="$page_name"></x-nav-travails>
            @endif
        @endif

        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == 'Examens / Edit' || $page_name == 'Examens / Create')
                <div class="frm-create shadow-2xl relative bg-white rounded-5 p-5 w-full  z-20">
                @else
                    <div class="frm-create shadow-2xl relative hidden bg-white rounded-5 p-5 w-full  z-20">
            @endif
            @if (isset($self))

                <p class="font-bold text-base"> Modifier Examen </p>
                <form method="PUT" action="{{ route('examens.update', $self->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="cours" :value="__('Cours')" />
                        <x-select :val="$self->cours" :collection="$cours" class="block mt-1 w-full" name='cours' required>
                        </x-select>
                    </div>
                    <div class="mt-4">
                        <x-label for="note_max" :value="__('Note Maximum')" />
                        <x-input id="note-max" class="block mt-1 w-full" type="text" name="note_max" :value="$self->note_max"
                            placeholder="ex: 10" required />
                        @if (isset($classe))
                            <input type='hidden' value="{{ $classe->id }}" name="classe_id" />
                        @endif
                    </div>
                    <div class="mt-4">
                        <x-label for="trimestre" :value="__('Trimestre')" />
                        <x-select :val="$self->trimestre" :collection="$trimestres" class="block mt-1 w-full" name='trimestre' required>
                        </x-select>
                    </div>
                    <div class="mt-4">
                        <x-label for="date" :value="__('Date de L\'Examen')" />
                        <x-input id="date-date_examen" class="block mt-1 w-full" type="date" name="date_examen"
                            :value="$self->date_examen" required />
                    </div>
                    <div class="mt-4">
                        <x-button>Enregistrer</x-button>
                    </div>
                </form>
            @else
                <p class="font-bold text-base"> Ajouter un Examen</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="" method="POST" action="{{ route('examens.store') }}">
                    @method('POST')
                    @csrf
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="cours" :value="__('Cours')" />
                        @if ($cours !== null)
                            <x-select :collection="$cours" class="block mt-1 w-full" name='cours' required> </x-select>
                        @else
                            <x-select :collection="$cours" class="block mt-1 w-full" name='cours' required> </x-select>
                        @endif
                    </div>
                    <div class="mt-4">
                        <x-label for="note_max" :value="__('Note Maximum')" />
                        <x-input id="note-max" class="block mt-1 w-full" type="text" name="note_max" :value="old('note_max')"
                            placeholder="ex: 1,2,3" required />
                        @if (isset($classe))
                            <input type='hidden' value="{{ $classe->id }}" name="classe_id" />
                        @endif
                    </div>
                    <div class="mt-4">
                        <x-label for="trimestre" :value="__('Trimestre')" />
                        <x-select :collection="$trimestres" class="block mt-1 w-full" name='trimestre' required> </x-select>
                    </div>
                    <div class="mt-4">
                        <x-label for="date" :value="__('Date de L\'Examen')" />
                        <x-input id="date-date_examen" class="block mt-1 w-full" type="date" name="date_examen"
                            :value="old('date_examen')" required />
                    </div>

                    <div class="mt-4">
                        <x-button>ajouter</x-button>
                    </div>
                </form>
            @endif
    </div>
    @endif


    @if (isset($items))
        @if ($page_name == 'Examens / Edit' || $page_name == 'Examens / Create')
            <div
                class="display container shadow-2xl p-4 hidden relative  flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid rounded-2xl bg-clip-border">
            @else
                <div
                    class="display container shadow-2xl p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid rounded-2xl bg-clip-border">
        @endif

        @if (isset($classe))
            <h6> Examens : {{ $classe->nomComplet() }}</h6>
        @else
            <h6> Examens</h6>
        @endif
        @if ($items->count() <= 0)
            <div class="text-red-500 font-semibold text-xl w-full m-auto text-center"> No Data to Display </div>
        @else
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Cours </th>
                            {{-- <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Classe </th> --}}
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Note Max</th>
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Trimestre</th>
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Date Evaluation</th>
                            <th
                                class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Action</th>
                        </thead>
                        <tbody>

                            @foreach ($items as $item)
                                @if (Auth::user()->isEnseignant() && Auth::user()->classe())
                                    {{-- {{Auth::user()->classe->id}} --}}
                                    {{-- @if (Auth::user()->classe() && $item->cours->classe->id === Auth::user()->classe->id) --}}
                                    <tr class="rounded-2xl hover:bg-slate-100">
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   ">
                                            {{ $item->cours->nom }}</td>
                                        {{-- <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   ">
                                                {{ $item->cours->classe->nomCourt() }}</td> --}}
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                            {{ $item->note_max }}</td>
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                            {{ $item->trimestre->nom }}</td>
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                            {{ $item->date_examen }}</td>
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  text-blue-500 underline">
                                            @if (Auth::user()->isProf($item->cours))
                                                <div class="flex justify-center gap-4 align-middle">
                                                    <a href="{{ route('examens.edit', $item->id) }}" title="Modifier">
                                                        <i class="fa fa-solid fa-pen"></i>
                                                    </a>
                                                    <form class="delete-form" class="delete-form"
                                                        action="{{ route('examens.destroy', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="delete-btn" type="submit" title="Effacer">
                                                            <i class="text-red-500 fa fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- @endif --}}
                                @else
                                    @if (Auth::user()->isProf($item->cours))
                                        <tr class="rounded-2xl hover:bg-slate-100">
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   ">
                                                {{ $item->cours->nom }}</td>
                                            {{-- <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   ">
                                                {{ $item->cours->classe->nomCourt() }}</td> --}}
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                {{ $item->note_max }}</td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                {{ $item->trimestre->nom }}</td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                                {{ $item->date_examen }}</td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  text-blue-500 underline">
                                                <div class="flex justify-center gap-4 align-middle">
                                                    <a href="{{ route('examens.edit', $item->id) }}" title="Modifier">
                                                        <i class="fa fa-solid fa-pen"></i>
                                                    </a>
                                                    <form class="delete-form" class="delete-form"
                                                        action="{{ route('examens.destroy', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="delete-btn" type="submit" title="Effacer">
                                                            <i class="text-red-500 fa fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
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
