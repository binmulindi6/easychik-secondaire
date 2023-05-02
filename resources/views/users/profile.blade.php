@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        <x-user-profile-header :data="$user" />
    <div class="frm-identity hidden bg-white container shadow-2xl rounded-5 p-5">
      <div class="container">
            @if ($errors->any())
                @foreach ($errors as $error)
                    <p class="font-bold text-red-500 text-xl">{{ $error }}</p>
                @endforeach
            @endif
        </div>
        @if (isset($self))
            <div class="flex items-center">
              {{-- <p class="mb-0 dark:text-white/80">Edit Profile</p> --}}
            <span class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Informations D'employé</span>
              <button type="button" class="btn-edit inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Modifier</button>
            </div>
            <form method="PUT" action="{{ route('employers.update', $self->id) }}">
                @csrf
                {{ method_field('PUT') }}
                <!-- Email Address -->
                <div class="flex flex-col md:flex-row md:gap-5">
                    <div class="mt-4 w-full">
                        <x-label for="matricule" :value="__('Matricule')" />
                        <x-input id="matricule" class="block mt-1 w-full" type="text" name="matricule"
                            :value="$self->matricule" required />
                    </div>
                    <div class="mt-4 w-full">
                        <x-label for="nom" :value="__('Nom et Post-Nom')" />
                        <x-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                            :value="$self->nom" required />
                    </div>
                </div>
                <div class="flex flex-col md:flex-row md:gap-5">
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
                <div class="flex flex-col md:flex-row md:gap-5">
                    <div class="mt-4 w-full">
                        <x-label for="date_naissance" :value="__('Date de Naissance')" />
                        <x-input id="date-naissance" class="block mt-1 w-full" type="date" name="date_naissance"
                            :value="$self->date_naissance" required />
                    {{-- </div>
                    <div class="mt-4 w-full"> --}}
                        {{-- <x-label for="formation" :value="__('Formation')" /> --}}
                        <x-input id="formation" class="block mt-1 w-full" type="hidden" name="formation"
                            :value="$self->formation" required />
                    </div>
                    
                </div>
                <div class="flex flex-col md:flex-row md:gap-5">
                    <div class="mt-4 w-full">
                        {{-- <x-label for="diplome" :value="__('Diplome')" /> --}}
                        <x-input id="diplome" class="block mt-1 w-full" type="hidden" name="diplome"
                            :value="$self->diplome" required />
                    </div>
                    <div class="mt-4 w-full">
                        {{-- <x-label for="niveau_etude" :value="__('Niveau d\'etude ')" /> --}}
                        <x-input id="niveau_etude" class="block mt-1 w-full" type="hidden" name="niveau_etude"
                            :value="$self->niveau_etude" required />
                    </div>
                </div>
                {{-- <div class="mt-4 w-full"> --}}
                    {{-- <x-label for="nom" :value="__('Fonction')" /> --}}
                    <input type="hidden" value={{$self->fonctions[0]}} name="fonction">
                    {{-- <x-select :hidden="true" :val="$self->fonctions[0]" :collection="$fonctions" class="block mt-1 w-full" name='fonction' required> </x-select> --}}
                {{-- </div> --}}
                <div class="flex gap-5">
                    <div class="btn-save mt-4 hidden">
                        <x-button>Enregistrer</x-button>
                    </div>
                    <!--div class="mt-4">
                                <x-button>Annuler</x-button>
                            </div-->

                </div>
            </form>
          @endif
        </div>
        <div class=" hidden w-full max-w-full shrink-0  md:flex-0">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <div class="flex items-center">
                  {{-- <p class="mb-0 dark:text-white/80">Edit Profile</p> --}}
                <span class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Information D'employé</span>
                  <button type="button" class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-size-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Modifier</button>
                </div>
              </div>
              <div class="flex-auto px-6">
                <div class="flex flex-wrap -mx-3">
                  <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                    <div class="mb-4">
                      <label for="username" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Matricule</label>
                      <input type="text" name="username" value="lucky.jesse" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                    </div>
                  </div>
                  <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                    <div class="mb-4">
                      <label for="email" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Nom</label>
                      <input type="text" name="username" value="lucky.jesse" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                      {{-- <input type="email" name="email" value="jesse@example.com" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" /> --}}
                    </div>
                  </div>
                  <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                    <div class="mb-4">
                      <label for="username" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Prenom</label>
                      <input type="text" name="username" value="lucky.jesse" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                    </div>
                  </div>
                  <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                    <div class="mb-4">
                      <label for="email" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Sexe</label>
                      <input type="text" name="username" value="lucky.jesse" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                      {{-- <input type="email" name="email" value="jesse@example.com" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" /> --}}
                    </div>
                  </div>
                  <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                    <div class="mb-4">
                      <label for="first name" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Lieu de Naissance</label>
                      <input type="text" name="first name" value="Jesse" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                    </div>
                  </div>
                  <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                    <div class="mb-4">
                      <label for="last name" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Date de Naissance</label>
                      <input type="text" name="last name" value="Lucky" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                    </div>
                  </div>
                </div>
                <hr class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
                
                <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Contact Information</p>
                <div class="flex flex-wrap -mx-3">
                  <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                    <div class="mb-4">
                      <label for="address" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Address</label>
                      <input type="text" name="address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                    </div>
                  </div>
                  <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                    <div class="mb-4">
                      <label for="city" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">City</label>
                      <input type="text" name="city" value="New York" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                    </div>
                  </div>
                  <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                    <div class="mb-4">
                      <label for="country" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Country</label>
                      <input type="text" name="country" value="United States" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                    </div>
                  </div>
                  <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                    <div class="mb-4">
                      <label for="postal code" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">Postal code</label>
                      <input type="text" name="postal code" value="437300" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                    </div>
                  </div>
                </div>
                <hr class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />

                <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">About me</p>
                <div class="flex flex-wrap -mx-3">
                  <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                    <div class="mb-4">
                      <label for="about me" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700 dark:text-white/80">About me</label>
                      <input type="text" name="about me" value="A beautiful Dashboard for Bootstrap 5. It is Free and Open Source." class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>


@endsection