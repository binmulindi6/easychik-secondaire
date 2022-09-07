@extends('layouts.sas')

@section('content')
    <p class=" font-bold text-xl mt-5"><a href="{{route('cours.index')}}" >Cours</a></p>
    <div class="container flex flex-row justify-between gap-5 mt-16" >
        
        @if(isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            <div class="container p-4">
                @if(isset($self))
                    <div class="border-b-2 border-color-black-500 pb-4 mb-4">
                        <a href="{{route('cours.create')}}"> <x-button class="bg-green-500">ajouter un Cours</x-button> </a>
                        
                    </div>
                    <p class="font-bold text-base"> Edit Cours </p>
                    <form method="PUT" action="{{ route('cours.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="categorie_cours" :value="__('Categorie Cours')" /> 
                            <x-select :val="($self->categorie_cours)" :collection="$categories" class="block mt-1 w-full" name='categorie_cours' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom du Cours')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="($self->nom)" placeholder="ex: Geographie..." required />
                        </div>
                        <div class="mt-4">
                            <x-label for="classe" :value="__('Classe')" /> 
                            <x-select :val="($self->classe)" :collection="$classes" class="block mt-1 w-full" name='classe' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="max_periode" :value="__('Note Maximum Periode')" />
                            <x-input id="max_periode" class="block mt-1 w-full" type="text" name="max_periode" :value="($self->max_periode)" placeholder="ex: 20" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="max_examen" :value="__('Note Maximum Examen')" />
                            <x-input id="max_examen" class="block mt-1 w-full" type="text" name="max_examen" :value="($self->max_examen)" placeholder="ex: 40" required />
                        </div>
                        <div class="mt-4">
                            <x-button>Enregistrer</x-button>
                        </div>
                    </form>
                @else
                    <p class="font-bold text-base"> Ajouter une Classe</p>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('cours.store') }}">
                        @method('POST')
                        @csrf
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="categorie_cours" :value="__('Categorie Cours')" /> 
                            <x-select :collection="$categories" class="block mt-1 w-full" name='categorie_cours' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom du Cours')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" placeholder="ex: Geographie..." required />
                        </div>
                        <div class="mt-4">
                            <x-label for="classe" :value="__('Classe')" /> 
                            <x-select :collection="$classes" class="block mt-1 w-full" name='classe' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="max_periode" :value="__('Note Maximum Periode')" />
                            <x-input id="max_periode" class="block mt-1 w-full" type="text" name="max_periode" :value="old('max_periode')" placeholder="ex: 20" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="max_examen" :value="__('Note Maximum Examen')" />
                            <x-input id="max_examen" class="block mt-1 w-full" type="text" name="max_examen" :value="old('max_examen')" placeholder="ex: 40" required />
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
                            <th class="p-1 text-left" >Nom</th>
                            <th class="p-1" >Categorie Cours</th>
                            <th class="p-1" >Max Periode </th>
                            <th class="p-1" >Max Examen </th>
                            <th class="p-1" >Classe</th>
                            <th class="p-1" >Action</th>
                            <th class="p-1" >Action</th>
                        </thead>
                        <tbody>
                        
                                @foreach ($items as $item)
                                    <tr class="">
                                        <td class="p-1 ">{{$item->nom}}</td>
                                        <td class="p-1 text-center ">{{$item->categorie_cours->nom}}</td>
                                        <td class="p-1 text-center ">{{$item->max_periode}}</td>
                                        <td class="p-1 text-center ">{{$item->max_examen}}</td>
                                        <td class="p-1 text-center "> {{$item->classe->niveau . " " . $item->classe->nom}} </td>  
                                        <td class="p-1 text-center  text-blue-500 underline"><a href="{{ route('cours.edit',$item->id) }}">edit</a></td>
                                        <td >
                                            <form action="{{ route('cours.destroy',$item->id) }}" method="post">
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