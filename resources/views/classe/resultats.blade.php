@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        <x-classe-profile-header :data="$classe" :print="true"/>
    <div class="frm-identity hidden bg-white container shadow-2xl rounded-5 p-5">
      <div class="container">
            @if ($errors->any())
                @foreach ($errors as $error)
                    <p class="font-bold text-red-500 text-xl">{{ $error }}</p>
                @endforeach
            @endif
        </div>
        </div>
        <div class=" flex flex-row w-full justify-between gap-5">

          {{-- @if($item->classe() && $item->currentFrequentation() && $item->currentFrequentation()->annee_scolaire->id === $annee_scolaire->id ) --}}
          <div  class="shadow-2xl relative bg-white rounded-5 p-5 w-full  z-20">
              <div id="printable" class="flex flex-col px-0 pt-0 ">
                      <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <caption class="text-center font-bold text-base uppercase"> Resultats 
                            @if (isset($periode))
                                {{ $periode->nom . " " . $periode->trimestre->nom . " " . "annee scolaire " .$annee_scolaire->nom }} 
                            @else
                                @if (isset($trimestre))
                                {{ $trimestre->nom . " " . "annee scolaire " . $annee_scolaire->nom }} 
                                @else
                                {{ "annee scolaire ".$annee_scolaire->nom }} 
                                @endif
                            @endif
                        </caption>
                        <caption class="font-bold pb-4 text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-base border-b-solid tracking-none whitespace-nowrap text-slate-500">
                                classe de {{ $classe->nomComplet()}}
                        </caption>
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