@extends('layouts.admin')

@section('content')

    <div class="container flex flex-col justify-between gap-5">
        @if (isset($search))
        <x-nav-enseignement :pagename="$page_name" :search="$search"> </x-nav-enseignement>
        @else
        <x-nav-enseignement :pagename="$page_name"> </x-nav-enseignement>
        @endif

        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == 'Cours/Edit' || $page_name == 'Cours/Create')
                <div class="frm-create bg-white rounded-5 shadow-2xl container p-5">
                @else
                    <div class="hidden frm-create bg-white rounded-5 shadow-2xl container p-5">
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (isset($self))
                @if (isset($enseignement) && $enseignement !== null)
                    <div class="flex items-end w-full">
                        <button type="button"
                            class="btn-identity inline-block px-8 py-3 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-700 border-0 rounded-lg shadow-md cursor-pointer text-3 tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                            Changer le Proffeseur</button>

                        {{-- <x-button class="btn-identity self-end mr-auto right-0 font-bold text-base mb-2"> Changer d'Enseignant </x-button> --}}
                    </div>
                @endif
                <div class="frm-identity">
                    <p class="font-bold text-base"> Edit Cours </p>
                    <form method="PUT" action="{{ route('cours.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->

                        <div class="flex gap-5">
                            <div class="mt-4 w-full">
                                <x-label for="categorie_cours" :value="__('Categorie Cours')" />
                                <x-select :val="$self->categorie_cours" :collection="$categories" class="block mt-1 w-full"
                                    name='categorie_cours' required> </x-select>
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="nom" :value="__('Nom du Cours')" />
                                <x-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                                    :value="$self->nom" placeholder="ex: Geographie..." required />
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="mt-4 w-full">
                                <x-label for="classe" :value="__('Niveau')" />
                                <x-select :val="$self->niveau" :collection="$niveaux" class="block mt-1 w-full" name='niveau'
                                    required>
                                </x-select>
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="section" :value="__('Section')" />
                                <x-select :val="$self->section" :collection="$sections" class="block mt-1 w-full" name='section'
                                    required>
                                </x-select>
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="mt-4 w-full">
                                <x-label for="max_periode" :value="__('Note Maximum Periode')" />
                                <x-input id="max_periode" class="block mt-1 w-full" type="text" name="max_periode"
                                    :value="$self->max_periode" placeholder="ex: 20" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="max_examen" :value="__('Note Maximum Examen')" />
                                <x-input id="max_examen" class="block mt-1 w-full" type="text" name="max_examen"
                                    :value="$self->max_examen" placeholder="ex: 40" required />
                            </div>
                        </div>
                        <div class="flex gap-10">
                            <div class="mt-4">
                                <x-button>Enregistrer</x-button>
                            </div>
                            <div class="mt-4">
                                <x-button-annuler type='reset' class="bg-red-500"></x-button-annuler>
                            </div>
                        </div>
                    </form>
                </div>
                @if (isset($enseignement) && $enseignement !== null)
                    <div class="frm-identity hidden">
                        <span class="font-bold text-base"> Changer le Proffeseur de ce Cours </span> <br>
                        <span class=" text-base"> Actuel Proffeseur : <a class="font-semibold text-blue-600 underline" href="{{route('employers.show', $enseignement->user->employer->id)}}">{{$enseignement->user->employer->nomComplet()}}</a> </span>
                        <form method="POST" action="{{ route('enseignements.change.user', $enseignement->id) }}">
                            @csrf
                            {{ method_field('POST') }}
                            <!-- Email Address -->
                            <div class="flex flex-between gap-5">
                                <div class="mt-4 w-full">
                                    <x-label for="matricule" :value="__('Enseignant')" />
                                    <x-select :val="$enseignement->user" :only="'Enseignant'" :collection="$users"
                                        class="block mt-1 w-full" name='user_id' required> </x-select>
                                </div>
                                <div class="mt-4 w-full">
                                    <x-label for="classe" :value="__('Cours')" />
                                    <x-input id="nom" class="block mt-1 w-full" type="text" :value="$enseignement->cours->nomComplet()"
                                        placeholder="ex: A,B,C" required readonly />
                                    <input type="hidden" name="cours_id" value="{{ $enseignement->cours->id }}">
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-label for="annee_scolaire" :value="__('Annee Scolaire')" />
                                <x-input id="nom" class="block mt-1 w-full" type="text" :value="$enseignement->annee_scolaire->nom"
                                    placeholder="ex: A,B,C" required readonly />
                                <input type="hidden" name="annee_scolaire_id"
                                    value="{{ $enseignement->annee_scolaire->id }}">

                                <div class="flex gap-10">
                                    <div class="mt-4">
                                        <x-button>Enregistrer</x-button>
                                    </div>
                                    <div class="mt-4">
                                        <x-button-annuler class="btn-identity bg-red-500"></x-button-annuler>
                                    </div>
                                </div>
                        </form>
                    </div>
                @endif
            @else
                <p class="font-bold text-base"> Ajouter un Cours</p>

                <form method="POST" action="{{ route('cours.store') }}">
                    @method('POST')
                    @csrf
                    <!-- Email Address -->
                    <div class="flex gap-5">
                        <div class="mt-4 w-full">
                            <x-label for="categorie_cours" :value="__('Categorie Cours')" />
                            <x-select :collection="$categories" class="block mt-1 w-full" name='categorie_cours' required>
                            </x-select>
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="nom" :value="__('Nom du Cours')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                                :value="old('nom')" placeholder="ex: Geographie..." required />
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="mt-4 w-full">
                            <x-label for="classe" :value="__('Niveau')" />
                            <x-select :collection="$niveaux" class="block mt-1 w-full" name='niveau' required> </x-select>
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="section" :value="__('Section')" />
                            <x-select :collection="$sections" class="block mt-1 w-full" name='section' required> </x-select>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="mt-4 w-full">
                            <x-label for="max_periode" :value="__('Note Maximum Periode')" />
                            <x-input id="max_periode" class="block mt-1 w-full" type="text" name="max_periode"
                                :value="old('max_periode')" placeholder="ex: 20" required />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="max_examen" :value="__('Note Maximum Examen')" />
                            <x-input id="max_examen" class="block mt-1 w-full" type="text" name="max_examen"
                                :value="old('max_examen')" placeholder="ex: 40" required />
                        </div>
                    </div>
                    <div class="flex gap-10">
                        <div class="mt-4">
                            <x-button>ajouter</x-button>
                        </div>
                        <div class="mt-4">
                            <x-button-annuler type='reset' class="bg-red-500"></x-button-annuler>
                        </div>
                    </div>
                </form>
            @endif
    </div>
    @endif


    @if ($page_name == 'Cours/Edit' || $page_name == 'Cours/Create')
        <div class="hidden display bg-white shadow-2xl rounded-5 container p-5">
        @else
            <div class="display bg-white shadow-2xl rounded-5 container p-5">
    @endif

    <div class="p-2 pb-0 mb-0 bg-white rounded-t-2xl">
        <h6>Cours</h6>
    </div>
    @if (isset($items) && count($items) > 0)
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Nom</th>
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Categorie Cours</th>
                        {{-- <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Niveau</th> --}}
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Max Periode </th>
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Max Examen </th>
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Niveau</th>
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Section</th>
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Professeur</th>
                        <th
                            class="p-1 p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
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
                                {{-- <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->niveau->nom }}</td> --}}
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->max_periode }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->max_examen }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->niveau->nom }} </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->section->nom }} </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    @if ($item->enseignant() !== null)
                                        <a class="p-1  text-blue-500 underline"
                                            href="{{ route('employers.show', $item->enseignant()->employer->id) }}">
                                            {{ $item->enseignant()->employer->nom . ' ' . $item->enseignant()->employer->prenom }}
                                        </a>
                                    @else
                                        @if (!Auth::user()->isSecretaire())
                                            <a class="p-1  text-blue-500 underline"
                                                href="{{ route('enseignements.linkCours', $item->id) }}"
                                                title="Assigner un Enseignant"> Enseignant
                                                indisponible </a>
                                        @else
                                            <span class="p-1  text-blue-500 underline"> Enseignant indisponible
                                            </span>
                                        @endif
                                    @endif
                                </td>
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
        @else
            <div class="flex flex-col justify-center gap-2 p-5">
                <span class="uppercase text-red-500 font-semibold text-4 sm:text-6 text-center">⚠️ Pas des Cours pour
                    l'instant, veuillez en créer</span>
                <a href="{{ route('cours.create') }}" class="text-center">
                    <x-button>Ajouter un Cours</x-button></a>
            </div>
    @endif
    </div>
    </div>

@endsection
