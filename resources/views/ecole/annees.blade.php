@extends('layouts.admin')

@section('content')

    <div class=" container flex flex-col justify-between gap-5" >
        <x-nav-ecole :pagename="($page_name)"></x-nav-ecole>

        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == "Annees Scolaires/Edit")
                <div class=" frm-create  container bg-white shadow-2xl rounded-5 p-5">
            @else
                <div class=" frm-create hidden container bg-white shadow-2xl rounded-5 p-5">
            @endif
                @if (isset($self))
                    <p class="font-bold text-base"> Edit Annees Scolaire </p>
                    <form method="PUT" action="{{ route('annee-scolaires.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="($self->nom)" required />
                        </div>
                        <div class="flex gap-5">
                            <div class="mt-4 w-full">
                                <x-label for="date_debut" :value="__('Nom')" />
                                <x-input id="date_debu" class="block mt-1 w-full" type="date" name="date_debut" :value="($self->date_debut)" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="date_fin" :value="__('Nom')" />
                                <x-input id="date_fin" class="block mt-1 w-full" type="date" name="date_fin" :value="($self->date_fin)" required />
                            </div>
                        </div>
                        <div class="flex gap-10">
                            <div class="mt-4">
                                <x-button>Enregistrer</x-button>
                            </div>
                            <div class="mt-4">
                                <x-button class="bg-red-500">ajouter</x-button>
                            </div>
                        </div>
                    </form>
                @else
                    <p class="font-bold text-base"> Create Annees Scolaire </p>
                    <form method="POST" action="{{ route('annee-scolaires.store') }}">
                        @method('POST')
                        @csrf
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required />
                        </div>
                        <div class="flex gap-5">
                            <div class="mt-4 w-full">
                                <x-label for="date_debut" :value="__('Date Debut')" />
                                <x-input id="date_debut" class="block mt-1 w-full" type="date" name="date_debut" :value="old('date_debut')" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="date_fin" :value="__('Date Fin')" />
                                <x-input id="date_fin" class="block mt-1 w-full" type="date" name="date_fin" :value="old('date_fin')" required />
                            </div>
                        </div>
                        <div class="flex gap-10">
                            <div class="mt-4">
                                <x-button>ajouter</x-button>
                            </div>
                            <div class="mt-4">
                                <x-button class="bg-red-500">annuler</x-button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        @endif
        @if (isset($items))
        @if ($page_name == "Annees Scolaires/Edit")    
        <div class="display hidden container p-5 bg-white rounded-5 shadow-2xl">
        @else
            <div class="display container p-5 bg-white rounded-5 shadow-2xl">
        @endif

                @if ($errors->any())
                    @foreach ($errors as $item)
                        <p class="text-2xl text-red-500"> {{$item}} </p>
                    @endforeach
                @endif
            
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Annees Scolaires</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nom</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Date Debut</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Date Fin</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">action</th>
                            
                            </thead>
                            <tbody>
                            
                                    @foreach ($items as $item)
                                        <tr class="">
                                            <td class="p-1text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">{{$item->nom}}</td>
                                            <td class="p-1text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">{{$item->date_debut}}</td>
                                            <td class="p-1text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">{{$item->date_fin}}</td>
                                            <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                                <div class="flex justify-center gap-4 align-middle">
                                                    <a href="{{ route('annee-scolaires.edit',$item->id) }}"><i class="fa fa-solid fa-pen"></i></a>
                                                    <form action="{{ route('annee-scolaires.destroy',$item->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"><i class="text-red-500 fa fa-solid fa-trash"></i></button>
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