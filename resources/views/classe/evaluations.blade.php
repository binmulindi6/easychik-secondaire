@extends('layouts.sas')

@section('content')
    <p class=" font-bold text-xl mt-5"><a href="{{route('evaluations.index')}}" >Evaluations</a></p>
    <div class="container flex flex-row justify-between gap-5 mt-16" >
        
        @if(isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            <div class="container p-4">
                @if(isset($self))
                    <div class="border-b-2 border-color-black-500 pb-4 mb-4">
                        <a href="{{route('evaluations.create')}}"> <x-button class="bg-green-500">ajouter une Evaluation</x-button> </a>
                        
                    </div>
                    <p class="font-bold text-base"> Edit Evaluation </p>
                    <form method="PUT" action="{{ route('evaluations.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="type_evaluation" :value="__('Type de L\'evaluation')" />
                            <x-select :val="$self->type_evaluation" :collection="$type_evaluations" class="block mt-1 w-full" name='type_evaluation' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="cours" :value="__('Cours')" />
                            <x-select :val="$self->cours" :collection="$cours" class="block mt-1 w-full" name='cours' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="note_max" :value="__('Note Maximum')" />
                            <x-input id="note-max" class="block mt-1 w-full" type="text" name="note_max" :value="($self->note_max)" placeholder="ex: 10" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="periode" :value="__('Periode')" />
                            <x-select :val="$self->periode" :collection="$periodes" class="block mt-1 w-full" name='periode' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="date" :value="__('Date de L\'Evaluation')" />
                            <x-input id="date-evaluation" class="block mt-1 w-full" type="date" name="date_evaluation" :value="($self->date_evaluation)" required />
                        </div>
                        <div class="mt-4">
                            <x-button>Enregistrer</x-button>
                        </div>
                    </form>
                @else
                    <p class="font-bold text-base"> Ajouter une Evaluation</p>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="" method="POST" action="{{ route('evaluations.store') }}">
                        @method('POST')
                        @csrf
                        <!-- Email Address -->

                        <div class="mt-4">
                            <x-label for="type_evaluation" :value="__('Type de L\'evaluation')" />
                            <x-select :collection="$type_evaluations" class="block mt-1 w-full" name='type_evaluation' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="cours" :value="__('Cours')" />
                            <x-select :collection="$cours" class="block mt-1 w-full" name='cours' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="note_max" :value="__('Note Maximum')" />
                            <x-input id="note-max" class="block mt-1 w-full" type="text" name="note_max" :value="old('note_max')" placeholder="ex: 1,2,3" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="periode" :value="__('Periode')" />
                            <x-select :collection="$periodes" class="block mt-1 w-full" name='periode' required> </x-select>
                        </div>
                        <div class="mt-4">
                            <x-label for="date" :value="__('Date de L\'Evaluation')" />
                            <x-input id="date-evaluation" class="block mt-1 w-full" type="date" name="date_evaluation" :value="old('date_evaluation')" required />
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
                            <th class="p-1" >Type Evaluation</th>
                            <th class="p-1" >Cours </th>
                            <th class="p-1" >Note Max</th>
                            <th class="p-1" >Periode</th>
                            <th class="p-1" >Date Evaluation</th>
                            <th class="p-1" >Action</th>
                            <th class="p-1" >Action</th>
                        </thead>
                        <tbody>
                        
                                @foreach ($items as $item)
                                    <tr class="">
                                        <td class="p-1  ">{{$item->type_evaluation->nom}}</td>
                                        <td class="p-1 text-center ">{{$item->cours->nom}}</td>
                                        <td class="p-1 text-center ">{{$item->note_max}}</td>
                                        <td class="p-1 text-center ">{{$item->periode->nom}}</td>
                                        <td class="p-1 text-center ">{{$item->date_evaluation}}</td>
                                        <td class="p-1 text-center  text-blue-500 underline"><a href="{{ route('evaluations.edit',$item->id) }}">edit</a></td>
                                        <td >
                                            <form action="{{ route('evaluations.destroy',$item->id) }}" method="post">
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