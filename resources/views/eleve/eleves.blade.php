@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">
        @if (isset($search))
            @if (isset($parent))
                <x-nav-eleves :search="$search" :pagename="$page_name" :parent="$parent"></x-nav-eleves>
            @else
                <x-nav-eleves :search="$search" :pagename="$page_name" ></x-nav-eleves>
            @endif
        @else
             @if (isset($parent))
                <x-nav-eleves :pagename="$page_name" :parent="$parent"></x-nav-eleves>
            @else
                <x-nav-eleves :pagename="$page_name" ></x-nav-eleves>
            @endif
        @endif

        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == 'Eleves/Edit' || $page_name == 'Eleves/Create')
                <div class="frm-create shadow-2xl relative bg-white rounded-5 p-5 w-full  z-20">
                @else
                    <div class="frm-create shadow-2xl relative hidden bg-white rounded-5 p-5 w-full  z-20">
            @endif
            @if (isset($self))
                <p class="font-bold text-base"> Edit Eleve </p>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="PUT" action="{{ route('eleves.update', $self->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Email Address -->
                    <div class=" flex justify-between gap-4">
                        <div class="mt-4 w-full">
                            <x-label for="matricule" :value="__('Matricule')" />
                            <x-input id="matricule" class="block mt-1 w-full" type="text" name="matricule"
                                :value="$self->matricule" required readonly />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="nom" :value="__('Nom et Post-Nom')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                                :value="$self->nom" required />
                        </div>

                    </div>
                    <div class="flex justify-between gap-4">
                        <div class="mt-4 w-full">
                            <x-label for="prenom" :value="__('Prenom')" />
                            <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom"
                                :value="$self->prenom" required />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="sexe" :value="__('Sexe')" />
                            <div class="block mt-3">
                                Masculin : @if ($self->sexe === 'M')
                                    <input type="radio" name="sexe" id="sexe-m" value="M" required checked>
                                @else
                                    <input type="radio" name="sexe" id="sexe-m" value="M" required>
                                @endif
                                Feminin : @if ($self->sexe === 'F')
                                    <input type="radio" name="sexe" id="sexe-f" value="F" required checked>
                                @else
                                    <input type="radio" name="sexe" id="sexe-f" value="F" required>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between gap-4">
                        <div class="mt-4 w-full">
                            <x-label for="lieu_naissance" :value="__('Lieu de Naissance')" />
                            <x-input id="lieu_naissance" class="block mt-1 w-full" type="text" name="lieu_naissance"
                                :value="$self->lieu_naissance" required />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="date_naissance" :value="__('Date de Naissance')" />
                            <x-input id="date-naissance" class="block mt-1 w-full" type="date" name="date_naissance"
                                :value="$self->date_naissance" required />
                        </div>
                    </div>
                    <div class="flex justify-between gap-4">
                        <div class="mt-4 w-full">
                            <x-label for="nom_pere" :value="__('Nom du Pere')" />
                            <x-input id="nom_pere" class="block mt-1 w-full" type="text" name="nom_pere"
                                :value="$self->nom_pere" required />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="nom_mere" :value="__('Nom de la Mere')" />
                            <x-input id="nom_mere" class="block mt-1 w-full" type="text" name="nom_mere"
                                :value="$self->nom_mere" required />
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-label for="adresse" :value="__('Adresse')" />
                        <x-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="$self->adresse"
                            required />
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
            @else
                <p class="font-bold text-base"> Ajouter Eleve </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('eleves.store') }}">
                    @method('POST')
                    @csrf
                    <!-- Email Address -->
                    <div class="flex justify-between gap-4">
                        <div class="mt-4 w-full">
                            <x-label for="matricule" :value="__('Matricule')" />
                            <x-input id="matricule" class="block mt-1 w-full" type="text" name="matricule"
                                :value="$last_matricule" required readonly />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="nom" :value="__('Nom et Post-Nom')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                                :value="old('nom')" required />
                        </div>
                    </div>
                    <div class="flex justify-between gap-4">

                        <div class="mt-4 w-full">
                            <x-label for="prenom" :value="__('Prenom')" />
                            <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom"
                                :value="old('prenom')" required />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="sexe" :value="__('Sexe')" />
                            <div class="block mt-3">
                                Masculin : <input type="radio" name="sexe" id="sexe-m" value="M" required
                                    checked>
                                Feminin : <input type="radio" name="sexe" id="sexe-f" value="F" required>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between gap-4">
                        <div class="mt-4 w-full">
                            <x-label for="lieu_naissance" :value="__('Lieu de Naissance')" />
                            <x-input id="lieu_naissance" class="block mt-1 w-full" type="text" name="lieu_naissance"
                                :value="old('lieu_naissance')" required />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="date_naissance" :value="__('Date de Naissance')" />
                            <x-input id="date-naissance" class="block mt-1 w-full" type="date" name="date_naissance"
                                :value="old('')" required />
                        </div>
                    </div>
                    <div class="flex justify-between gap-4">
                        <div class="mt-4 w-full">
                            <x-label for="nom_pere" :value="__('Nom du Pere')" />
                            <x-input id="nom_pere" class="block mt-1 w-full" type="text" name="nom_pere"
                                :value="old('nom_pere')" required />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="nom_mere" :value="__('Nom de la Mere')" />
                            <x-input id="nom_mere" class="block mt-1 w-full" type="text" name="nom_mere"
                                :value="old('nom_mere')" required />
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-label for="adresse" :value="__('Adresse')" />
                        <x-input id="adresse" class="block mt-1 w-full" type="text" name="adresse"
                            :value="old('adresse')" required />
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

    @if(isset($imported))
        <div
                    class="display text-center font-semibold container p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                ✅ {{$imported}} Eleves Importés avec succes
        </div>
    @endif

    @if (isset($items))
        @if ($page_name == 'Eleves/Edit' || $page_name == 'Eleves/Create')
            <div
                class="display container p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
            @else
                <div
                    class="display container  p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
        @endif

        <div class=" flex justify-between pb-0 mb-0 bg-white rounded-t-2xl">
            @if (isset($parent) && $parent != null)
            <h6>Choisir Un Eleve</h6>
            @else
            <h6>Eleves</h6>
            @endif
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Matricule </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Nom, Prenom </th>
                        <th
                            class="px-1 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Sexe </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Lieu, Date de Naissance </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Nom du Pere </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Nom de la Mere </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Adresse </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Classe </th>
                        @if ( Auth::user()->isSecretaire())
                            <th class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap "
                                colspan="2">action</th>
                        @endif
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            <tr class=" rounded-2xl hover:bg-slate-100">
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                    @if (isset($parent) && $parent != null)
                                        <a class="hover:text-red-400" href="{{ route('parent-eleve.link', [$parent,$item->id]) }}">
                                            {{ $item->matricule }}
                                        </a>
                                    @else
                                        <a class="hover:text-red-400" href="{{ route('eleves.show', $item->id) }}">
                                            {{ $item->matricule }}
                                        </a>
                                    @endif
                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    @if (isset($parent) && $parent != null)
                                        <a class="hover:text-red-400" href="{{ route('parent-eleve.link', [$parent,$item->id]) }}">
                                            {{ $item->nom . ' ' . $item->prenom }}</td>
                                        </a>
                                    @else
                                        <a class="hover:text-red-400" href="{{ route('eleves.show', $item->id) }}">
                                            {{ $item->nom . ' ' . $item->prenom }}</td>
                                        </a>
                                    @endif
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->sexe }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->lieu_naissance . ', ' . $item->date_naissance }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->nom_pere }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->nom_mere }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->adresse }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    @if ($item->currentFrequentation() === null)
                                        @if (Auth::user()->isSecretaire() || Auth::user()->isDirecteur())
                                        <a class="text-blue-500 underline"
                                        href="{{ route('frequentations.link', $item->id) }}"> Ajouter dans une classe
                                    </a>
                                    @else
                                    Pas Inscrit(e)
                                        @endif
                                    @else
                                        {{ $item->currentFrequentation()->classe->nomCourt() }}
                                    @endif
                                </td>
                        @if ( Auth::user()->isSecretaire())
                            <td
                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  text-blue-500 underline">
                                <div class="flex justify-center gap-4 align-middle">
                                    <a href="{{ route('eleves.edit', $item->id) }}" title="Modifier">
                                        <i class="fa fa-solid fa-pen"></i>
                                    </a>
                                    <form class="delete-form" class="delete-form"
                                        action="{{ route('eleves.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        @if (Auth::user()->isDirecteur())
                                        <button class="delete-btn" type="submit" title="Effacer">
                                            <i class="text-red-500 fa fa-solid fa-trash"></i>
                                        </button>
                                        @endif
                                    </form>
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
    @endif
    </div>
    </div>

@endsection
