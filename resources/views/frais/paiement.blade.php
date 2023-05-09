@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">

        @if (isset($search))
            <x-nav-frais :search="$search" :pagename="$page_name"></x-nav-frais>
        @else
            <x-nav-frais :pagename="$page_name"></x-nav-frais>
        @endif

            @if ($page_name == 'Paiements / Create' || $page_name == 'Paiements / Edit')
                <div class="frm-create shadow-2xl container p-4 bg-white rounded-5">
                @else
                    <div class="frm-create shadow-2xl hidden container p-4 bg-white rounded-5">
            @endif
            @if (isset($self))
                <p class="font-bold text-base"> Edit Frequentation </p>
                <form method="PUT" action="{{ route('paiements.update', $self->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                        <!-- Email Address -->
    
                        <div class="mt-4">
                            <x-label for="niveau" :value="__('Niveau de la Classe')" />
                            <x-select :collection="$niveaux" class="block mt-1 w-full" name='niveau' required></x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom de la Classe')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')"
                                placeholder="ex: A,B,C" required />
                        </div>
                        <div class="mt-4">
                            <x-button>ajouter</x-button>
                        </div>
                    </form>
            @else
                    <p class="font-bold text-base"> Enregistrer un Paiement</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (isset($eleve))
                <form method="POST" action="{{ route('paiements.store') }}">
                    @method('POST')
                    @csrf
                    <!-- Email Address -->
                    <div class="w-full flex flex-row gap-4 justify-between">
                        <div class="w-full">
                            <x-label for="type_frais" :value="__('Eleve')" />
                            <x-input id="montant" type='text' class="block mt-1 w-full" readonly :value="$eleve->nomComplet()" required />
                            <input type="hidden" name="eleve" value="{{$eleve->id}}">
                        </div>
                        
                        <div class="w-full">
                            <x-label for="mode_paiement" :value="__('Frais')" />
                            <x-select :collection="$frais" class="block mt-1 w-full" name='frais' required></x-select>
                        </div>
                    </div>
                    <div class="w-full flex flex-row gap-4 justify-between">
                        <div class=" mt-4 w-full">
                            <x-label for="moyen_paiement" :value="__('Moyen de Paiement')" />
                            <x-select id="moyen-paiement" :collection="$moyens" class="block mt-1 w-full" name='moyen_paiement' required></x-select>
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="montant" :value="__('Montant Payé')" />
                            <x-input id="montant" class="block mt-1 w-full" type="number" mim="1" name="montant" :value="old('montant')"
                                placeholder="ex: 20" required />
                            {{-- <span></span> --}}
                        </div>
                    </div>
                    <div class="w-full flex flex-row gap-4 justify-between">
                        <div class="mt-4 w-full">
                            <x-label for="type_frais" :value="__('Reference')" />
                            <x-input id="reference" id="montant" name="reference" type='text' class="block mt-1 w-full" :value="old('reference')" />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="type_frais" :value="__('Date')" />
                            <x-input id="montant" name="date" type='date' class="block mt-1 w-full" :value="old('reference')" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-button>Enregistrer</x-button>
                    </div>
                </form>
                @endif
            @endif
    </div>

    


    @if (isset($items))
        @if ($page_name == 'Paiements' || $page_name == 'Paiements / Search')
            <div class="display shadow-2xl container p-4 bg-white rounded-5">
            @else
                <div class="display shadow-2xl hidden container p-4 bg-white rounded-5">
        @endif

        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Paiements Frais</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 ">
                            Eleve </th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 ">
                            Classe</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 ">
                            Frais </th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 ">
                            Montant Payé</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 ">
                            Date</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 ">
                            Action</th>
                    </thead>
                    <tbody>
                        @if (count($items) > 0)
                        @foreach ($items as $item)
                                <tr class="hover:bg-slate-100 cursor-pointer">
                                    <td
                                        class="p-1 uppercase text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        <a href="{{route('paiements.show', $item->id)}}">
                                            {{ $item->frequentation->eleve->nomComplet() }}
                                        </a>
                                    </td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        {{ $item->frequentation->eleve->classe(false)}}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        {{ $item->frais->nom}}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                            {{ $item->montant_paye . " " . $item->frais->type_frais->devise}} 
                                    </td>
                                    {{-- <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        {{ $item->montant_paye }}</td> --}}
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                        {{ $item->date }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                        <div class="flex justify-center gap-4 align-middle">
                                            <a href="{{ route('paiements.edit', $item->id) }}"><i
                                                    class="fa fa-solid fa-pen"></i></a>
                                            <form class="delete-form"
                                                action="{{ route('paiements.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"><i
                                                        class=" text-red-500 fa fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                        @endforeach
                        @else
                        <tr>
                            <th colspan="5" class=" text-red-500 pt-2">
                                Aucun Paiement Enregisté
                            </th>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>

        </div>
    @endif
    </div>

@endsection


<script>
    const moyen = document.querySelector("#moyen-paiement");
    const ref = document.querySelector("#reference");
    console.log(moyen, ref);
    inputType.addEventListener('onChange', ()=>{
        console.log(inputType.value);
    });
</script>