@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">

        @if (isset($search))
            <x-nav-items :search="$search" :pagename="$page_name"> </x-nav-items>
        @else
            <x-nav-items :pagename="$page_name"> </x-nav-items>
        @endif


        @if (
            $page_name == 'Sorties / Edit' ||
                $page_name == 'Sorties / Create' ||
                $page_name == 'Sorties / Link' ||
                $errors->any())
            <div class="frm-create shadow-2xl relative  bg-white rounded-2xl p-5 w-full  z-20">
            @else
                <div class="frm-create shadow-2xl relative hidden  bg-white rounded-2xl p-5 w-full  z-20">
        @endif
        @if (isset($self))
            <span class="font-bold text-base"> Motifier Article </span>
            <x-errors class="mb-4" :errors="$errors" />

            <form method="GET" action="{{ route('sorties.show', $self->id) }}">
                @csrf
                {{ method_field('PUT') }}
                <!-- Email Address -->
                <div class="mt-4 w-full">
                    <x-label for="category" :value="__('Numero de Serie')" />

                    <x-input id="serial-number" class="block mt-1 w-full" type="text" name="num_serie" :value="$self->num_serie"
                        required autofocus />
                </div>

                <div class="flex justify-between gap-4 max-lg:flex-col max">
                    <div class="mt-4 w-full">
                        <x-label for="name" :value="__('Nom Article')" />

                        <x-input id="name" class="block mt-1 w-full" type="text" name="nom" :value="$self->nom"
                            required autofocus />
                    </div>
                    <div class="mt-4 w-full">
                        <x-label for="name" :value="__('Category')" />

                        <x-select :val="$self->categorie_article->nom" :collection="$categories" class="block mt-1 w-full" name='category' required>
                        </x-select>
                    </div>
                </div>

                <div class="flex justify-between gap-4 smsm-max:flex-col">
                    {{-- <div class="mt-4 w-full">
                            <x-label for="quantity" :value="__('Quantity')" />

                            <x-input id="quantity" class="block mt-1 w-full" type="number" name="quantite"
                                :value="$self->quantite" required autofocus />
                        </div> --}}
                    <div class="mt-4 w-full">
                        <x-label for="unit" :value="__('Unit')" />

                        <x-select :val="$self->unite_article->nom" :collection="$units" class="block mt-1 w-full" name='unite' required>
                        </x-select>
                    </div>
                </div>

                <div class="mt-4">
                    <x-button>Save</x-button>
                </div>
            </form>
        @else
            <span class="font-bold text-base"> Enregistrer une Sortie en Stock </span>
            <x-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('sorties.store') }}">
                @method('POST')
                @csrf
                <!-- Email Address -->

                <div class="flex justify-between gap-4 max-lg:flex-col max">
                    <div class="mt-4 w-full">
                        <x-label for="name" :value="__('L\'Article')" />

                        @if (isset($article))
                            <x-input id="quantity" class="block mt-1 w-full" type="text" value='{{ $article->nom }}'
                                readonly />
                            <input type="hidden" name='article' value="{{ $article->id }}">
                        @else
                            <x-select :collection="$articles" class="block mt-1 w-full" name='article' required> </x-select>
                        @endif
                    </div>
                    <div class="mt-4 w-full">
                        <x-label for="quantity" :value="__('Quantité')" />
                        @if (isset($article))
                        <x-input id="quantity" class="block mt-1 w-full" type="number"  min='1' max="{{$article->stock()}}" name="quantite" :value="old('quantite')"
                            value='1' placeholder="ex: 10 ou 20" required autofocus />
                            @else
                            <x-input id="quantity" class="block mt-1 w-full" type="number" min='1'  name="quantite" :value="old('quantite')"
                                value='0' placeholder="ex: 10 ou 0" required autofocus />

                            @endif
                    </div>

                </div>

                <div class="flex justify-between gap-4 smsm-max:flex-col">
                    <div class="mt-4 w-full">
                        <x-label for="unit" :value="__('Designation')" />

                        <x-input id="quantity" class="block mt-1 w-full" type="text" name="designation"
                            :value="old('designation')" placeholder="Achat materiel de bureau" required autofocus />
                    </div>
                    <div class="mt-4 w-full">
                        <x-label for="unit" :value="__('Date')" />
                        @php
                            $today = date('Y-m-d');
                        @endphp
                        <x-input id="quantity" class="block mt-1 w-full" type="date" name="date" max="{{$today}}"
                            :value="old('date')" placeholder="Affectation materiels de bureau" required autofocus />
                    </div>
                </div>

                <div class="mt-4">
                    <x-button>Enregistrer la sortie</x-button>
                </div>


            </form>
            {{-- @endif
        @endif --}}
    </div>
    @endif



    @if (
        $page_name == 'Sorties / Edit' ||
            $page_name == 'Sorties / Create' ||
            $page_name == 'Sorties / Link' ||
            $errors->any())
        <div class="display hidden container p-5 bg-white rounded-2xl shadow-2xl">
        @else
            <div class="display container p-5 bg-white rounded-2xl shadow-2xl">
    @endif
    @if (isset($items) && $items->count() > 0)
        <div class="p-4 pb-0 mb-0 bg-white rounded-t-2xl">
            <p class="font-bold text-xl">Les Sorties des Materiels</p>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Article </th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            designation</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Quatité</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Date</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Action</th>
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            <tr class="">
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->article->nom }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->designation }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->quantite }}</td>
                                {{-- <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">{{$item->quantity}}</td> --}}
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->date }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                    <div class="flex justify-center gap-4 align-middle">
                                        <a title="edit" href="{{ route('sorties.edit', $item->id) }}"><i
                                                class="fa fa-solid fa-pen"></i></a>
                                        <form action="{{ route('sorties.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="delete"><i
                                                    class="text-red-500 fa fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="p5">
            <div class=" pb-0 mb-0 bg-white rounded-t-2xl">
                <p class="font-bold text-xl">Items</p>
            </div>
            <p class="text-red-500 font-bold text-2xl text-center">Pas des Données</p>
        </div>
    @endif
    </div>
    </div>
    </div>
@endsection
