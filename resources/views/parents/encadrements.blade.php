@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">

        @if (isset($search))
            <x-nav-users :search="$search" :pagename="$page_name"></x-nav-users>
        @else
            <x-nav-users :pagename="$page_name"></x-nav-users>
        @endif

        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == 'Encadrements / Create' || $page_name == 'Encadrements / Edit')
                <div class="frm-create shadow-2xl container p-4 bg-white rounded-5">
                @else
                    <div class="frm-create shadow-2xl hidden container p-4 bg-white rounded-5">
            @endif
            @if (isset($self))
                <p class="font-bold text-base"> Edit Frequentation </p>
                <form method="PUT" action="{{ route('encadrements.update', $self->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Email Address -->
                    <div class="flex flex-between gap-5">
                        @if (isset($matricule))
                            <div class="mt-4 w-full">
                                <x-label for="matricule" :value="__('Matricule de l\'enseignant')" />
                                <x-select :val="$self->user" :collection="$users" class="block mt-1 w-full" name='user_id' required> </x-select>
                            </div>
                        @else
                            <div class="mt-4 w-full">
                                <x-label for="matricule" :value="__('Enseignant')" />
                                <x-select :val="$self->user" :collection="$users" class="block mt-1 w-full" name='user_id' required> </x-select>
                            </div>
                        @endif
                        <div class="mt-4 w-full">
                            <x-label for="classe" :value="__('Classe')" />
                            <x-select :val="$self->classe" :collection="$classes" class="block mt-1 w-full" name='classe_id' required> </x-select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-label for="annee_scolaire" :value="__('Annee Scolaire')" />
                            @if (isset($matricule) && isset($current))
                                <x-select :val="$current" :collection="$annees" class="block mt-1 w-full" name='annee_scolaire_id' required> </x-select>
                            @else
                                <x-select :val="$self->annee_scolaire" :collection="$annees" class="block mt-1 w-full" name='annee_scolaire_id' required></x-select>
                            @endif
                    </div>
                    <div class="flex gap-10">
                        <div class="mt-4">
                            <x-button>Enregistrer</x-button>
                        </div>
                        {{-- <div class="mt-4">
                            <x-button class="bg-red-500">annuler</x-button>
                        </div> --}}
                    </div>
                </form>
            @else
                @if (isset($user))
                    <p class="font-bold text-base"> Assigner une Classe à L'Enseignant pour l'annee Scolaire en cours</p>
                @else
                    <p class="font-bold text-base"> Ajouter un Encadrement</p>
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

                <form method="POST" action="{{ route('encadrements.store') }}">
                    @method('POST')
                    @csrf
                    <!-- Email Address -->
                    <div class="flex flex-between gap-5">
                        @if (isset($user))
                            <div class="mt-4 w-full">
                                <x-label for="matricule" :value="__('Enseignant')" />
                                <x-select disabled :val="$user" :collection="$users" class="block mt-1 w-full" name='user_id' required> </x-select>
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                            </div>
                        @else
                            <div class="mt-4 w-full">
                                <x-label for="matricule" :value="__('Enseignant')" />
                                <x-select :collection="$users" class="block mt-1 w-full" name='user_id' required> </x-select>
                            </div>
                        @endif
                        <div class="mt-4 w-full">
                            <x-label for="classe" :value="__('Classe')" />
                            <x-select :collection="$classes" class="block mt-1 w-full" name='classe_id' required> </x-select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-label for="annee_scolaire" :value="__('Annee Scolaire')" />
                            @if (isset($user) && isset($current))
                                <x-select disabled readonly :val="$current" :collection="$annees" class="block mt-1 w-full" name='annee_scolaire_id' required> </x-select>
                                <input type="hidden" name="user_id" value="{{$current->id}}">
                            @else
                                <x-select :collection="$annees" class="block mt-1 w-full" name='annee_scolaire_id' required></x-select>
                            @endif
                    </div>
                    <div class="flex gap-10">
                        <div class="mt-4">
                            <x-button>ajouter</x-button>
                        </div>
                        
                    </div>
                </form>
            @endif
    </div>
    @endif


    @if (isset($items))
        @if ($page_name == 'Encadrements' || $page_name == 'Encadrements / Search')
            <div class="display shadow-2xl container p-4 bg-white rounded-5">
            @else
                <div class="display shadow-2xl hidden container p-4 bg-white rounded-5">
        @endif

        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Historique D'Encadrements</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 ">
                            Enseignant </th>
                        {{-- <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 ">
                            Nom, Prenom </th>--}}
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 ">
                            Classe</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 ">
                            Annee Scolaire</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 ">
                            Action</th>
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            @if ($item->user != null)
                                <tr class="">
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        {{ $item->user->employer->nom . " " . $item->user->employer->prenom }}</td>
                                    {{-- <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        <a href="{{ route('eleves.show', $item->eleve->id) }}">
                                            {{ $item->eleve->nom . ' ' . $item->eleve->prenom }} </a>
                                    </td> --}}
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        {{ $item->classe->niveau->nom . ' ' . $item->classe->nom }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        {{ $item->annee_scolaire === null ? 'null' : $item->annee_scolaire->nom }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                        <div class="flex justify-center gap-4 align-middle">
                                            <a href="{{ route('encadrements.edit', $item->id) }}"><i
                                                    class="fa fa-solid fa-pen"></i></a>
                                            <form class="delete-form"
                                                action="{{ route('encadrements.destroy', $item->id) }}" method="post">
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
