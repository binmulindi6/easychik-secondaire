@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">

        <x-nav-employers :pagename="$page_name"></x-nav-employers>

        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == 'Fonctions/Create' || $page_name == 'Fonctions/Edit')
            <div class="frm-create container bg-white shadow-2xl rounded-5 p-5">
            @else
                <div class="frm-create hidden container bg-white shadow-2xl rounded-5 p-5">
            @endif
                @if (isset($self))
                    <p class="font-bold text-base"> Edit Fonction </p>
                    <form method="PUT" action="{{ route('fonctions.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom')" />

                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="$self->nom"
                                required />
                        </div>
                        <div class="flex gap-10">
                            <div class="mt-4">
                                <x-button>Enregistrer</x-button>
                            </div>
                            <div class="mt-4">
                                <x-button-annuler :back="true" type='reset' class="bg-red-500"></x-button-annuler>
                            </div>
    
                        </div>
                    </form>
                @else
                    <p class="font-bold text-base"> Create Fonction </p>
                    <form method="POST" action="{{ route('fonctions.store') }}">
                        @method('POST')
                        @csrf
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom')" />

                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                                :value="old('nom')" required />
                        </div>
                        <div class="flex gap-10">
                            <div class="mt-4">
                                <x-button>Ajouter</x-button>
                            </div>
                            <div class="mt-4">
                                <x-button-annuler :back="true" type='reset' class="bg-red-500"></x-button-annuler>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        @endif
        @if (isset($items))
        @if ($page_name == 'Fonctions/Create' || $page_name == 'Fonctions/Edit')
            <div class="display hidden container p-5 bg-white rounded-5 shadow-2xl">
        @else
            <div class="display container p-5 bg-white rounded-5 shadow-2xl">
        @endif
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class=" flex justify-between pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Fonctions</h6>
            </div>
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                            Nom</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                            action</th>
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            <tr class="">
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->nom }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                    <div class="flex justify-center gap-4 align-middle">
                                        <a href="{{ route('fonctions.edit', $item->id) }}"><i
                                                class="fa fa-solid fa-pen"></i></a>
                                        <form class="delete-form" action="{{ route('fonctions.destroy', $item->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"><i
                                                    class=" text-red-500 fa fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        </div>
        @endif
    </div>

@endsection
