@extends('layouts.admin')
@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        @if (isset($search))
            <x-nav-eleves :search="$search" :pagename="$page_name"></x-nav-eleves>
        @else
            <x-nav-eleves :pagename="$page_name"></x-nav-eleves>
        @endif

        <div class="relative w-full">

            <div
                class="relative flex flex-col flex-auto min-w-0 p-4  overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-auto max-w-full px-3">
                        <div
                            class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-size-base h-19 w-19 rounded-xl">
                            <img src="{{ $item->sexe === 'M' ? asset('storage/avatar-boy.png') : asset('storage/avatar-girl.png') }}"
                                alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                        </div>
                    </div>
                    <div class="flex-none w-auto max-w-full px-3 my-auto">
                        <div class="h-full">
                            <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">
                                {{ $item->matricule }}
                            </p>
                            <h5 class="mb-1 dark:text-white">{{ $item->nom . ' ' . $item->prenom }}</h5>
                            <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">
                                {{ $item->sexe === 'M' ? 'Masculim' : 'Feminim' }}
                            </p>
                            <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">
                                {{ $item->classe(false) === null ? null : $item->classe(false) }}
                            </p>
                        </div>
                    </div>
                    <div class="px-3 mx-auto mt-4 sm:my-auto sm:mr-0  md:flex-none">
                        <div class="relative
                        right-0">
                        </div>
                        <ul class="relative flex flex-wrap gap-2  list-none " role="tablist">
                            <li
                                class="btn-identity cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                                <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    role="tab" aria-selected="false">
                                    <i class="fa fa-solid fa-id-card"></i>
                                    <span class="ml-2">Identité Complete</span>
                                </a>
                            </li>
                            <li
                                class="btn-next cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                                <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    href="{{ route('eleves.show', $eleves->count() === $index + 1 ? $eleves[0]->id : $eleves[$index + 1]->id) }}"
                                    role="tab" aria-selected="false" title="Eleve Suivant">
                                    <span class="mr-2">Suivant</span>
                                    <i class="fa fa-solid fa-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



        <div class="frm-identity hidden shadow-2xl relative bg-white rounded-5 p-5 w-full  z-20">
            <p class="font-bold text-base"> Identité Complete de l'Eleve </p>
            <form method="PUT" action="{{ route('eleves.update', $item->id) }}">
                @csrf
                {{ method_field('PUT') }}
                <!-- Email Address -->
                <div class=" flex justify-between gap-4">
                    <div class="mt-4 w-full">
                        <x-label for="matricule" :value="__('Matricule')" />
                        <x-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="$item->matricule"
                            required readonly />
                    </div>
                    <div class="mt-4 w-full">
                        <x-label for="nom" :value="__('Nom et Post-Nom')" />
                        <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="$item->nom"
                            required />
                    </div>

                </div>
                <div class="flex justify-between gap-4">
                    <div class="mt-4 w-full">
                        <x-label for="prenom" :value="__('Prenom')" />
                        <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="$item->prenom"
                            required />
                    </div>
                    <div class="mt-4 w-full">
                        <x-label for="sexe" :value="__('Sexe')" />
                        <div class="block mt-3">
                            Masculin : @if ($item->sexe === 'M')
                                <input type="radio" name="sexe" id="sexe-m" value="M" required checked>
                            @else
                                <input type="radio" name="sexe" id="sexe-m" value="M" required>
                            @endif
                            Feminin : @if ($item->sexe === 'F')
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
                            :value="$item->lieu_naissance" required />
                    </div>
                    <div class="mt-4 w-full">
                        <x-label for="date_naissance" :value="__('Date de Naissance')" />
                        <x-input id="date-naissance" class="block mt-1 w-full" type="date" name="date_naissance"
                            :value="$item->date_naissance" required />
                    </div>
                </div>
                <div class="flex justify-between gap-4">
                    <div class="mt-4 w-full">
                        <x-label for="nom_pere" :value="__('Nom du Pere')" />
                        <x-input id="nom_pere" class="block mt-1 w-full" type="text" name="nom_pere" :value="$item->nom_pere"
                            required />
                    </div>
                    <div class="mt-4 w-full">
                        <x-label for="nom_mere" :value="__('Nom de la Mere')" />
                        <x-input id="nom_mere" class="block mt-1 w-full" type="text" name="nom_mere"
                            :value="$item->nom_mere" required />
                    </div>
                </div>
                <div class="mt-4">
                    <x-label for="adresse" :value="__('Adresse')" />
                    <x-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="$item->adresse"
                        required />
                </div>
                <div class="mt-4">
                    <x-button>Enregistrer</x-button>
                </div>
            </form>
        </div>

        <div class=" flex flex-row w-full justify-between gap-5">

            <div class="shadow-2xl relative bg-white rounded-5 p-5 w-1/3  z-20">
                <p class="text-center font-bold text-base"> Frequentations </p>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <th
                                    class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Annee Scolaire
                                </th>
                                <th
                                    class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Classe
                                </th>
                            </thead>
                            <tbody>

                                @if ($item->frequentations->count() > 0)
                                    @foreach ($item->frequentations as $frequetation)
                                        <tr class=" rounded-2xl hover:bg-slate-100">
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-red-500  ">
                                                <a href="{{ route('eleves.show', $frequetation->id) }}">
                                                    {{ $frequetation->annee_scolaire === null ? 'null' : $frequetation->annee_scolaire->nom }}
                                                </a>
                                            </td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-red-500  ">
                                                <a href="{{ route('eleves.show', $frequetation->id) }}">
                                                    {{ $frequetation->classe->niveau . ' ' . $frequetation->classe->nom }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="shadow-2xl relative bg-white rounded-5 p-5 w-full  z-20">
                <p class="text-center font-bold text-base"> Fiches de Cotes Annee Scolaire {{ $annee_scolaire->nom }} </p>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="flex flex-row justify-between gap-3 p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <th
                                    class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Evaluations
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($trimestres as $trimestre)
                                    @foreach ($trimestre->periodes as $periode)
                                        <tr class=" rounded-2xl hover:bg-slate-100">
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-red-500  ">
                                                <a href="{{ route('eleves.evaluations', [$item->id, $periode->id]) }}">
                                                    {{ $periode->nom }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach

                            </tbody>
                        </table>
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <th
                                    class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Examens
                                </th>
                            </thead>
                            <tbody>

                                @foreach ($trimestres as $trimestre)
                                    <tr class=" rounded-2xl hover:bg-slate-100">
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-red-500  ">
                                            <a href="{{ route('eleves.examens', [$item->id, $trimestre->id]) }}">
                                                {{ $trimestre->nom }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>
@endsection
