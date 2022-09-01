@extends('layouts.sas')

@section('content')
    <div class="flex flex-row justify-between">
        <p class=" font-bold text-xl mt-5"><a href="{{route('trimestres.index')}}" >Trimestres</a></p>
        <p class="font-bold text-xl m-4"> Annee Scolaire {{ $anneeEncours->nom }}</p>
    </div>
    <div class="container flex flex-row justify-between gap-5 mt-16" >
        
        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            <div class="container p-4">
                @if (isset($self))
                    <p class="font-bold text-base"> Edit Trimestres </p>
                    <form method="PUT" action="{{ route('trimestres.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="($self->nom)" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="annee_scolaire" :value="__('Annee Scolaire')" /> 
                            <x-select :collection="$annees" :selected="$self->anne_scolaire" class="block mt-1 w-full"  name='annee_scolaire' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="date_debut" :value="__('Date Debut')" />
                            <x-input id="date_debut" class="block mt-1 w-full" type="date" name="date_debut" :value="($self->date_debut)" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="date_fin" :value="__('Date Fin')" />
                            <x-input id="date_fin" class="block mt-1 w-full" type="date" name="date_fin" :value="($self->date_fin)" required />
                        </div>
                        <div class="mt-4">
                            <x-button>Enregistrer</x-button>
                        </div>
                    </form>
                @else
                    <p class="font-bold text-base"> Create Trimestres </p>
                    <form method="POST" action="{{ route('trimestres.store') }}">
                        @method('POST')
                        @csrf
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="annee_scolaire" :value="__('Annee Scolaire')" /> 
                            <x-select :collection="$annees" class="block mt-1 w-full" name='annee_scolaire' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="date_debut" :value="__('Date Debut')" />
                            <x-input id="date_debut" class="block mt-1 w-full" type="date" name="date_debut" :value="old('date_debut')" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="date_fin" :value="__('Date Fin')" />
                            <x-input id="date_fin" class="block mt-1 w-full" type="date" name="date_fin" :value="old('date_fin')" required />
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
                        <th>Nom</th>
                        <th>Annee Scolaire</th>
                        <th>Date Debut</th>
                        <th>Date Fin</th>
                        <th>action</th>
                        <th>action</th>
                    </thead>
                    <tbody>
                       
                            @foreach ($items as $item)
                                <tr class="">
                                    <td class="p-1">{{$item->nom}}</td>
                                    <td class="p-1">{{$item->annee_scolaire->nom}}</td>
                                    <td class="p-1">{{$item->date_debut}}</td>
                                    <td class="p-1">{{$item->date_fin}}</td>
                                    <td class="p-1 text-blue-500 underline"><a href="{{ route('trimestres.edit',$item->id) }}">edit</a></td>
                                    <td >
                                        <form action="{{ route('trimestres.destroy',$item->id) }}" method="post">
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