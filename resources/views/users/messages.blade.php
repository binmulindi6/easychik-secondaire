@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">

        @if (isset($search))
            <x-nav-messages :search="$search" :pagename="$page_name"></x-nav-users>
        @else
            <x-nav-messages :pagename="$page_name"></x-nav-users>
        @endif
        @if ($page_name == 'Messages / Create')
        <div class="frm-create shadow-2xl container p-4 bg-white rounded-5">
            @else
            <div class="frm-create shadow-2xl hidden container p-4 bg-white rounded-5">
                @endif
                <span class="font-bold text-base"> Envoyer une Correspondance </span>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('messages.store') }}">
                    @csrf
                    {{ method_field('POST') }}
                    <!-- Email Address -->
                    <div class="flex flex-col flex-between">
                            <div class="mt-4 w-full">
                                <x-label for="matricule" :value="__('Destinateur')" />
                                @if (Auth::user()->isParent())   
                                    <x-input disabled id="objet" class="block mt-1 w-full" type="text"  value="La Direction" required autofocus />
                                    <input type="hidden" name='destinateur' value="Direction"/>
                                @else
                                    <x-input disabled id="objet" class="block mt-1 w-full" type="text"  value="Tout les Parents" required autofocus />
                                    <input type="hidden" name='destinateur' value="Parents"/>
                                    {{-- <x-select :collection="$users" class="block mt-1 w-full" name='user_id' required> </x-select> --}}
                                @endif
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="objet" :value="__('Objet')" />
                                <x-input id="objet" placeholder="l'objet de votre message" class="block mt-1 w-full" type="text" name="objet" :value="old('Objet')" required autofocus />
                            </div>
                        <div class="mt-4 w-full">
                            <x-label for="classe" :value="__('Message:')" />
                            <x-text name="contenu" class="w-full" rows="5" placeholder="Votre Message ici..."></x-text>
                            {{-- <x-select  :collection="$classes" class="block mt-1 w-full" name='classe_id' required> </x-select> --}}
                        </div>
                    </div>
                    <div class="flex gap-10">
                        <div class="mt-4">
                            <x-button type='submit'>Envoyé</x-button>
                        </div>
                        {{-- <div class="mt-4">
                            <x-button class="bg-red-500">annuler</x-button>
                        </div> --}}
                    </div>
                </form>
                    
            </div>

            @if (isset($items) )
                @if ($page_name === 'Messages / Compose' || $page_name === 'Messages / Send Box' || $page_name === 'Messages / Show')
                    <div class="display hidden container p-5 bg-white rounded-5 shadow-2xl">
                    @else
                        <div class="display container p-5 bg-white rounded-5 shadow-2xl">
                @endif

                    <div class=" pb-0 mb-0 bg-white rounded-t-2xl">
                        <h6>Messages Reçu</h6>
                    </div>
                    <div class="flex flex-col gap-2">
                        @foreach ($items as $item)
                            <a href="{{route('messages.show', $item->id)}}">
                                <x-message :state="$item->isReaden()" :from="$item->objet" :message="$item->contenu" :time="$item->created_at"></x-message>
                            </a>
                        @endforeach
                        
                    </div>

                </div>
            @endif

            @if (isset($sents) )
                @if ($page_name === 'Messages' || $page_name === 'Messages / Send Box' || $page_name === 'Messages / Show' || $page_name === 'Messages / Compose')
                    <div class="display-sent hidden container p-5 bg-white rounded-5 shadow-2xl">
                    @else
                        <div class="display container p-5 bg-white rounded-5 shadow-2xl">
                @endif

                    <div class=" pb-0 mb-0 bg-white rounded-t-2xl">
                        <h6>Messages Envoyés</h6>
                    </div>
                    <div class="flex flex-col gap-2">
                        @foreach ($sents as $sent)
                            <a href="{{route('messages.show', $sent->id)}}">
                                <x-message :from="$sent->objet" :message="$sent->contenu" :time="$item->created_at"></x-message>
                            </a>
                        @endforeach
                        
                    </div>

                </div>
            @endif

                @if ($page_name === 'Messages / Show')
                    <div class="show container p-5 bg-white rounded-5 shadow-2xl">
                    <div class=" pb-0 mb-0 bg-white rounded-t-2xl">
                        @if ($message->from() === Auth::user())
                        <h6>Message envoyé</h6>
                        @else
                        <h6>Message reçu</h6>
                        @endif
                    </div>
                    <div class="flex flex-col gap-1">
                        
                        @if ($message->to()->id === Auth::user()->id)
                            <span>
                                @if ($message->from()->isDirecteur())
                                    <span class="font-semibold">
                                        De : 
                                    </span>
                                    La Direction
                                @else
                                    <span class="font-semibold">
                                        Du Parent :
                                    </span>
                                    {{$message->from()->parrain->nomComplet()}}
                                @endif
                            </span>
                        @else
                            <span>
                                @if ($message->to()->isDirecteur())
                                    <span class="font-semibold">
                                        A : 
                                    </span>
                                    La Direction
                                @else
                                    <span class="font-semibold">
                                        Au Parent :
                                    </span>
                                    {{$message->to()->parrain->nomComplet()}}
                                @endif
                            </span>
                        @endif
                        <span>
                            <span class="font-semibold">
                                Objet :
                            </span>
                                {{$message->objet}}
                        </span>
                        <span class="font-semibold">
                            Contenu :
                        </span>
                        <span>
                            {{$message->contenu}}
                        </span>
                    </div>

                </div>
                @endif

           
    </div>

@endsection