@extends('layouts.sas')

@section('content')
    <p class=" font-bold text-xl mt-5"><a href="{{route('frequentations.index')}}" >Historique des Frequentations</a></p>
    <div class="container flex flex-row justify-between gap-5 mt-16" >
        
        @if(isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            <div class="container p-4">
                @if(isset($self))
                    <div class="border-b-2 border-color-black-500 pb-4 mb-4">
                        <a href="{{route('eleves.create')}}"> <x-button class="bg-green-500">ajouter une Frequentations</x-button> </a>
                        
                    </div>
                    <p class="font-bold text-base"> Edit Eleve </p>
                    <form method="PUT" action="{{ route('frequentations.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="matricule" :value="__('Matricule Eleve')" />
                            <x-input id="eleve_matricule" class="block mt-1 w-full" type="text" name="eleve_matricule" :value="old('eleve_matricule')" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="classe" :value="__('Classe')" />
                            <x-select :collection="$classes" class="block mt-1 w-full" name='classe_id' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="annee_scolaire" :value="__('Annee Scolaire')" />
                            <x-select :collection="$classes" class="block mt-1 w-full" name='annee_scolaire_id' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-button>Enregistrer</x-button>
                        </div>
                    </form>
                @else
                    <p class="font-bold text-base"> Ajouter une Frequentations</p>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('frequentations.store') }}">
                        @method('POST')
                        @csrf
                        <!-- Email Address -->
                        @if (isset($matricule))
                            <div class="mt-4">
                                <x-label for="matricule" :value="__('Matricule Eleve')" />
                                <x-input id="matricule" class="block mt-1 w-full" type="text" name="eleve_matricule" :value="($matricule)" required  readonly/>
                            </div>
                        @else
                            <div class="mt-4">
                                <x-label for="matricule" :value="__('Matricule Eleve')" />
                                <x-input id="matricule" class="block mt-1 w-full" type="text" name="eleve_matricule" :value="old('nom')" required />
                            </div>
                        @endif
                        <div class="mt-4">
                            <x-label for="classe" :value="__('Classe')" />
                            <x-select :collection="$classes" class="block mt-1 w-full" name='classe_id' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="annee_scolaire" :value="__('Annee Scolaire')" />
                            <x-select :collection="$annees" class="block mt-1 w-full" name='annee_scolaire_id' required> </x-select>
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
                            <th class="p-1" >Matricule Eleve </th>
                            <th class="p-1" >Nom, Prenom </th>
                            <th class="p-1" >Classe</th>
                            <th class="p-1" >Annee Scolaire</th>
                            <th class="p-1" >Action</th>
                            <th class="p-1" >Action</th>
                        </thead>
                        <tbody>
                        
                                @foreach ($items as $item)
                                    <tr class="">
                                        <td class="p-1 ">{{ " 10 "}}</td>
                                        <td class="p-1 ">{{$item->eleve_id}}</td>
                                        <td class="p-1 ">{{$item->classe_id}}</td>
                                        <td class="p-1 ">{{$item->annee_scolaire_id}}</td>  
                                        <td class="p-1  text-blue-500 underline"><a href="{{ route('frequentations.edit',$item->id) }}">edit</a></td>
                                        <td >
                                            <form action="{{ route('frequentations.destroy',$item->id) }}" method="post">
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