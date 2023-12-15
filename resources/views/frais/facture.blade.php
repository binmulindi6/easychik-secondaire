@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">

        @if (isset($search))
            <x-nav-frais :search="$search" :pagename="$page_name"></x-nav-frais>
        @else
            <x-nav-frais :pagename="$page_name"></x-nav-frais>
        @endif

        @if (isset($self))
            <div id="bulletin" class="display flex justify-center shadow-2xl p-4 bg-white rounded-5">

                <div id="printable" class="flex min-h-80 h-80 flex-row items-center w-full border">
                    <div class="flex w-28 h-full bg-blue-700 justify-start">

                    </div>
                    <div class="flex flex-col p-2 w-full h-full">
                        <div class="w-full px-5 flex flex-row justify-between items-center">
                            <div class="flex w-6/12 justify-center items-center">
                                <span class="block text-center uppercase font-semibold text-5">
                                    {{ $ecole ? $ecole->nom : env('APP_NAME') }}
                                </span>
                            </div>
                            <div class="flex w-4/12 justify-center items-center">
                                <span class="block text-center uppercase font-semibold text-5">
                                    REÇU <span>N°<span>{{'00' . $self->id . '/'. Auth::currentYear()->nom}}</span></span>
                                </span>
                            </div>
                            <div class="flex w-2/12 justify-center items-center">
                                {{-- <img class="h-16" src="{{asset('storage/favicon.png')}}" alt="" srcset=""> --}}
                            </div>
                        </div>
                        <div class="borer-b flex flex-col p-2">
                            <span class="w-full semibold text-justify pb-1 border-b border-dotted"> 
                                Nom de l'élève :  {{$self->frequentation->eleve->nomComplet()}}, Classe: {{$self->frequentation->classe->nomComplet()}}
                            </span>
                            <span class="semibold pb-1 border-b border-dotted">
                                Motif : {{$self->frais->nom . ' (' . $self->frais->type_frais->nom . ')'}},  Montant : {{$self->montant_paye . $self->frais->type_frais->devise}}
                            </span>
                            <span class="semibold pb-1 border-b border-dotted flex w-full"> 
                                @if ($self->moyen_paiement->nom == "BANQUE")
                                    
                                <span class="w-6/12">Déposer à :  LA {{$self->moyen_paiement->nom}}, Référence :  {{$self->reference}}</span>
                                @else
                                
                                <span class="w-6/12">Déposer à :  LA {{$self->moyen_paiement->nom}}</span>
                                @endif
                                <span class="w-6/12">Déposer Par :  {{$self->deposer_par}}</span>
                            </span>
                        </div>
                        <div class="flex flex-row w-full">
                            <div class="w-6/12 flex flex-col p-2">
                                {{-- <span class="font-semibold">Adresse: </span> --}}
                                <span class="font-semibold">{{$ecole->bp}}</span>
                                <span class="font-semibold">{{$ecole->email}}</span>
                                <span class="font-semibold">{{$ecole->telephone1 ." | ". $ecole->telephone2}}</span>
                            </div>
                            <div class="w-6/12 flex flex-col p-2">
                                <span class="border-b pb-2 w-full">
                                    @if ($self->user !== null)
                                    {{$self->user->employer->nomComplet()}}
                                    @endif
                                </span>
                                <span class="border-b pb-2 w-full">
                                    Date : {{date_format(date_create($self->date), 'd/m/Y')}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>

@endsection


<script defer>
    // const inputType = document.querySelector(".frm-create");
    // console.log(inputType);
    // inputType.addEventListener('onChange', ()=>{
    //     console.log(inputType.value);
    // });
</script>
