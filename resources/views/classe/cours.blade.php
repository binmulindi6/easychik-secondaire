@extends('layouts.admin')

@section('content')

    <div class="container flex flex-col justify-between gap-5">

        <x-nav-classes :pagename="$page_name"> </x-nav-classes>

        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == 'Cours/Edit' || $page_name == 'Cours/Create')
                <div class="frm-create bg-white rounded-5 shadow-2xl container p-5">
                @else
                    <div class="hidden frm-create bg-white rounded-5 shadow-2xl container p-5">
            @endif
            @if (isset($self))
                <div class="border-b-2 border-color-black-500 pb-4 mb-4">
                    <a href="{{ route('cours.create') }}">
                        <x-button class="bg-green-500">ajouter un Cours</x-button>
                    </a>

                </div>
                <p class="font-bold text-base"> Edit Cours </p>
                <form method="PUT" action="{{ route('cours.update', $self->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Email Address -->
    </div>
    <div class="mt-4">
        <x-label for="categorie_cours" :value="__('Categorie Cours')" />
        <x-select :val="$self->categorie_cours" :collection="$categories" class="block mt-1 w-full" name='categorie_cours' required> </x-select>
        <div class="flex gap-5">
            <div class="mt-4 w-full">
                <x-label for="nom" :value="__('Nom du Cours')" />
                <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="$self->nom"
                    placeholder="ex: Geographie..." required />
            </div>
            <div class="mt-4 w-full">
                <x-label for="classe" :value="__('Classe')" />
                <x-select :val="$self->classe" :collection="$classes" class="block mt-1 w-full" name='classe' required> </x-select>
            </div>
        </div>
        <div class="flex gap-5">
            <div class="mt-4 w-full">
                <x-label for="max_periode" :value="__('Note Maximum Periode')" />
                <x-input id="max_periode" class="block mt-1 w-full" type="text" name="max_periode" :value="$self->max_periode"
                    placeholder="ex: 20" required />
            </div>
            <div class="mt-4 w-full">
                <x-label for="max_examen" :value="__('Note Maximum Examen')" />
                <x-input id="max_examen" class="block mt-1 w-full" type="text" name="max_examen" :value="$self->max_examen"
                    placeholder="ex: 40" required />
            </div>
        </div>
        <div class="mt-4">
            <x-button>Enregistrer</x-button>
        </div>
        </form>
    @else
        <p class="font-bold text-base"> Ajouter un Cours</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('cours.store') }}">
            @method('POST')
            @csrf
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="categorie_cours" :value="__('Categorie Cours')" />
                <x-select :collection="$categories" class="block mt-1 w-full" name='categorie_cours' required> </x-select>
            </div>
            <div class="flex gap-5">
                <div class="mt-4 w-full">
                    <x-label for="nom" :value="__('Nom du Cours')" />
                    <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')"
                        placeholder="ex: Geographie..." required />
                </div>
                <div class="mt-4 w-full">
                    <x-label for="classe" :value="__('Classe')" />
                    <x-select :collection="$classes" class="block mt-1 w-full" name='classe' required> </x-select>
                </div>
            </div>
            <div class="flex gap-5">
                <div class="mt-4 w-full">
                    <x-label for="max_periode" :value="__('Note Maximum Periode')" />
                    <x-input id="max_periode" class="block mt-1 w-full" type="text" name="max_periode" :value="old('max_periode')"
                        placeholder="ex: 20" required />
                </div>
                <div class="mt-4 w-full">
                    <x-label for="max_examen" :value="__('Note Maximum Examen')" />
                    <x-input id="max_examen" class="block mt-1 w-full" type="text" name="max_examen" :value="old('max_examen')"
                        placeholder="ex: 40" required />
                </div>
            </div>
            <div class="mt-4">
                <x-button>ajouter</x-button>
            </div>
        </form>
        @endif
    </div>
    @endif


    @if (isset($items))
        @if ($page_name == 'Cours/Edit' || $page_name == 'Cours/Create')
            <div class="hidden display bg-white shadow-2xl rounded-5 container p-5">
            @else
                <div class="display bg-white shadow-2xl rounded-5 container p-5">
        @endif

        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Cours</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Nom</th>
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Categorie Cours</th>
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Max Periode </th>
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Max Examen </th>
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Classe</th>
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Action</th>
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            <tr class="">
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->nom }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->categorie_cours->nom }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->max_periode }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->max_examen }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->classe->niveau . ' ' . $item->classe->nom }} </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  text-blue-500 underline">
                                    <div class="flex justify-center gap-4 align-middle">
                                        <a title="Modifier" href="{{ route('cours.edit', $item->id) }}"><i
                                                class="fa fa-solid fa-pen"></i></a>
                                        <form class="delete-form" action="{{ route('cours.destroy', $item->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Effacer" type="submit"><i
                                                    class="text-red-500 fa fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
    @endif
    </div>

@endsection
