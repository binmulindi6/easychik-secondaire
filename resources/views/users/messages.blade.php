@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">

        @if (isset($search))
            <x-nav-messages :search="$search" :pagename="$page_name">
                </x-nav-users>
            @else
                <x-nav-messages :pagename="$page_name">
                    </x-nav-users>
        @endif
        @if ($page_name == 'Messages / Compose')
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
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
            <div class="flex flex-col flex-between">
                <div class="mt-4 w-full">
                    <x-label for="matricule" :value="__('à')" />
                    @if (Auth::user()->isParent())
                        <x-input disabled id="objet" class="block mt-1 w-full" type="text" value="La Direction"
                            required autofocus />
                        <input type="hidden" name='destinateur' value="Direction" />
                    @else
                        @if (isset($to))
                            <x-select :only="'Parent'" :all="'Tout les Parents'" :val="$to" class="block mt-1 w-full"
                                name='destinateur' required> </x-select>
                        @else
                            <x-input disabled id="objet" class="block mt-1 w-full" type="text"
                                value="Tout les Parents" required autofocus />
                            <input type="hidden" name='destinateur' value="Parents" />
                        @endif
                    @endif
                </div>
                <div class="mt-4 w-full">
                    <x-label for="objet" :value="__('Objet')" />
                    <x-input id="objet" placeholder="l'objet de votre message" class="block mt-1 w-full" type="text"
                        name="objet" :value="old('Objet')" required autofocus />
                </div>
                <div class="mt-4 w-full">
                    <x-label for="classe" :value="__('Message:')" />
                    <x-text name="contenu" class="w-full" rows="5" placeholder="Votre Message ici..."></x-text>
                    {{-- <x-select  :collection="$classes" class="block mt-1 w-full" name='classe_id' required> </x-select> --}}
                </div>
            </div>
            <div class="flex gap-10">
                <div class="mt-4">
                    <x-button>Envoyer</x-button>
                </div>
                <div class="mt-4">
                    <x-button-annuler type='reset' class="bg-red-500"></x-button-annuler>
                </div>
            </div>
        </form>

    </div>

    @if (isset($items))
        @if ($page_name === 'Messages / Compose' || $page_name === 'Messages / Send Box' || $page_name === 'Messages / Show')
            <div class="display hidden container p-5 bg-white rounded-5 shadow-2xl">
            @else
                <div class="display container p-5 bg-white rounded-5 shadow-2xl">
        @endif

        <div class=" pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Messages Reçu</h6>
        </div>
        <div class="flex flex-col gap-2 overflow-scroll">
            @foreach ($items as $item)
                <a href="{{ route('messages.show', $item->id) }}">
                    @if ($item->from()->isDirecteur())
                        <x-message :state="$item->isReaden()" :from="'La Direction'" :object="$item->objet" :message="$item->contenu"
                            :time="$item->created_at"></x-message>
                    @else
                        <x-message :state="$item->isReaden()" :from="$item->from()->email" :object="$item->objet" :message="$item->contenu"
                            :time="$item->created_at"></x-message>
                    @endif
                </a>
            @endforeach

        </div>

        </div>
    @endif

    @if (isset($sents))
        @if (
            $page_name === 'Messages' ||
                $page_name === 'Messages / Send Box' ||
                $page_name === 'Messages / Show' ||
                $page_name === 'Messages / Compose')
            <div class="display-sent hidden container p-5 bg-white rounded-5 shadow-2xl">
            @else
                <div class="display container p-5 bg-white rounded-5 shadow-2xl">
        @endif

        <div class=" pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Messages Envoyés</h6>
        </div>
        <div class="flex flex-col gap-2 overflow-scroll">
            @foreach ($sents as $sent)
                <a href="{{ route('messages.show', $sent->id) }}">
                    <x-message :from="$sent->to()->email" :object="$sent->objet" :message="$sent->contenu" :time="$item->created_at"></x-message>
                </a>
            @endforeach

        </div>

        </div>
    @endif

    @if ($page_name === 'Messages / Show')
        <div class="show container p-5 bg-white rounded-5 shadow-2xl">
            <div class="flex flex-row w-full mr-5 justify-between pb-0 mb-0 bg-white rounded-t-2xl">
                @if ($message->from()->id === Auth::user()->id)
                    <h6>Message envoyé</h6>
                    <div class="flex flex-row gap-4 items-center">
                        <form class="delete-form " action="{{ route('messages.destroy', $message->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="effacer"><i
                                    class="text-red-500 fa fa-solid fa-trash hover:bg-slate-200 p-2 rounded-full"></i></button>
                        </form>
                        <span>{{ $message->created_at }}</span>
                    </div>
                @else
                    <h6>Message reçu</h6>
                    <span>{{ $message->created_at }}</span>
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
                            {{ $message->from()->parrain->nomComplet() }}
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
                            {{ $message->to()->parrain->nomComplet() }}
                        @endif
                    </span>
                @endif
                <span>
                    <span class="font-semibold">
                        Objet :
                    </span>
                    {{ $message->objet }}
                </span>
                <span class="font-semibold">
                    Contenu :
                </span>
                <span class="p-5 bg-zinc-100 rounded">
                    {{ $message->contenu }}
                </span>

                @if ($message->to()->id === Auth::user()->id)
                    @if ($message->to()->isDirecteur())
                        <a href="{{ route('messages.to', $message->from()->id) }}"
                            class=" mt-4 flex flex-row gap-2 items-center px-3 py-2 rounded-full border w-28 hover:bg-slate-100">
                            Repondre
                            <i class="fa fa-solid fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    @else
                        <span href=""
                            class=" btn-create mt-4 flex flex-row gap-2 items-center px-3 py-2 rounded-full border w-28 hover:bg-slate-100">
                            Repondre
                            <i class="fa fa-solid fa-arrow-right" aria-hidden="true"></i>
                        </span>
                    @endif
                @endif
            </div>

        </div>
    @endif


    </div>

@endsection
