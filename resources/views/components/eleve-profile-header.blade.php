<div class="relative w-full">

    <div
        class="relative flex flex-col flex-auto min-w-0 p-4  overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-auto max-w-full px-3">
                <div id="btn-pop-up"
                    class="relative hover:bg-slate-100 cursor-pointer inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-size-base h-19 w-19 rounded-xl">
                    <img src="{{ $data->avatar !== null ? asset('storage/' . $data->avatar) : ($data->sexe === 'M' ? asset('storage/avatar-boy.png') : asset('storage/avatar-girl.png')) }}"
                        alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                    {{-- <input type="file" name="" id=""> --}}
                </div>
            </div>
            <div class="flex-none w-auto max-w-full px-3 my-auto">
                <div class="h-full">
                    <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">
                        {{ $data->matricule }}
                    </p>
                    <p class="mb-0 font-semibold text-4 leading-normal dark:text-white dark:opacity-60">
                        {{ $data->num_permanent }}
                    </p>
                    <a href={{ route('eleves.show', $data->id) }}>
                        <h5 class="mb-1 hover:underline dark:text-white">{{ $data->nom . ' ' . $data->prenom }}</h5>
                    </a>
                    <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">
                        {{ $data->sexe === 'M' ? 'Masculin' : 'Feminin' }}
                    </p>
                    @if ($data->classe(false) !== null)
                        <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">
                            {{ $data->classe(false) }}
                        </p>
                    @else
                        @if (Auth::user()->isSecretaire() || Auth::user()->isDirecteur() || Auth::user()->isManager())
                            <a class="text-blue-500 underline" href="{{ route('frequentations.link', $data->id) }}">
                                Ajouter dans une classe
                            </a>
                        @else
                            {{ 'Pas Inscrit(e)' }}
                        @endif
                    @endif


                </div>
            </div>
            @if (isset($eleves) && isset($index) && !isset($print))
                <div class="px-3 mx-auto mt-4 sm:my-auto sm:mr-0  md:flex-none">
                    <div class="relativeright-0">
                    </div>
                    <ul class="relative flex flex-wrap gap-2  list-none " role="tablist">
                        @if (
                            (Auth::user()->isSecretaire() ||
                                Auth::user()->isDirecteur() ||
                                Auth::user()->isParent() ||
                                Auth::user()->isManager()) &&
                                $data->currentFrequentation() !== null)
                            <li
                                class=" cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                                <a href="{{ route('eleves.paiements.show', [$data->id, $data->currentFrequentation()->id]) }}"
                                    class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    role="tab" aria-selected="false">
                                    <i class="fa fa-solid fa-money-bill"></i>
                                    <span class="ml-2">Fiche de Paie</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->isSecretaire() || Auth::user()->isDirecteur() || Auth::user()->isManager())
                            <li id="{{ route('eleves.carte', $data->id) }}"
                                class="btn-carte cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                                <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    role="tab" aria-selected="false">
                                    <i class="fa fa-solid fa-id-card"></i>
                                    <span class="ml-2">Carte D'Eleve</span>
                                </a>
                            </li>
                            <li
                                class="btn-identity cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                                <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    role="tab" aria-selected="false">
                                    <i class="fa fa-solid fa-id-card"></i>
                                    <span class="ml-2">Identité Complete</span>
                                </a>
                            </li>
                            <li
                                class=" cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                                <a href="{{route('eleves.fiche.identite',$data->id)}}" class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    role="tab" aria-selected="false">
                                    <i class="fa fa-solid fa-id-card"></i>
                                    <span class="ml-2">Fiche d'Identité</span>
                                </a>
                            </li>
                        @endif

                        @if (!Auth::user()->isParent())
                            <li
                                class="btn-next cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                                <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    href="{{ route('eleves.show', $eleves->count() === $index + 1 ? $eleves[0]->id : $eleves[$index + 1]->id) }}"
                                    role="tab" aria-selected="false" title="Eleve Suivant">
                                    <span class="mr-2">Suivant</span>
                                    <i class="fa fa-solid fa-arrow-right"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif
            @if (isset($periode) || isset($trimestre))
                <div class="px-3 mx-auto mt-4 sm:my-auto sm:mr-0  md:flex-none">
                    <div class="relativeright-0">
                    </div>
                    <ul class="relative flex flex-wrap gap-2  list-none " role="tablist">
                        <li
                            class="btn-identity cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                            @if (isset($periode))
                                <span id="btn-show-fiche"
                                    href={{ route('resultat.periode', [$periode->id, $data->id]) }}
                                    class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    role="tab" aria-selected="false">
                                    <i class="fa fa-solid fa-table-list text-green-500"></i>
                                    <span class="ml-2">Fiche de Cote {{ $periode->nom }}</span>
                                </span>
                            @else
                                <span id="btn-show-fiche"
                                    href={{ route('resultat.trimestre', [$trimestre->id, $data->id]) }}
                                    class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    role="tab" aria-selected="false">
                                    <i class="fa fa-solid fa-table-list text-green-500"></i>
                                    <span class="ml-2">Fiche de Cote {{ $trimestre->nom }}</span>
                                </span>
                            @endif
                        </li>
                        <li
                            class="btn-identity cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                            @if (isset($periode))
                                <a href={{ route('resultat.periode', [$periode->id, $data->id]) }}
                                    class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    role="tab" aria-selected="false">
                                    <i class="fa fa-solid fa-table-list text-blue-700"></i>
                                    <span class="ml-2">Bulletin {{ $periode->nom }}</span>
                                </a>
                            @else
                                <a href={{ route('resultat.trimestre', [$trimestre->id, $data->id]) }}
                                    class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    role="tab" aria-selected="false">
                                    <i class="fa fa-solid fa-table-list text-blue-700"></i>
                                    <span class="ml-2">Bulletin {{ $trimestre->nom }}</span>
                                </a>
                            @endif
                        </li>

                    </ul>
                </div>
            @endif
            @if (isset($print) && $print === true)
                <div class="px-3 mx-auto mt-4 sm:my-auto sm:mr-0  md:flex-none">
                    <ul class="relative flex flex-wrap gap-2  list-none " role="tablist">

                        <li
                            class="btn-next cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                            <span id="joker-print"
                                class="z-30 flex items-center gap-2 justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700">
                                <i class="fa fa-solid fa-print text-blue-500"></i>
                                <span class="mr-2">Imprimer le Bulletin</span>
                            </span>
                        </li>

                        @if (!Auth::user()->isParent() && isset($index) && isset($eleves) && isset($annee))
                            <li
                                class="btn-next cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                                <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    href="{{ route('resultat.bulletin', [$annee->id, $eleves->count() === $index + 1 ? $eleves[0]->id : $eleves[$index + 1]->id]) }}"
                                    role="tab" aria-selected="false" title="Eleve Suivant">
                                    <span class="mr-2">Suivant</span>
                                    <i class="fa fa-solid fa-arrow-right"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>

<div id="pop-up"
    class="fixed hidden flex top-0 left-0 gap-2  justify-center items-center w-screen h-screen bg-slate-500 bg-opacity-30 z-100">
    <div class=" bg-white rounded-5 shadow-2xl container p-5  w-10/12 lg:w-7/12">
        <div class="flex flex-row justify-center items-center">
            <div class="flex  justify-end w-6/12">
                <span class="font-bold text-base text-center"> Photo de Profile </span>
            </div>
            <div class="flex justify-end w-6/12 btn-close-pop-up">
                <span
                    class="fa fa-solid fa-close text-5 self-start text-red-700 hover:text-white px-3 py-2 cursor-pointer rounded-full flex justify-center items-center hover:bg-red-700"></span>
            </div>
        </div>

        <form method="POST" action="{{ route('eleves.upload.profile') }}" enctype="multipart/form-data"
            class="p-2 gap-5 sm:gap-10 sm:p-5 flex sm:flex-row flex-col justify-center items-center">
            @method('POST')
            <div class="flex flex-col gap-2 md:p-5">
                <img id="profile-image" class="h-60 w-60 sm:h-80 sm:w-80 rounded-xl p-2 sm:p-5 shadow-xs"
                    src="{{ $data->avatar !== null ? asset('storage/' . $data->avatar) : ($data->sexe === 'M' ? asset('storage/avatar-boy.png') : asset('storage/avatar-girl.png')) }}"
                    alt="profile-image">
                <input type="hidden" name="eleve_id" value="{{ $data->id }}">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Auth::user()->isDirecteur() || Auth::user()->isSecretaire() || Auth::user()->isManager())
                    <x-button class="text-center  w-60 sm:w-80"><input type="file" name="image"
                            placeholder="Modifier" id="profile-image-input" accept="image/*"></x-button>
                @endif
            </div>
            @if (Auth::user()->isDirecteur() || Auth::user()->isSecretaire() || Auth::user()->isManager())
                <div id="btn-save" class="hidden h-full flex flex-col gap-2">
                    <x-button class="text-center">Enregistrer</x-button>
                    <x-button-annuler class="btn-close-pop-up text-center">Anuller</x-button-annuler>
                </div>
            @endif
            @csrf
        </form>
    </div>
</div>
