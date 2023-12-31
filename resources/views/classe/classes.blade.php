@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">

        <x-nav-classes :pagename="$page_name"></x-nav-classes>


        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == 'Classes / Edit' || $page_name == 'Classes / Create')
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
                @if (isset($encadrement) && $encadrement !== null)
                    <div class="flex items-end w-full">
                        <button type="button"
                            class="btn-identity inline-block px-8 py-3 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-700 border-0 rounded-lg shadow-md cursor-pointer text-3 tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                            Changer L'Enseignant</button>

                        {{-- <x-button class="btn-identity self-end mr-auto right-0 font-bold text-base mb-2"> Changer d'Enseignant </x-button> --}}
                    </div>
                @endif
                <div class="frm-identity">
                    <p class="font-bold text-base"> Edit Classe </p>
                    <form method="PUT" action="{{ route('classes.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="niveau" :value="__('Niveau de la Classe')" />
                            <x-select :val="$self->niveau" :collection="$niveaux" class="block mt-1 w-full" name='niveau'
                                required></x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="section" :value="__('Section')" />
                            <x-select :val="$self->section" :collection="$sections" class="block mt-1 w-full" name='section'
                                required></x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom de la Classe')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                                :value="$self->nom" placeholder="ex: A,B,C" required />
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
                @if (isset($encadrement) && $encadrement !== null)
                    <div class="frm-identity hidden">
                        <span class="font-bold text-base"> Changer l'Encadreur </span>
                        <form method="POST" action="{{ route('encadrements.change.user', $encadrement->id) }}">
                            @csrf
                            {{ method_field('POST') }}
                            <!-- Email Address -->
                            <div class="flex flex-between gap-5">
                                <div class="mt-4 w-full">
                                    <x-label for="matricule" :value="__('Enseignant')" />
                                    <x-select :val="$self->user" :only="'Enseignant'" :collection="$users"
                                        class="block mt-1 w-full" name='user_id' required> </x-select>
                                </div>
                                <div class="mt-4 w-full">
                                    <x-label for="classe" :value="__('Classe')" />
                                    <x-input id="nom" class="block mt-1 w-full" type="text" :value="$encadrement->classe->nomComplet()"
                                        placeholder="ex: A,B,C" required readonly />
                                    <input type="hidden" name="classe_id" value="{{ $encadrement->classe->id }}">
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-label for="annee_scolaire" :value="__('Annee Scolaire')" />
                                <x-input id="nom" class="block mt-1 w-full" type="text" :value="$encadrement->annee_scolaire->nom"
                                    placeholder="ex: A,B,C" required readonly />
                                <input type="hidden" name="annee_scolaire_id"
                                    value="{{ $encadrement->annee_scolaire->id }}">

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
                <p class="font-bold text-base"> Ajouter une Classe</p>

                <form method="POST" action="{{ route('classes.store') }}">
                    @method('POST')
                    @csrf
                    <!-- Email Address -->

                    <div class="mt-4">
                        <x-label for="niveau" :value="__('Niveau de la Classe')" />
                        <x-select :collection="$niveaux" class="block mt-1 w-full" name='niveau' required></x-select>
                    </div>
                    <div class="mt-4">
                        <x-label for="section" :value="__('Section')" />
                        <x-select :collection="$sections" class="block mt-1 w-full" name='section' required></x-select>
                    </div>
                    <div class="mt-4">
                        <x-label for="nom" :value="__('Nom de la Classe')" />
                        <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')"
                            placeholder="ex: A,B,C" required />
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


    @if ($page_name == 'Classes / Edit' || $page_name == 'Classes / Create')
        <div class="hidden display bg-white shadow-2xl rounded-5 container p-5">
        @else
            <div class="display bg-white shadow-2xl rounded-5 container p-5">
    @endif
    <div class="pl-6pb-0 mb-0 bg-white rounded-t-2xl">
        <h6>Classes</h6>
    </div>
    @if (isset($items) && count($items) > 0)
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Niveau </th>
                        <th
                            class="p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Section </th>
                        <th
                            class="p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Nom</th>
                        <th
                            class="p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Enseignant Titulaire</th>
                        @if (!Auth::user()->isSecretaire())
                            <th
                                class="p-1px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                                Action</th>
                        @endif
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            <tr class="">
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    <a class="p-1  hover:text-blue-500" href="{{ route('classes.show', $item->id) }}">
                                        {{ $item->niveau->numerotation . ' ' . $item->niveau->nom }}
                                    </a>
                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->section->nom }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->nom }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">

                                    {{-- @if ($item->user() !== null)
                                        {{$item->user->employer->nom}}
                                    @endif --}}

                                    @if ($item->user() !== null)
                                        {{ $item->user->employer->nom . ' ' . $item->user->employer->prenom }}
                                    @else
                                        @if (!Auth::user()->isSecretaire())
                                            <a class="p-1  text-blue-500 underline"
                                                href="{{ route('encadrements.linkClasse', $item->id) }}"> Enseignant Titulaire
                                                indisponible </a>
                                        @else
                                            <span class="p-1  text-blue-500 underline"> Enseignant Titulaire indisponible </span>
                                        @endif
                                    @endif

                                </td>
                                @if (!Auth::user()->isSecretaire())
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  text-blue-500 underline">
                                        <div class="flex justify-center gap-4 align-middle">
                                            <a title="Modifier" href="{{ route('classes.edit', $item->id) }}"><i
                                                    class="fa fa-solid fa-pen"></i></a>
                                            {{-- <form class="delete-form" action="{{ route('classes.destroy', $item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button title="Effacer" type="submit"><i
                                                        class="text-red-500 fa fa-solid fa-trash"></i></button>
                                            </form> --}}
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        </div>
    @else
        <div class="flex flex-col justify-center gap-2 p-5">
            <span class="uppercase text-red-500 font-semibold text-4 sm:text-6 text-center">⚠️ Pas des classes pour
                l'instant, veuillez en créer</span>
            <a href="{{ route('classes.create') }}" class="text-center">
                <x-button>Ajouter une Classe</x-button></a>
        </div>
    @endif
    </div>
    </div>

@endsection
