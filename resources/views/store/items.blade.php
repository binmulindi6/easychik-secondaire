@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">

        @if (isset($search))
            <x-nav-items :search="$search" :pagename="$page_name"> </x-nav-items>
        @else
            <x-nav-items :pagename="$page_name"> </x-nav-items>
        @endif

        @if (!isset($isLink))
            @if ($page_name == 'Articles / Edit' || $page_name == 'Articles / Create' || $errors->any())
                <div class="frm-create shadow-2xl relative  bg-white rounded-2xl p-5 w-full  z-20">
                @else
                    <div class="frm-create shadow-2xl relative hidden  bg-white rounded-2xl p-5 w-full  z-20">
            @endif
            @if (isset($self))
                <span class="font-bold text-base"> Motifier Article </span>
                <x-errors class="mb-4" :errors="$errors" />

                <form method="GET" action="{{ route('articles.show', $self->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Email Address -->
                    <div class="mt-4 w-full">
                        <x-label for="category" :value="__('Numero de Serie')" />

                        <x-input id="serial-number" readonly class="block mt-1 w-full" type="text" name="num_serie"
                            :value="$self->num_serie" required autofocus />
                    </div>

                    <div class="flex justify-between gap-4 max-lg:flex-col max">
                        <div class="mt-4 w-full">
                            <x-label for="name" :value="__('Nom Article')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="nom"
                                :value="$self->nom" required autofocus />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="name" :value="__('Categorie Article')" />

                            <x-select :linkName="'Nouvelle Categorie'" :isSelectedLink="'cat-art'" :val="$self->categorie_article->nom" :collection="$categories" class="block mt-1 w-full" name='categorie'
                                required> </x-select>
                        </div>
                    </div>

                    <div class="flex justify-between gap-4 smsm-max:flex-col">
                        {{-- <div class="mt-4 w-full">
                            <x-label for="quantity" :value="__('Quantity')" />

                            <x-input id="quantity" class="block mt-1 w-full" type="number" name="quantite"
                                :value="$self->quantite" required autofocus />
                        </div> --}}
                        <div class="mt-4 w-full">
                            <x-label for="unit" :value="__('Unité de Mesure de L\'Article')" />

                            <x-select :linkName="'Nouvelle Unité'" :isSelectedLink="'unit-art'" :val="$self->unite_article->nom" :collection="$units" class="block mt-1 w-full" name='unite'
                                required> </x-select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-button>Enregistrer</x-button>
                    </div>
                </form>
            @else
                <span class="font-bold text-base"> Ajouter un Article au Stock </span>
                <x-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('articles.store') }}">
                    @method('POST')
                    @csrf
                    <!-- Email Address -->
                    <!-- Email Address -->

                    <div class="flex justify-between gap-4 max-lg:flex-col max">
                        <div class="mt-4 w-full">
                            <x-label for="name" :value="__('Numero de Serie')" />

                            <x-input id="serial-number" class="block mt-1 w-full" type="text" name="num_serie"
                                :value="old('num_serie')" required autofocus />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="name" :value="__('Nom Article')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="nom"
                                :value="old('nom')" required autofocus />
                        </div>

                    </div>

                    <div class="flex justify-between gap-4 smsm-max:flex-col">
                        {{-- <div class="mt-4 w-full">
                            <x-label for="quantity" :value="__('Quantité Initiale')" />

                            <x-input id="quantity" class="block mt-1 w-full" type="number" name="quantite"
                                :value="old('quantite')" value='0' placeholder="ex: 10 ou 0" required autofocus />
                        </div> --}}
                        <div class="mt-4 w-full">
                            <x-label for="category" :value="__('Categorie Article')" />

                            <x-select :linkName="'Nouvelle Categorie'" :isSelectedLink="'cat-art'" :collection="$categories" class="block mt-1 w-full" name='categorie' required> </x-select>
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="unit" :value="__('Unite de Mesure')" />

                            <x-select :linkName="'Nouvelle Unité'" :isSelectedLink="'unit-art'"  :collection="$units" class="block mt-1 w-full" name='unite' required> </x-select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-button>Ajouter L'Article</x-button>
                    </div>


                </form>
            @endif
    </div>
    @endif
    <x-add-categorie :theId="'cat-art'" :title="'Ajouter Une Categorie D\'Articles'" :link="route('categorie-articles.store')"> </x-add-categorie>
    <x-add-categorie :theId="'unit-art'" :title="'Ajouter Une Unité de Mesure de L\'Articles'" :link="route('unite-articles.store')" :datas="['abbreviation' => 'Abbreviation ex : Pcs']"> </x-add-categorie>



    @if ($page_name == 'Articles / Edit' || $page_name == 'Articles / Create' || $errors->any())
        <div class="display hidden container p-5 bg-white rounded-2xl shadow-2xl">
        @else
            <div class="display container p-5 bg-white rounded-2xl shadow-2xl">
    @endif
    @if (isset($items) && $items->count() > 0)
        <div class="p-4 pb-0 mb-0 bg-white rounded-t-2xl">
            @if (isset($isLink))
                <span class="font-bold text-xl">Choisir un Article</span>
            @else
                <span class="font-bold text-xl">Les Materiels</span>
            @endif
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            No Serie </th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Nom </th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Categorie </th>
                        {{-- <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Quantity</th> --}}

                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            En Stock</th>
                        @if (!isset($isLink))
                            <th
                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Action</th>
                        @endif
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            @if (isset($isLink) && $item->stock() > 0)
                                <tr class="">
                                    @if (!isset($isLink))
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                            {{ $item->num_serie }}</td>
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                            {{ $item->nom }}</td>
                                    @else
                                        @if (isset($isSortie))
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                                <a href="{{ route('sorties.link.article', $item->id) }}"
                                                    class="hover:font-semibold hover:text-blue-600">{{ $item->num_serie }}
                                                </a>
                                            </td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                                <a href="{{ route('sorties.link.article', $item->id) }}"
                                                    class="hover:font-semibold hover:text-blue-600">{{ $item->nom }} </a>
                                            </td>
                                        @else
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                                <a href="{{ route('entrees.link.article', $item->id) }}"
                                                    class="hover:font-semibold hover:text-blue-600">{{ $item->num_serie }}
                                                </a>
                                            </td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                                <a href="{{ route('entrees.link.article', $item->id) }}"
                                                    class="hover:font-semibold hover:text-blue-600">{{ $item->nom }}
                                                </a>
                                            </td>
                                        @endif
                                    @endif
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                        {{ $item->categorie_article->nom }}</td>
                                    {{-- <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">{{$item->quantity}}</td> --}}
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                        {{ $item->stock() . ' ' . $item->unite_article->abbreviation }}</td>
                                    @if (!isset($isLink))
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                            <div class="flex justify-center gap-4 align-middle">
                                                <a title="edit" href="{{ route('articles.edit', $item->id) }}"><i
                                                        class="fa fa-solid fa-pen"></i></a>
                                                <form action="{{ route('articles.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="delete"><i
                                                            class="text-red-500 fa fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @else
                                <tr class="">
                                    @if (!isset($isLink))
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                            {{ $item->num_serie }}</td>
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                            {{ $item->nom }}</td>
                                    @else
                                        @if (isset($isSortie))
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                                <a href="{{ route('sorties.link.article', $item->id) }}"
                                                    class="hover:font-semibold hover:text-blue-600">{{ $item->num_serie }}
                                                </a>
                                            </td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                                <a href="{{ route('sorties.link.article', $item->id) }}"
                                                    class="hover:font-semibold hover:text-blue-600">{{ $item->nom }}
                                                </a>
                                            </td>
                                        @else
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                                <a href="{{ route('entrees.link.article', $item->id) }}"
                                                    class="hover:font-semibold hover:text-blue-600">{{ $item->num_serie }}
                                                </a>
                                            </td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                                <a href="{{ route('entrees.link.article', $item->id) }}"
                                                    class="hover:font-semibold hover:text-blue-600">{{ $item->nom }}
                                                </a>
                                            </td>
                                        @endif
                                    @endif
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                        {{ $item->categorie_article->nom }}</td>
                                    {{-- <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">{{$item->quantity}}</td> --}}
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                        {{ $item->stock() . ' ' . $item->unite_article->abbreviation }}</td>
                                    @if (!isset($isLink))
                                        <td
                                            class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                            <div class="flex justify-center gap-4 align-middle">
                                                <a title="edit" href="{{ route('articles.edit', $item->id) }}"><i
                                                        class="fa fa-solid fa-pen"></i></a>
                                                <form action="{{ route('articles.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="delete"><i
                                                            class="text-red-500 fa fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endif
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
            <p class="text-red-500 font-bold text-2xl text-center">Aucun Article en Stock</p>
        </div>
    @endif
    </div>
    </div>
    </div>

@endsection
