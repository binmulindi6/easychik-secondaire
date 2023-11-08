@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">

        <x-nav-classes :pagename="$page_name"></x-nav-classes>

        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == 'Niveaux / Edit' || $page_name == 'Niveaux / Create')
                <div class="frm-create bg-white rounded-5 shadow-2xl container p-5">
                @else
                    <div class="hidden frm-create bg-white rounded-5 shadow-2xl container p-5">
            @endif
            <div class="container">
                @if ($errors->any())
                    @foreach ($errors as $error)
                        <p class="font-bold text-red-500 text-xl">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
            @if (isset($self))
                <p class="font-bold text-base"> Modifier le Niveau </p>
                <form method="PUT" action="{{ route('niveaux.update', $self->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="nom" :value="__('Nom')" />
                        <select name="nom" id="nom"
                            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                            required>
                            <option hidden selected value="{{ $self->nom }}"> {{ $self->nom }} </option>
                            <option value="PREMIER ANNEE">PREMIER ANNEE</option>
                            <option value="DEUXIEME ANNEE">DEUXIEME ANNEE</option>
                            <option value="TROISIEME ANNEE">TROISIEME ANNEE</option>
                            <option value="QUATRIEME ANNEE">QUATRIEME ANNEE</option>
                            <option value="CINQUIEME ANNEE">CINQUIEME ANNEE</option>
                            <option value="SIXIEME ANNEE">SIXIEME ANNEE</option>
                            <option value="SEPTIEME ANNEE">SEPTIEME ANNEE</option>
                            <option value="HUITIEME ANNEE">HUITIEME ANNEE</option>
                            <option value="NEUVIEME ANNEE">NEUVIEME ANNEE</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <x-label for="nom" :value="__('Numerotation')" />
                        <x-input id="nom" class="block mt-1 w-full" type="number" name="numerotation"
                            placeholder="ex: 5" :value="$self->numerotation" required />
                    </div>
                    <div class="flex gap-10">
                        <div class="mt-4">
                            <x-button>Enregistrer</x-button>
                        </div>
                        <div class="mt-4">
                            <x-button-annuler type='reset' class="bg-red-500"></x-button-annuler>
                        </div>
                    </div>
                </form>
            @else
                <p class="font-bold text-base"> Ajouter in Niveau</p>
                <form method="POST" action="{{ route('niveaux.store') }}">
                    @method('POST')
                    @csrf
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="nom" :value="__('Nom')" />
                        <select name="nom" id="nom"
                            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                            required>
                            <option hidden selected disabled> Selectioner une Option</option>
                            <option value="PREMIER ANNEE">PREMIER ANNEE</option>
                            <option value="DEUXIEME ANNEE">DEUXIEME ANNEE</option>
                            <option value="TROISIEME ANNEE">TROISIEME ANNEE</option>
                            <option value="QUATRIEME ANNEE">QUATRIEME ANNEE</option>
                            <option value="CINQUIEME ANNEE">CINQUIEME ANNEE</option>
                            <option value="SIXIEME ANNEE">SIXIEME ANNEE</option>
                            <option value="SEPTIEME ANNEE">SEPTIEME ANNEE</option>
                            <option value="HUITIEME ANNEE">HUITIEME ANNEE</option>
                            <option value="NEUVIEME ANNEE">NEUVIEME ANNEE</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <x-label for="nom" :value="__('Numerotation')" />
                        <x-input id="nom" class="block mt-1 w-full" type="number" name="numerotation"
                            placeholder="ex: 5" :value="old('numerotation')" required />
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
        @if ($page_name == 'Niveaux / Edit' || $page_name == 'Niveaux / Create')
            <div class="hidden display bg-white shadow-2xl rounded-5 container p-5">
            @else
                <div class="display bg-white shadow-2xl rounded-5 container p-5">
        @endif

        <div class="p-2 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Niveaux </h6>
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
                            Numerotation</th>
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
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->numerotation }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  text-blue-500 underline">
                                    <div class="flex justify-center gap-4 align-middle">
                                        <a title="Modifier" href="{{ route('niveaux.edit', $item->id) }}"><i
                                                class="fa fa-solid fa-pen"></i></a>
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
