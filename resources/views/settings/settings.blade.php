@extends('layouts.admin')
@section('content')
    <div class=" container flex flex-col justify-between gap-5 h-full">

        <div
            class="flex flex-col justify-center items-center  gap-5 shadow-2xl relative bg-white rounded-5 p-5  w-full h-full">
            {{-- <div class="w-full bg-zinc-600/40 p-5 rounded-t-5 flex items-center justify-between">
                 <div class="h-30 w-30 absolute bottom-20 rounded-full bg-white">
                </div> t-semibold text-2xl">Parametres</span>
                <img src="{{asset('storage/shape1.svg')}}" class="h-40" alt="" srcset="">
            </div> --}}
            <div class="w-full">
                <div class="flex flex-row justify-between items-center pr-5">
                    <div>
                        <span class="font-semibold text-6 block text-slate-900">Parametres</span>
                        <span class="text-4 block ">Configurer le systeme suivant le besoin</span>
                    </div>
                    <i class="relative top-0 leading-normal text-slate-900 text-16 fa fa-solid fa-cog fa-spin"></i>
                </div>
                <hr class="h-px mb-0  bg-black/40 " />
            </div>
            <div class="flex flex-col gap-2 justify-center w-full">
                <div class="flex flex-col gap-1 pb-2 border-b">
                    <form action="{{ route('settings.store') }}" method="post"
                        class="flex items-center justify-between gap-2 w-full">
                        @csrf
                        <span class="font-semibold text-4 text-slate-700">Annee Scolaire en Cours : </span>
                        <div class="w-30 md:w-40  h-10 flex flex-row justify-end items-center gap-2">
                            <x-select :submitOnChage="true" :val="$current" :collection="$annees" class="block mt-1 w-full"
                                name='annee' required></x-select>
                            {{-- <x-button>choisir</x-button> --}}
                        </div>
                    </form>
                    <span class="text-3">Ici vous avez la possibilité de vous connecter à une <span
                            class="font-semibold">Annee Scolaire </span> anterieur pour pouvoir consulter les données de
                        celle-ci. </span>
                </div>
                <div class="flex flex-col gap-1 pb-2 border-b">
                    <form action="{{ route('logout') }}" method="post"
                        class="flex items-center justify-between gap-2 w-full">
                        @csrf
                        <span class="font-semibold text-4 text-slate-700">Se Deconnecter</span>
                        <div class="w-30 md:w-40  h-10 flex flex-row justify-end items-center gap-2">
                            {{-- <x-select :submitOnChage="true" :val="$current" :collection="$annees" class="block mt-1 w-full" name='annee' required></x-select> --}}
                            <button type="submit"
                                class="p-0 w-30 md:w-40  bg-red-500  hover:bg-blue-500  rounded-2 py-2 text-white font-semibold transition-all text-size-sm ease-nav-brand ">
                                <i fixed-plugin-button-nav class=" text-black fa fa-right-from-bracket" title="logout"></i>
                                <span class="hidden sm:inline">Deconnexion</span>
                            </button title="deconnexion">
                        </div>
                    </form>
                    <span class="text-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia tenetur iure
                        facere adipisci quasi dicta illo necessitatibus, molestias, a laudantium sint reprehenderit dolores
                        animi consequuntur nihil aut at ipsum numquam?</span>
                </div>
                @if (Auth::user()->isManager())
                    <div class="flex flex-col gap-1 pb-2 border-b">
                        <div class="flex items-center justify-between gap-2 w-full">
                            @csrf
                            <span class="font-semibold text-4 text-slate-700">Données de L'Etablissement</span>
                            <div class="w-30 md:w-40  h-10 flex flex-row justify-end items-center gap-2">
                                {{-- <x-select :submitOnChage="true" :val="$current" :collection="$annees" class="block mt-1 w-full" name='annee' required></x-select> --}}
                                <button type="submit"
                                    class="btn-identity p-0 w-30 md:w-40  bg-gray-900  hover:bg-blue-500  rounded-2 py-2 text-white font-semibold transition-all text-size-sm ease-nav-brand ">
                                    <i fixed-plugin-button-nav class=" text-white fa fa-pen" title="Derouler"></i>
                                    <span class="hidden sm:inline">Modifier</span>
                                </button title="deconnexion">
                            </div>
                        </div>

                        <div class="frm-identity hidden w-full flex justify-center">
                            <div
                                class="flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-10/12 ">
                                <div
                                    class="relative  flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border">
                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                    <div class=" p-2 md:pl-6 pt-2 pb-0 mb-0  w-full text-center">
                                        <h4 class="font-bold">Identification de L'établissement</h4>
                                    </div>
                                    <div class="flex-auto p-2 md:p-5">
                                        <form method="POST" action="{{ route('ecole.update') }}">
                                            @csrf
                                            <div
                                                class="flex flex-col md:flex-row justify-center items-center gap-2 md:gap-5">
                                                <div class=" mb-2 md:mb-4 w-full">
                                                    <x-label for="nom" :value="__('Le Nom de Votre Etablissement')" />
                                                    <x-input id="nom" class="block mt-1 w-full" type="text"
                                                        name="nom" :value="$ecole->nom" required
                                                        placeholder="ex: COMPLEXE SCOLAIRE ELITE" />
                                                </div>
                                                <div class=" mb-2 md:mb-4 w-full">
                                                    <x-label for="nom_ecole" :value="__('L\'abbreviation dU Nom de vore Etablissement')" />
                                                    <x-input id="abbreviation" class="block mt-1 w-full" type="text"
                                                        name="abbreviation" :value="$ecole->abbreviation" required
                                                        placeholder="ex: C.S ELITE" />
                                                </div>
                                            </div>
                                            <div
                                                class="flex flex-col md:flex-row justify-center items-center gap-2 md:gap-5">
                                                <div class=" mb-2 md:mb-4 w-full">
                                                    <x-label for="bp" :value="__('Boite Postale')" />
                                                    <x-input id="bp" class="block mt-1 w-full" type="text"
                                                        name="bp" :value="$ecole->bp" required
                                                        placeholder="ex: 253 / BUKAVU" />
                                                </div>
                                                <div class=" mb-2 md:mb-4 w-full">
                                                    <x-label for="reussite" :value="__('Condition de Réussite en Pourcentatge %')" />
                                                    <x-input id="reussite" class="block mt-1 w-full" type="number"
                                                        name="reussite" :value="$ecole->reussite" required placeholder="ex: 55%" />
                                                </div>
                                            </div>
                                            <div
                                                class="flex flex-col md:flex-row justify-center items-center gap-2 md:gap-5">
                                                <div class=" mb-2 md:mb-4 w-full">
                                                    <x-label for="code_ecole" :value="__('Le CODE de votre Etablissement')" />
                                                    <x-input id="code_ecole" class="block mt-1 w-full" type="text"
                                                        name="code" :value="$ecole->code" required
                                                        placeholder="ex: 2566888-B" />
                                                </div>
                                                <div class=" mb-2 md:mb-4 w-full">
                                                    <x-label for="pays" :value="__('Pays (en toutes lettres)')" />
                                                    <x-input id="pays" class="block mt-1 w-full" type="text"
                                                        name="pays" :value="$ecole->pays" required
                                                        placeholder="ex: REPUBLIQUE DEMOCRATIQUE DU CONGO" />
                                                </div>
                                            </div>
                                            <div
                                                class="flex flex-col md:flex-row justify-center items-center gap-2 md:gap-5">
                                                <div class=" mb-2 md:mb-4 w-full">
                                                    <x-label for="province" :value="__('Province')" />
                                                    <x-input id="province" class="block mt-1 w-full" type="text"
                                                        name="province" :value="$ecole->province" required
                                                        placeholder="ex: SUD-KIVU" />
                                                </div>
                                                <div class=" mb-2 md:mb-4 w-full">
                                                    <x-label for="ville" :value="__('Ville')" />
                                                    <x-input id="nom_pere" class="block mt-1 w-full" type="text"
                                                        name="ville" :value="$ecole->ville" required
                                                        placeholder="ex: BUKAVU" />
                                                </div>

                                            </div>
                                            <div
                                                class="flex flex-col md:flex-row justify-center items-center gap-2 md:gap-5">
                                                <div class=" mb-2 md:mb-4 w-full">
                                                    <x-label for="commune" :value="__('Commune ou Territoire')" />
                                                    <x-input id="commune" class="block mt-1 w-full" type="text"
                                                        name="commune" :value="$ecole->commune" required
                                                        placeholder="ex: IBANDA" />
                                                </div>
                                                <div class=" mb-2 md:mb-4 w-full">
                                                    <x-label for="ministere" :value="__('Le Nom du Ministere qui vous regie')" />
                                                    <x-input id="ministere" class="block mt-1 w-full" type="text"
                                                        name="ministere" :value="$ecole->ministere" required
                                                        placeholder="ex: MINISTERE DE L ENSEIGNEMENT PRIMAIRE, SECONDAIRE ET TECHNIQUE" />
                                                </div>
                                            </div>
                                            <div class=" mb-2 md:mb-4 w-full">
                                                <x-label for="email" :value="__('Email')" />
                                                <x-input id="email" class="block mt-1 w-full" type="text"
                                                    name="email" :value="$ecole->email" required
                                                    placeholder="ex: votreecole@gmail.com" />
                                            </div>
                                            <div
                                                class="flex flex-col md:flex-row justify-center items-center gap-2 md:gap-5">
                                                <div class=" mb-2 md:mb-4 w-full">
                                                    <x-label for="commune" :value="__('Telephone 1')" />
                                                    <x-input id="commune" class="block mt-1 w-full" type="text"
                                                        name="telephone1" :value="$ecole->telephone1" required
                                                        placeholder="ex: +2439900000000" />
                                                </div>
                                                <div class=" mb-2 md:mb-4 w-full">
                                                    <x-label for="ministere" :value="__('Telephone 2')" />
                                                    <x-input id="ministere" class="block mt-1 w-full" type="text"
                                                        name="telephone2" :value="$ecole->telephone2" required
                                                        placeholder="ex: ex: +2439900000000" />
                                                </div>
                                            </div>

                                            <button type="submit"
                                                class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-700 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">Enregistrer</button>

                                    </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
