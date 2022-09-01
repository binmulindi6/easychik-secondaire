@extends('layouts.sas')

@section('content')
    <div class="flex flex-row justify-between">
        <p class=" font-bold text-xl mt-5"><a href="{{route('periodes.index')}}" >Periodes</a></p>
        <p class="font-bold text-xl m-4"> Annee Scolaire {{ $anneeEncours->nom }}</p>
    </div>
    <div class="container flex flex-row justify-between gap-5 mt-16" >
        
        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            <div class="container p-4">
                @if (isset($self))
                    <p class="font-bold text-base"> Edit Periodes </p>
                    <form method="PUT" action="{{ route('periodes.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="($self->nom)" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="trimestre" :value="__('Trimestre')" /> 
                            <x-select :collection="$trimestres"  class="block mt-1 w-full"  name='trimestre' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="date_debut" :value="__('Date Debut')" />
                            <x-input id="date_debu" class="block mt-1 w-full" type="date" name="date_debut" :value="($self->date_debut)" required />
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
                    <p class="font-bold text-base"> Create Periodes </p>
                    <form method="POST" action="{{ route('periodes.store') }}">
                        @method('POST')
                        @csrf
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom')" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="trimestre" :value="__('Trimestre')" /> 
                            <x-select :collection="$trimestres"  class="block mt-1 w-full"  name='trimestre' required> </x-select>
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
                        <th>Trimestre</th>
                        <th>Date Debut</th>
                        <th>Date Fin</th>
                        <th>action</th>
                        <th>action</th>
                    </thead>
                    <tbody>
                       
                            @foreach ($items as $item)
                                <tr class="">
                                    <td class="p-1">{{$item->nom}}</td>
                                    <td class="p-1">{{$item->trimestre->nom . " " . $item->trimestre->annee_scolaire->nom}}</td>
                                    <td class="p-1">{{$item->date_debut}}</td>
                                    <td class="p-1">{{$item->date_fin}}</td>
                                    <td class="p-1 text-blue-500 underline"><a href="{{ route('periodes.edit',$item->id) }}">edit</a></td>
                                    <td >
                                        <form action="{{ route('periodes.destroy',$item->id) }}" method="post">
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