@extends('layouts.sas')

@section('content')
    <p class=" font-bold text-xl mt-5"><a href="{{route('classes.index')}}" >Classes</a></p>
    <div class="container flex flex-row justify-between gap-5 mt-16" >
        
        @if(isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            <div class="container p-4">
                @if(isset($self))
                    <div class="border-b-2 border-color-black-500 pb-4 mb-4">
                        <a href="{{route('classes.create')}}"> <x-button class="bg-green-500">ajouter une Classe</x-button> </a>
                        
                    </div>
                    <p class="font-bold text-base"> Edit Eleve </p>
                    <form method="PUT" action="{{ route('classes.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="niveau" :value="__('Niveau de la Classe')" />
                            <x-input id="niveau" class="block mt-1 w-full" type="text" name="niveau" :value="($self->niveau)" placeholder="ex: 1,2,3" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom de la Classe')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="($self->nom)" placeholder="ex: A,B,C" required />
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

                    <form method="POST" action="{{ route('classes.store') }}">
                        @method('POST')
                        @csrf
                        <!-- Email Address -->

                        <div class="mt-4">
                            <x-label for="niveau" :value="__('Niveau de la Classe')" />
                            <x-input id="niveau" class="block mt-1 w-full" type="text" name="niveau" :value="old('niveau')" placeholder="ex: 1,2,3" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom de la Classe')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" placeholder="ex: A,B,C" required />
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
                            <th class="p-1" >Niveau </th>
                            <th class="p-1" >Nom</th>
                            <th class="p-1" >Enseignant</th>
                            <th class="p-1" >Action</th>
                            <th class="p-1" >Action</th>
                        </thead>
                        <tbody>
                        
                                @foreach ($items as $item)
                                    <tr class="">
                                        <td class="p-1 ">{{$item->niveau}}</td>
                                        <td class="p-1 ">{{$item->nom}}</td>
                                        <td class="p-1 ">
                                        
                                            @if (isset($item->user->employer))
                                                {{$item->user->employer->nom . " " .  $item->user->employer->prenom}}  
                                            @else
                                                <a class="p-1  text-blue-500 underline" href=""> Enseignant indisponible </a>
                                            @endif

                                        </td>  
                                        <td class="p-1  text-blue-500 underline"><a href="{{ route('classes.edit',$item->id) }}">edit</a></td>
                                        <td >
                                            <form action="{{ route('classes.destroy',$item->id) }}" method="post">
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