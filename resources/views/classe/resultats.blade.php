@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        <x-classe-profile-header :data="$classe" />
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
        <div class=" flex flex-row w-full justify-between gap-5">

          {{-- @if($item->classe() && $item->currentFrequentation() && $item->currentFrequentation()->annee_scolaire->id === $annee_scolaire->id ) --}}
          <div  class="shadow-2xl relative bg-white rounded-5 p-5 w-full  z-20">
              <div id="printable" class="flex flex-col px-0 pt-0 ">
                  <p class="text-center font-bold text-base uppercase"> Resultats 
                    @if (isset($periode))
                        {{ $periode->nom . " " . $periode->trimestre->nom . " " . "annee scolaire " .$annee_scolaire->nom }} 
                    @else
                        @if (isset($trimestre))
                        {{ $trimestre->nom . " " . "annee scolaire " . $annee_scolaire->nom }} 
                        @else
                        {{ "annee scolaire ".$annee_scolaire->nom }} 
                        @endif
                    @endif
                </p>
                      <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                          <thead class="align-bottom">
                              <th
                                  class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                  Place
                              </th>
                              <th
                                  class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                 ELEVE
                              </th>
                              <th
                                  class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                  Pourcentage
                              </th>
                          </thead>
                          <tbody>

                              @foreach ($data as $index => $resultat)
                                  <tr class=" rounded-2xl hover:bg-slate-100 cursor-pointer">
                                      <td
                                          class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                          {{ $index+1 }}
                                      </td>
                                      <td
                                          class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                          <a href="{{ route('eleves.show', $resultat['id']) }}">
                                              {{ $resultat['eleve'] }}
                                          </a>
                                      </td>
                                      <td
                                          class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent hover:text-blue-500  ">
                                          <span>{{ $resultat['resultat'] }} %</span>  
                                          
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
              </div>
              </div>
          {{-- @endif --}}
      </div>
    </div>



@endsection