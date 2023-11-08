@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">

        @if (isset($search))
            <x-nav-enseignement :search="$search" :pagename="$page_name"></x-nav-enseignement>
        @else
            <x-nav-enseignement :pagename="$page_name"></x-nav-enseignement>
        @endif


        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == 'Enseignements / Create' || $page_name == 'Enseignements / Edit')
                <div class="frm-create shadow-2xl container p-4 bg-white rounded-5">
                @else
                    <div class="frm-create shadow-2xl hidden container p-4 bg-white rounded-5">
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
                <p class="font-bold text-base"> Modifier Enseignement </p>
                <form method="PUT" action="{{ route('enseignements.update', $self->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Email Address -->
                    <div class="flex flex-between gap-5">
                        @if (isset($matricule))
                            <div class="mt-4 w-full">
                                <x-label for="matricule" :value="__('Matricule de l\'enseignant')" />
                                <x-select :val="$self->user" :only="'Enseignant'" :collection="$users" class="block mt-1 w-full"
                                    name='user_id' required> </x-select>
                            </div>
                        @else
                            <div class="mt-4 w-full">
                                <x-label for="matricule" :value="__('Enseignant')" />
                                <x-select :val="$self->user" :only="'Enseignant'" :collection="$users" class="block mt-1 w-full"
                                    name='user_id' required> </x-select>
                            </div>
                        @endif
                        <div class="mt-4 w-full">
                            <x-label for="cours" :value="__('Cours')" />
                            <x-select :val="$self->cours" :collection="$cours" class="block mt-1 w-full" name='cours_id'
                                required> </x-select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-label for="annee_scolaire" :value="__('Annee Scolaire')" />
                        @if (isset($matricule) && isset($current))
                            <x-select :val="$current" :collection="$annees" class="block mt-1 w-full"
                                name='annee_scolaire_id' required> </x-select>
                        @else
                            <x-select :val="$self->annee_scolaire" :collection="$annees" class="block mt-1 w-full"
                                name='annee_scolaire_id' required></x-select>
                        @endif
                    </div>
                    <div class="flex gap-10">
                        <div class="mt-4">
                            <x-button>Enregistrer</x-button>
                        </div>
                        <div class="mt-4">
                            <x-button class="bg-red-500">annuler</x-button>
                        </div>
                    </div>
                </form>
            @else
                @if (isset($user))
                    <p class="font-bold text-base"> Assigner un Cours à L'Enseignant pour l'annee Scolaire en cours</p>
                @else
                    <p class="font-bold text-base"> Ajouter un Enseignement</p>
                @endif
                <form method="POST" action="{{ route('enseignements.store') }}">
                    @method('POST')
                    @csrf
                    <!-- Email Address -->
                    <div class="flex flex-between gap-5">
                        @if (isset($user))
                            <div class="mt-4 w-full">
                                <x-label for="matricule" :value="__('Enseignant')" />
                                <x-select disabled :val="$user" :only="'Enseignant'" :collection="$users"
                                    class="block mt-1 w-full" name='user_id' required> </x-select>
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                            </div>
                        @else
                            <div class="mt-4 w-full">
                                <x-label for="matricule" :value="__('Enseignant')" />
                                <x-select :only="'Enseignant'" :collection="$users" class="block mt-1 w-full" name='user_id'
                                    required> </x-select>
                            </div>
                        @endif
                        <div class="mt-4 w-full">
                            <x-label for="classe" :value="__('Cours')" />
                            @if (isset($cour))
                                <x-select :val="$cour" disabled :collection="$cours" class="block mt-1 w-full">
                                </x-select>
                                <input type="hidden" name="cours_id" value="{{ $cour->id }}">
                            @else
                                <x-select :collection="$cours" class="block mt-1 w-full" name='cours_id' required>
                                </x-select>
                            @endif

                        </div>
                    </div>
                    <div class="mt-4">
                        <x-label for="annee_scolaire" :value="__('Annee Scolaire')" />
                        @if (isset($user) || (isset($cour) && isset($current)))
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                                :value="$current->nom" required />
                            <input type="hidden" name="annee_scolaire_id" value="{{ $current->id }}">
                        @else
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                                :value="$current->nom" required readonly />
                            <input type="hidden" name="annee_scolaire_id" value="{{ $current->id }}">
                        @endif
                    </div>

                    <div class="flex gap-10">
                        <div class="mt-4">
                            <x-button>Ajouter</x-button>
                        </div>
                        <div class="mt-4">
                            <x-button-annuler class="bg-red-500">annuler</x-button-annuler>
                        </div>
                    </div>


                </form>
            @endif
    </div>
    @endif


    @if (isset($items))
        @if ($page_name == 'Enseignements' || $page_name == 'Enseignements / Search')
            <div class="display shadow-2xl container p-4 bg-white rounded-5">
            @else
                <div class="display shadow-2xl hidden container p-4 bg-white rounded-5">
        @endif

        <div class="p-2 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Historique D'Enseignements</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                            Enseignant </th>
                        {{-- <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                            Nom, Prenom </th> --}}
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                            Cours</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                            Annee Scolaire</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                            Action</th>
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            @if ($item->user != null)
                                <tr class="">
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        <a href="{{ route('employers.show', $item->user->employer->id) }}"
                                            class="hover:text-blue-700">
                                            {{ $item->user->employer->nom . ' ' . $item->user->employer->prenom }}
                                        </a>
                                    </td>
                                    {{-- <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        <a href="{{ route('eleves.show', $item->eleve->id) }}">
                                            {{ $item->eleve->nom . ' ' . $item->eleve->prenom }} </a>
                                    </td> --}}
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        <a href="{{ route('cours.show', $item->cours->id) }}" class="hover:text-blue-700">
                                            {{ $item->cours->nomComplet() }}
                                        </a>
                                    </td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        {{ $item->annee_scolaire === null ? 'null' : $item->annee_scolaire->nom }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                        <div class="flex justify-center gap-4 align-middle">
                                            <a href="{{ route('enseignements.edit', $item->id) }}"><i
                                                    class="fa fa-solid fa-pen"></i></a>
                                            <form class="delete-form"
                                                action="{{ route('enseignements.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"><i
                                                        class=" text-red-500 fa fa-solid fa-trash"></i></button>
                                            </form>
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

@endsection
