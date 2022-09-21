@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5" >

        <x-nav-employers :pagename="$page_name"> </x-nav-employers>
        
        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == "Employers/Edit")    
            <div class="frm-create bg-white container shadow-2xl rounded-5 p-5">
            @else
                <div class="frm-create hidden bg-white container shadow-2xl rounded-5 p-5">
            @endif

                    <div class="container">
                        @if ($errors->any())
                            @foreach ($errors as $error)
                                <p class="font-bold text-red-500 text-xl">{{$error}}</p>
                            @endforeach
                        @endif
                    </div>
                @if (isset($self))
                    <p class="font-bold text-base"> Edit Employer </p>
                    <form method="PUT" action="{{ route('employers.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="flex gap-5">
                            <div class="mt-4 w-full">
                                <x-label for="matricule" :value="__('Matricule')" />
                                <x-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="($self->matricule)" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="nom" :value="__('Nom et Post-Nom')" />
                                <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="($self->nom)" required />
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="mt-4 w-full">
                                <x-label for="prenom" :value="__('Prenom')" />
                                <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="($self->prenom)" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="date_naissance" :value="__('Date de Naissance')" />
                                <x-input id="date-naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="($self->date_naissance)" required />
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="mt-4 w-full">
                                <x-label for="formation" :value="__('Formation')" />
                                <x-input id="formation" class="block mt-1 w-full" type="text" name="formation" :value="($self->formation)" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="diplome" :value="__('Diplome')" />
                                <x-input id="diplome" class="block mt-1 w-full" type="text" name="diplome" :value="($self->diplome)" required />
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="mt-4 w-full">
                                <x-label for="niveau_etude" :value="__('Niveau d\'etude ')" />
                                <x-input id="niveau_etude" class="block mt-1 w-full" type="text" name="niveau_etude" :value="($self->niveau_etude)" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="nom" :value="__('Fonction')" /> 
                                <x-select :val="$self->fonctions[0]" :collection="$fonctions" class="block mt-1 w-full" name='fonction' required> </x-select>
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="mt-4">
                                <x-button>Enregistrer</x-button>
                            </div>
                            <!--div class="mt-4">
                                <x-button>Annuler</x-button>
                            </div-->
                            
                        </div>
                    </form>
                @else
                    <p class="font-bold text-base"> Create Employer </p>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('employers.store') }}">
                        @method('POST')
                        @csrf
                        <!-- Email Address -->
                        <div class="flex gap-5">
                            <div class="mt-4 w-full">
                                <x-label for="matricule" :value="__('Matricule')" />
                                <x-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="($last_matricule)" required readonly/>
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="nom" :value="__('Nom et Post-Nom')" />
                                <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required />
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="mt-4 w-full">
                                <x-label for="prenom" :value="__('Prenom')" />
                                <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="date_naissance" :value="__('Date de Naissance')" />
                                <x-input id="date-naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="old('')" required />
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="mt-4 w-full">
                                <x-label for="formation" :value="__('Formation')" />
                                <x-input id="formation" class="block mt-1 w-full" type="text" name="formation" :value="old('formation')" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="diplome" :value="__('Diplome')" />
                                <x-input id="diplome" class="block mt-1 w-full" type="text" name="diplome" :value="old('diplome')" required />
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="mt-4 w-full">
                                <x-label for="niveau_etude" :value="__('Niveau d\'etude ')" />
                                <x-input id="niveau_etude" class="block mt-1 w-full" type="text" name="niveau_etude" :value="old('niveau_etude')" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="nom" :value="__('Fonction')" /> 
                                <x-select :collection="$fonctions" class="block mt-1 w-full" name='fonction' required> </x-select>
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div class="mt-4">
                                <x-button>Ajouter</x-button>
                            </div>
                            <div class="mt-4">
                                <x-button>Annuler</x-button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        @endif
        @if (isset($items))
        @if ($page_name == "Employers/Edit")    
        <div class="display hidden container p-5 bg-white rounded-5 shadow-2xl">
        @else
            <div class="display container p-5 bg-white rounded-5 shadow-2xl">
        @endif
            
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Employers</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Matricule </th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Nom, Prenom </th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Date de Naissance</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Formation</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Diplome</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Niveau d'etude</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Fonction</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Action</th>
                        </thead>
                        <tbody>
                        
                                @foreach ($items as $item)
                                    <tr class="">
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">{{$item->matricule}}</td>
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">{{$item->nom . " " . $item->prenom}}</td>
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">{{$item->date_naissance}}</td>
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">{{$item->formation}}</td>
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">{{$item->diplome}}</td>
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">{{$item->niveau_etude}}</td>
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                            @foreach ($item->fonctions as $fonction)
                                            {{$fonction->nom . " "}}
                                                
                                            @endforeach
                                        </td>
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                            <div class="flex justify-center gap-4 align-middle">
                                                <a title="modifier" href="{{ route('employers.edit',$item->id) }}"><i class="fa fa-solid fa-pen"></i></a>
                                                <form action="{{ route('employers.destroy',$item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="effacer"><i class="text-red-500 fa fa-solid fa-trash"></i></button>
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
    </div>

@endsection