@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">

        <x-nav-classes :pagename="$page_name"></x-nav-classes>

        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == 'Categories Cours/Edit' || $page_name == 'Categories Cours/Create')
                <div class="frm-create bg-white rounded-5 shadow-2xl container p-5">
                @else
                    <div class="hidden frm-create bg-white rounded-5 shadow-2xl container p-5">
            @endif
            @if (isset($self))
                <p class="font-bold text-base"> Edit Categorie Cours </p>
                <form method="PUT" action="{{ route('categorie-cours.update', $self->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="nom" :value="__('Nom')" />

                        <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="$self->nom"
                            required />
                    </div>
                    <div class="mt-4">
                        <x-button>Enregistrer</x-button>
                    </div>
                </form>
            @else
                <p class="font-bold text-base"> Create Categorie Cours </p>
                <form method="POST" action="{{ route('categorie-cours.store') }}">
                    @method('POST')
                    @csrf
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="nom" :value="__('Nom')" />

                        <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')"
                            required />
                    </div>
                    <div class="mt-4">
                        <x-button>ajouter</x-button>
                    </div>
                </form>
            @endif
    </div>
    @endif
    @if (isset($items))
        @if ($page_name == 'Categories Cours/Edit' || $page_name == 'Categories Cours/Create')
            <div class="hidden display bg-white shadow-2xl rounded-5 container p-5">
            @else
                <div class="display bg-white shadow-2xl rounded-5 container p-5">
        @endif

        <div class="p-2 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Categories Cours</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="p-1 px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Nom</th>
                        <th
                            class="p-1 px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            action</th>
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            <tr class="">
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->nom }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  text-blue-500 underline">
                                    <div class="flex justify-center gap-4 align-middle">
                                        <a title="Modifier" href="{{ route('categorie-cours.edit', $item->id) }}"><i
                                                class="fa fa-solid fa-pen"></i></a>
                                        <form class="delete-form" action="{{ route('categorie-cours.destroy', $item->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Effacer" type="submit"><i
                                                    class="text-red-500 fa fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
    @endif
    </div>

@endsection
