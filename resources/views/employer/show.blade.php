@extends('layouts.sas')

@section('content')
    <p class=" font-bold text-xl mt-5"><a href="{{route('employers.index')}}" >Employers</a></p>
    <div class="container flex flex-row justify-between gap-5 mt-16" >
        
        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            <div class="container p-4">
                @if (isset($self))
                    <p class="font-bold text-base"> Edit Employer </p>
                    <form method="PUT" action="{{ route('employers.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="matricule" :value="__('Matricule')" />
                            <x-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="($self->matricule)" required />
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
                            <x-label for="date_naissance" :value="__('Date de Naissance')" />
                            <x-input id="date-naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="($self->date_naissance)" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="formation" :value="__('Formation')" />
                            <x-input id="formation" class="block mt-1 w-full" type="text" name="formation" :value="($self->formation)" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="diplome" :value="__('Diplome')" />
                            <x-input id="diplome" class="block mt-1 w-full" type="text" name="diplome" :value="($self->diplome)" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="niveau_etude" :value="__('Niveau d\'etude ')" />
                            <x-input id="niveau_etude" class="block mt-1 w-full" type="text" name="niveau_etude" :value="($self->niveau_etude)" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Fonction')" /> 
                            <x-select :collection="$fonctions" class="block mt-1 w-full" name='fonction' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-button>Enregistrer</x-button>
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
                        <div class="mt-4">
                            <x-label for="matricule" :value="__('Matricule')" />
                            <x-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="old('matricule')" required />
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
                            <x-label for="date_naissance" :value="__('Date de Naissance')" />
                            <x-input id="date-naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="old('')" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="formation" :value="__('Formation')" />
                            <x-input id="formation" class="block mt-1 w-full" type="text" name="formation" :value="old('formation')" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="diplome" :value="__('Diplome')" />
                            <x-input id="diplome" class="block mt-1 w-full" type="text" name="diplome" :value="old('diplome')" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="niveau_etude" :value="__('Niveau d\'etude ')" />
                            <x-input id="niveau_etude" class="block mt-1 w-full" type="text" name="niveau_etude" :value="old('niveau_etude')" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Fonction')" /> 
                            <x-select :collection="$fonctions" class="block mt-1 w-full" name='fonction' required> </x-select>
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
                        <th class="p-1" >Date de Naissance</th>
                        <th class="p-1" >Formation</th>
                        <th class="p-1" >Diplome</th>
                        <th class="p-1" >Niveau d'etude</th>
                        <th class="p-1" >Fonction</th>
                        <th class="p-1" >Action</th>
                        <th class="p-1" >Action</th>
                    </thead>
                    <tbody>
                       
                            @foreach ($items as $item)
                                <tr class="">
                                    <td class="p-1 ">{{$item->matricule}}</td>
                                    <td class="p-1 ">{{$item->nom . " " . $item->prenom}}</td>
                                    <td class="p-1 ">{{$item->date_naissance}}</td>
                                    <td class="p-1 ">{{$item->formation}}</td>
                                    <td class="p-1 ">{{$item->diplome}}</td>
                                    <td class="p-1 ">{{$item->niveau_etude}}</td>
                                    <td class="p-1 ">
                                        @foreach ($item->fonctions as $fonction)
                                        {{$fonction->nom . " "}}
                                            
                                        @endforeach
                                    </td>
                                    <td class="p-1  text-blue-500 underline"><a href="{{ route('employers.edit',$item->id) }}">edit</a></td>
                                    <td >
                                        <form action="{{ route('employers.destroy',$item->id) }}" method="post">
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