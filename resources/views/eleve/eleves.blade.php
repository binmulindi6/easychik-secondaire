@extends('layouts.sas')

@section('content')
    <p class=" font-bold text-xl mt-5"><a href="{{route('eleves.index')}}" >Eleves</a></p>
    <div class="container flex flex-row justify-between gap-5 mt-16" >
        
        @if(isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            <div class="container p-4">
                @if(isset($self))
                    <div class="border-b-2 border-color-black-500 pb-4 mb-4">
                        <a href="{{route('eleves.create')}}"> <x-button class="bg-green-500">ajouter un eleve</x-button> </a>
                        
                    </div>
                    <p class="font-bold text-base"> Edit Eleve </p>
                    <form method="PUT" action="{{ route('eleves.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="matricule" :value="__('Matricule')" />
                            <x-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="($self->matricule)" required readonly/>
                        </div>
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom et Post-Nom')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="($self->nom)" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="prenom" :value="__('Prenom')" />
                            <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="($self->prenom)" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="lieu_naissance" :value="__('Lieu de Naissance')" />
                            <x-input id="lieu_naissance" class="block mt-1 w-full" type="text" name="lieu_naissance" :value="($self->lieu_naissance)" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="date_naissance" :value="__('Date de Naissance')" />
                            <x-input id="date-naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="($self->date_naissance)" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="nom_pere" :value="__('Nom du Pere')" />
                            <x-input id="nom_pere" class="block mt-1 w-full" type="text" name="nom_pere" :value="($self->nom_pere)" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="nom_mere" :value="__('Nom de la Mere')" />
                            <x-input id="nom_mere" class="block mt-1 w-full" type="text" name="nom_mere" :value="($self->nom_mere)" required />
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
                            <x-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="($last_matricule)" required readonly/>
                        </div>
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom et Post-Nom')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="prenom" :value="__('Prenom')" />
                            <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="lieu_naissance" :value="__('Lieu de Naissance')" />
                            <x-input id="lieu_naissance" class="block mt-1 w-full" type="text" name="lieu_naissance" :value="old('lieu_naissance')" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="date_naissance" :value="__('Date de Naissance')" />
                            <x-input id="date-naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="old('')" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="nom_pere" :value="__('Nom du Pere')" />
                            <x-input id="nom_pere" class="block mt-1 w-full" type="text" name="nom_pere" :value="old('nom_pere')" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="nom_mere" :value="__('Nom de la Mere')" />
                            <x-input id="nom_mere" class="block mt-1 w-full" type="text" name="nom_mere" :value="old('nom_mere')" required />
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
            <div class="container p-4"> 
            
                <p class="font-bold text-xl m-4"> Display </p>
                <table>
                        <thead>
                            <th class="p-1" >Matricule </th>
                            <th class="p-1" >Nom, Prenom </th>
                            <th class="p-1" >Lieu, Date de Naissance</th>
                            <th class="p-1" >Nom du Pere</th>
                            <th class="p-1" >Nom de la Mere</th>
                            <th class="p-1" >Adresse</th>
                            <th class="p-1" >Classe</th>
                            <th class="p-1" >Action</th>
                            <th class="p-1" >Action</th>
                        </thead>
                        <tbody>
                        
                                @foreach ($items as $item)
                                    <tr class="">
                                        <td class="p-1 ">{{$item->matricule}}</td>
                                        <td class="p-1 ">{{$item->nom . " " . $item->prenom}}</td>
                                        <td class="p-1 ">{{$item->lieu_naissance . ', ' . $item->date_naissance}}</td>
                                        <td class="p-1 ">{{$item->nom_pere}}</td>
                                        <td class="p-1 ">{{$item->nom_mere}}</td>
                                        <td class="p-1 ">{{$item->adresse}}</td>
                                        <td class="p-1 ">
                                            @if ($item->classe(false) == null)
                                            <a class="text-blue-500 underline" href="{{ route('frequentations.link',$item->id) }}"> Ajouter dans une classe </a>
                                            @else
                                            {{$item->classe(false)}}</td>    
                                                
                                            @endif
                                        <td class="p-1  text-blue-500 underline"><a href="{{ route('eleves.edit',$item->id) }}">edit</a></td>
                                        <td >
                                            <form action="{{ route('eleves.destroy',$item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="p-1 text-blue-500 underline" type="submit">delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                        
                        </tbody>
                </table>
        
            </div>
        @endif
    </div>

@endsection