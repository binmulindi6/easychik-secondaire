@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">

        @if (isset($search))
            <x-nav-eleves :search="$search" :pagename="$page_name"></x-nav-eleves>
        @else
            <x-nav-eleves :pagename="$page_name"></x-nav-eleves>
        @endif

        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == 'EleveConduite / Create')
                <div class="frm-create shadow-2xl container p-4 bg-white rounded-5">
                @else
                    <div class="frm-create shadow-2xl hidden container p-4 bg-white rounded-5">
            @endif
            @if (isset($self))
                <p class="font-bold text-base"> Edit Frequentation </p>
                <form method="PUT" action="{{ route('eleveconduites.update', $self->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Email Address -->
                    <div class="flex justify-between gap-5">
                        <div class="mt-4 w-full">
                            <x-label for="matricule" :value="__('Matricule Eleve')" />
                            <x-input id="eleve_matricule" class="block mt-1 w-full" type="text" name="eleve_matricule"
                                :value="$eleve->matricule" readonly required />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="classe" :value="__('Classe')" />
                            <x-select :val="$self->classe" :collection="$conduites" class="block mt-1 w-full" name='classe_id'
                                required> </x-select>
                        </div>
                    </div>
                    {{-- <div class="mt-4">
                        <x-label for="annee_scolaire" :value="__('Annee Scolaire')" />
                        <x-select :val="$self->annee_scolaire" :collection="$annees" class="block mt-1 w-full" name='annee_scolaire_id'
                            required> </x-select>
                    </div> --}}
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
                @if (isset($eleve))
                    <p class="font-bold text-base"> Enregistere la Consuite de l'eleve {{$eleve->nom}} pour la {{$periode->nom}}</p>
                @else
                    <p class="font-bold text-base"> Ajouter une Frequentation</p>
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

                <form method="POST" action="{{ route('eleveconduites.store') }}">
                    @method('POST')
                    @csrf
                    <!-- Email Address -->
                    <div class="flex flex-between gap-5">
                        {{-- @if (isset($matricule)) --}}
                            <div class="mt-4 w-full">
                                <x-label for="matricule" :value="__('Matricule Eleve')" />
                                <x-input id="matricule" class="block mt-1 w-full" type="text" name="eleve_matricule"
                                    :value="$eleve->matricule" required readonly />
                            </div>
                        {{-- @else
                            <div class="mt-4 w-full">
                                <x-label for="matricule" :value="__('Matricule Eleve')" />
                                <x-input id="matricule" class="block mt-1 w-full" type="text" name="eleve_matricule"
                                    :value="old('nom')" required />
                            </div>
                        @endif --}}
                        <div class="mt-4 w-full">
                            <x-label for="classe" :value="__('Conduites')" />
                            <x-select :collection="$conduites" class="block mt-1 w-full" name='id_conduite' required> </x-select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <input type="hidden" name="id_periode" value="{{$periode->id}}">
                        {{-- <x-label for="annee_scolaire" :value="__('Annee Scolaire')" />
                            @if (isset($matricule) && isset($current))
                                <x-select :val="$current" :collection="$annees" class="block mt-1 w-full" name='annee_scolaire_id' required> </x-select>
                            @else
                                <x-select :collection="$annees" class="block mt-1 w-full" name='annee_scolaire_id' required></x-select>
                            @endif --}}

                        
                    </div>
                    <div class="flex gap-10">
                        <div class="mt-4">
                            <x-button>Enregister</x-button>
                        </div>
                    </div>
                </form>
            @endif
    </div>
    @endif


    @if (isset($items))
        @if ($page_name == 'Frequentations' || $page_name == 'Frequentations / Search')
            <div class="display shadow-2xl container p-4 bg-white rounded-5">
            @else
                <div class="display shadow-2xl hidden container p-4 bg-white rounded-5">
        @endif

        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Historique de Frequentations</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 ">
                            Matricule Eleve </th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 ">
                            Nom, Prenom </th>
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
                            @if ($item->eleve != null)
                                <tr class="">
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        {{ $item->eleve->matricule }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        <a href="{{ route('eleves.show', $item->eleve->id) }}">
                                            {{ $item->eleve->nom . ' ' . $item->eleve->prenom }} </a>
                                    </td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        {{ $item->classe->niveau->nom . ' ' . $item->classe->nom }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        {{ $item->annee_scolaire === null ? 'null' : $item->annee_scolaire->nom }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                        <div class="flex justify-center gap-4 align-middle">
                                            <a href="{{ route('frequentations.edit', $item->id) }}"><i
                                                    class="fa fa-solid fa-pen"></i></a>
                                            <form class="delete-form"
                                                action="{{ route('frequentations.destroy', $item->id) }}" method="post">
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
