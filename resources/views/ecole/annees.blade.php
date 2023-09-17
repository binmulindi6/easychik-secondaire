@extends('layouts.admin')

@section('content')

    <div class=" sm-max:p-2 sm:container flex flex-col justify-between gap-5">
        @if (isset($search))
            <x-nav-ecole :search="$search" :pagename="$page_name"></x-nav-ecole>
        @else
            <x-nav-ecole :pagename="$page_name"></x-nav-ecole>
        @endif

        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == 'Annees Scolaires / Create' || $page_name == 'Annees Scolaires / Edit')
                <div class=" frm-create  container bg-white shadow-2xl rounded-5 p-5">
                @else
                    <div class=" frm-create hidden container bg-white shadow-2xl rounded-5 p-5">
            @endif
            @if (isset($self))
                <p class="font-bold text-base"> Modifier Annees Scolaire </p>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="PUT" action="{{ route('annee-scolaires.update', $self->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="nom" :value="__('Nom')" />
                        <select name="nom" id="nom"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                                required>
                                <option  selected value="{{$self->nom}}"> {{$self->nom}} </option>
                                @foreach ($annees as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="flex gap-5">
                        <div class="mt-4 w-full">
                            <x-label for="date_debut" :value="__('Nom')" />
                            <x-input id="date_debu" class="block mt-1 w-full" type="date" name="date_debut"
                                :value="$self->date_debut" required />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="date_fin" :value="__('Nom')" />
                            <x-input id="date_fin" class="block mt-1 w-full" type="date" name="date_fin"
                                :value="$self->date_fin" required />
                        </div>
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
                <p class="font-bold text-base"> Create Annees Scolaire </p>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('annee-scolaires.store') }}">
                    @method('POST')
                    @csrf
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="nom" :value="__('Nom')" />
                        <select name="nom" id="nom"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                                required>
                                <option disabled selected> Choisir le nom de L'Annee Scolaire </option>
                                @foreach ($annees as $item)
                                <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="flex gap-5">
                        <div class="mt-4 w-full">
                            <x-label for="date_debut" :value="__('Date Debut')" />
                            <x-input id="date_debut" class="block mt-1 w-full" type="date" name="date_debut"
                                :value="old('date_debut')" required />
                        </div>
                        <div class="mt-4 w-full">
                            <x-label for="date_fin" :value="__('Date Fin')" />
                            <x-input id="date_fin" class="block mt-1 w-full" type="date" name="date_fin"
                                :value="old('date_fin')" required />
                        </div>
                    </div>
                    <div class="flex gap-10">
                        <div class="mt-4">
                            <x-button>ajouter</x-button>
                        </div>
                        <div class="mt-4">
                            <x-button-annuler type='reset' class="bg-red-500"></x-button-annuler>
                        </div>
                    </div>
                </form>
            @endif
    </div>
    @endif
    @if (isset($items))
        @if ($page_name == 'Annees Scolaires / Edit' || $page_name == 'Annees Scolaires / Create')
            <div class="display hidden container p-5 bg-white rounded-5 shadow-2xl">
            @else
                <div class="display container p-5 bg-white rounded-5 shadow-2xl">
        @endif

        @if ($errors->any())
            @foreach ($errors as $item)
                <p class="text-2xl text-red-500"> {{ $item }} </p>
            @endforeach
        @endif

        <div class="p-2 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Annees Scolaires</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Nom</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Date Debut</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            Date Fin</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap ">
                            action</th>

                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            <tr class="">
                                <td
                                    class="p-1text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                    {{ $item->nom }}</td>
                                <td
                                    class="p-1text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                    {{ $item->date_debut }}</td>
                                <td
                                    class="p-1text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                    {{ $item->date_fin }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                    <div class="flex justify-center gap-4 align-middle">
                                        <a href="{{ route('annee-scolaires.edit', $item->id) }}"><i
                                                class="fa fa-solid fa-pen"></i></a>
                                        <form class="delete-form" action="{{ route('annee-scolaires.destroy', $item->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"><i
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

        </div>
    @endif
    </div>

@endsection
