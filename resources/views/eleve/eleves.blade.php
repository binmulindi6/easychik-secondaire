@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5" >

        <x-nav-eleves :pagename="($page_name)"></x-nav-eleves>
        
        @if(isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            @if ($page_name == "Eleves/Edit" || $page_name == "Eleves/Create")
                <div class="frm-create shadow-2xl relative p-4 bg-white rounded-5 p-5 w-full  z-20" >
            @else
                <div class="frm-create shadow-2xl relative hidden p-4 bg-white rounded-5 p-5 w-full  z-20" >
            @endif
                @if(isset($self))
                    <p class="font-bold text-base"> Edit Eleve </p>
                    <form method="PUT" action="{{ route('eleves.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="matricule" :value="__('Matricule')" />
                            <x-input id="matricule" class="block mt-1 w-1/4" type="text" name="matricule" :value="($self->matricule)" required readonly/>
                        </div>
                        <div class="flex justify-between gap-4">
                            <div class="mt-4 w-full">
                                <x-label for="nom" :value="__('Nom et Post-Nom')" />
                                <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="($self->nom)" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="prenom" :value="__('Prenom')" />
                                <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="($self->prenom)" required />
                            </div>
                        </div>
                        <div class="flex justify-between gap-4">
                            <div class="mt-4 w-full">
                                <x-label for="lieu_naissance" :value="__('Lieu de Naissance')" />
                                <x-input id="lieu_naissance" class="block mt-1 w-full" type="text" name="lieu_naissance" :value="($self->lieu_naissance)" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="date_naissance" :value="__('Date de Naissance')" />
                                <x-input id="date-naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="($self->date_naissance)" required />
                            </div>
                        </div>
                        <div class="flex justify-between gap-4">
                            <div class="mt-4 w-full">
                                <x-label for="nom_pere" :value="__('Nom du Pere')" />
                                <x-input id="nom_pere" class="block mt-1 w-full" type="text" name="nom_pere" :value="($self->nom_pere)" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="nom_mere" :value="__('Nom de la Mere')" />
                                <x-input id="nom_mere" class="block mt-1 w-full" type="text" name="nom_mere" :value="($self->nom_mere)" required />
                            </div>
                        </div>
                        <div class="mt-4">
                            <x-label for="adresse" :value="__('Adresse')" />
                            <x-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="($self->adresse)" required />
                        </div>
                        <div class="mt-4">
                            <x-button>Enregistrer</x-button>
                        </div>
                    </form>
                @else
                    <p class="font-bold text-base"> Ajouter Eleve </p>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('eleves.store') }}">
                        @method('POST')
                        @csrf
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="matricule" :value="__('Matricule')" />
                            <x-input id="matricule" class="block mt-1 w-1/4" type="text" name="matricule" :value="($last_matricule)" required readonly/>
                        </div>
                        <div class="flex justify-between gap-4">
                            <div class="mt-4 w-full">
                                <x-label for="nom" :value="__('Nom et Post-Nom')" />
                                <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="prenom" :value="__('Prenom')" />
                                <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required />
                            </div>
                        </div>
                        <div class="flex justify-between gap-4">
                            <div class="mt-4 w-full">
                                <x-label for="lieu_naissance" :value="__('Lieu de Naissance')" />
                                <x-input id="lieu_naissance" class="block mt-1 w-full" type="text" name="lieu_naissance" :value="old('lieu_naissance')" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="date_naissance" :value="__('Date de Naissance')" />
                                <x-input id="date-naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="old('')" required />
                            </div>
                        </div>
                        <div class="flex justify-between gap-4">
                            <div class="mt-4 w-full">
                                <x-label for="nom_pere" :value="__('Nom du Pere')" />
                                <x-input id="nom_pere" class="block mt-1 w-full" type="text" name="nom_pere" :value="old('nom_pere')" required />
                            </div>
                            <div class="mt-4 w-full">
                                <x-label for="nom_mere" :value="__('Nom de la Mere')" />
                                <x-input id="nom_mere" class="block mt-1 w-full" type="text" name="nom_mere" :value="old('nom_mere')" required />
                            </div>
                        </div>
                        <div class="mt-4">
                            <x-label for="adresse" :value="__('Adresse')" />
                            <x-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')" required />
                        </div>

                        <div class="mt-4">
                            <x-button>ajouter</x-button>
                        </div>
                    </form>
                @endif
            </div>
        @endif


        @if (isset($items))
        @if ($page_name == "Eleves/Edit" || $page_name == "Eleves/Create")
            <div class="display container shadow-2xl p-4 hidden relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border" > 
        @else
            <div class="display container shadow-2xl p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border" > 
        @endif  

                <div class=" flex justify-between p-4 pb-0 mb-0 bg-white rounded-t-2xl">
                    <h6>Eleves</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Matricule </th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Nom, Prenom </th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Lieu, Date de Naissance</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Nom du Pere</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Nom de la Mere</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Adresse</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Classe</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" colspan="2" >Action</th>
                                </thead>
                                <tbody>
                                
                                        @foreach ($items as $item)
                                            <tr class="">
                                                <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">{{$item->matricule}}</td>
                                                <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">{{$item->nom . " " . $item->prenom}}</td>
                                                <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">{{$item->lieu_naissance . ', ' . $item->date_naissance}}</td>
                                                <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">{{$item->nom_pere}}</td>
                                                <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">{{$item->nom_mere}}</td>
                                                <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">{{$item->adresse}}</td>
                                                <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                    @if ($item->classe(false) == null)
                                                    <a class="text-blue-500 underline" href="{{ route('frequentations.link',$item->id) }}"> Ajouter dans une classe </a>
                                                    @else
                                                    {{$item->classe(false)}}</td>    
                                                        
                                                    @endif
                                                <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  text-blue-500 underline">
                                                    <div class="flex justify-center gap-4 align-middle">
                                                        <a href="{{ route('eleves.edit',$item->id) }}"><i class="fa fa-solid fa-pen"></i></a>
                                                        <form action="{{ route('eleves.destroy',$item->id) }}" method="post">
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
    </div>

@endsection