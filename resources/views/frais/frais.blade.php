@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">

        @if (isset($search))
            <x-nav-frais :search="$search" :pagename="$page_name"></x-nav-frais>
        @else
            <x-nav-frais :pagename="$page_name"></x-nav-frais>
        @endif



        @if ($page_name == 'Frais / Create' || $page_name == 'Frais / Edit')
            <div class="frm-create shadow-2xl container p-4 bg-white rounded-5">
            @else
                <div class="frm-create shadow-2xl hidden container p-4 bg-white rounded-5">
        @endif
        @if (isset($self))
            <p class="font-bold text-base"> Modifier Frais</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="get" action="{{ route('frais.update', $self->id) }}">
                @method('PUT')
                @csrf
                <!-- Email Address -->
                <div class="w-full flex flex-row gap-4 justify-between">
                    <div class="mt-4 w-full">
                        <x-label for="type_frais" :value="__('Type')" />
                        <x-select :linkName="'Nouveau Type'" :val="$self->type_frais" :isSelectedLink="'type-art'" id="type-frais" :collection="$types"
                            class="block mt-1 w-full" name='type_frais' required></x-select>
                    </div>
                    <div class="mt-4 w-full">
                        <x-label for="mode_paiement" :value="__('Mode de Paiement')" />
                        <x-select :linkName="'Nouveau Mode de Paiement'" :val="$self->mode_paiement" :isSelectedLink="'mode-art'" :collection="$modes"
                            class="block mt-1 w-full" name='mode_paiement' required></x-select>
                    </div>
                </div>
                <div class="w-full flex flex-row gap-4 justify-between">
                    <div class="mt-4 w-full">
                        <x-label for="nom" :value="__('Intitulé du Frais')" />
                        <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="$self->nom"
                            placeholder="ex: Prime Scolaire" required />
                    </div>
                    <div class="mt-4 w-full">
                        <x-label for="montant" :value="__('Montant Globale')" />
                        <x-input id="montant" class="block mt-1 w-full" type="number" name="montant" :value="$self->montant"
                            placeholder="ex: 20" required />
                        {{-- <span></span> --}}
                    </div>
                </div>
                <div class="mt-4">
                    <x-label for="niveau" :value="__('Niveau')" />
                    <x-select :collection="$niveaux" :val="$self->niveau" class="block mt-1 w-full" name='niveau'
                        required></x-select>
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
            <p class="font-bold text-base"> Ajouter un Frais</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('frais.store') }}">
                @method('POST')
                @csrf
                <!-- Email Address -->
                <div class="w-full flex flex-row gap-4 justify-between">
                    <div class="mt-4 w-full">
                        <x-label for="type_frais" :value="__('Type')" />
                        <x-select :linkName="'Nouveau Type'" :isSelectedLink="'type-art'" id="type-frais" :collection="$types"
                            class="block mt-1 w-full" name='type_frais' required></x-select>
                    </div>
                    <div class="mt-4 w-full">
                        <x-label for="mode_paiement" :value="__('Mode de Paiement')" />
                        <x-select :linkName="'Nouveau Mode de Paiement'" :isSelectedLink="'mode-art'" :collection="$modes" class="block mt-1 w-full"
                            name='mode_paiement' required></x-select>
                    </div>
                </div>
                <div class="w-full flex flex-row gap-4 justify-between">
                    <div class="mt-4 w-full">
                        <x-label for="nom" :value="__('Intitulé du Frais')" />
                        <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')"
                            placeholder="ex: Prime Scolaire" required />
                    </div>
                    <div class="mt-4 w-full">
                        <x-label for="montant" :value="__('Montant Globale')" />
                        <x-input id="montant" class="block mt-1 w-full" type="number" name="montant" :value="old('montant')"
                            placeholder="ex: 20" required />
                        {{-- <span></span> --}}
                    </div>
                </div>
                <div class="mt-4">
                    <x-label for="niveau" :value="__('Niveau')" />
                    <x-select :all="'TOUT LES NIVEAUX'" :collection="$niveaux" class="block mt-1 w-full" name='niveau'
                        required></x-select>
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
    <x-add-categorie :datas="[
        'devise' => 'Devise ex: USD',
    ]" :theId="'type-art'" :title="'Ajouter Un Nouveau Type de Frais'" :link="route('type.frais.store')"> </x-add-categorie>
    <x-add-categorie :theId="'mode-art'" :title="'Ajouter Un Nouveau Mode de Paiement'" :link="route('mode.paiements.store')"> </x-add-categorie>




    @if ($page_name == 'Frais' || $page_name == 'Frais / Search')
        <div class="display shadow-2xl container p-4 bg-white rounded-5">
        @else
            <div class="display shadow-2xl hidden container p-4 bg-white rounded-5">
    @endif

    <div class="p-2 pb-0 mb-0 bg-white rounded-t-2xl">
        <h6>Liste des Frais en vigeur dans l'établissement</h6>
    </div>
    @if (isset($items) && count($items) > 0)
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                            Non </th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                            Montant </th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                            Niveaux de classes</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                            type</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                            Mode de Paiement</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                            Action</th>
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            <tr class="">
                                <td
                                    class="p-1 uppercase text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                    {{ $item->nom }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                    {{ $item->montant . ' ' . $item->type_frais->devise }}
                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                    {{ $item->niveau->nom }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                    {{ $item->type_frais->nom }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                    {{ $item->mode_paiement->nom }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                    <div class="flex justify-center gap-4 align-middle">
                                        <a href="{{ route('frais.edit', $item->id) }}"><i
                                                class="fa fa-solid fa-pen"></i></a>
                                        <form class="delete-form" action="{{ route('frais.destroy', $item->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"><i
                                                    class=" text-red-500 fa fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        </div>
    @else
    <div class="flex flex-col justify-center gap-2 p-5">
        <span class="uppercase text-red-500 font-semibold text-4 sm:text-6 text-center">⚠️ Pas des Frais pour l'instant, veuillez en créer</span>
        <a href="{{ route('frais.create') }}" class="text-center">
            <x-button>Ajouter un Frais</x-button></a>
    </div>
    @endif
    </div>
    </div>

@endsection


<script defer>
    // const inputType = document.querySelector(".frm-create");
    // console.log(inputType);
    // inputType.addEventListener('onChange', ()=>{
    //     console.log(inputType.value);
    // });
</script>
