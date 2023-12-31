@extends('layouts.sas')

@section('content')
    <p class=" font-bold text-xl mt-5"><a href="{{ route('type-evaluations.index') }}">Type Evaluations</a></p>
    <div class="container flex flex-row justify-between gap-5 mt-16">

        @if (isset($item))
            <p class=" font-bold text-xl mt-5"> {{ $item->nom }} </p>
        @else
            <div class="container p-4">
                @if (isset($self))
                    <p class="font-bold text-base "> Edit Type Evaluations </p>
                    <form method="PUT" action="{{ route('type-evaluations.update', $self->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom')" />

                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                                :value="$self->nom" required />
                        </div>
                        <div class="mt-4">
                            <x-button>Enregistrer</x-button>
                        </div>
                    </form>
                @else
                    <p class="font-bold text-base"> Create Type Evaluations </p>
                    <form method="POST" action="{{ route('type-evaluations.store') }}">
                        @method('POST')
                        @csrf
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="nom" :value="__('Nom')" />

                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                                :value="old('nom')" required />
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
                        <th>action</th>
                        <th>action</th>
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            <tr class="">
                                <td class="p-1">{{ $item->nom }}</td>
                                <td class="p-1 text-blue-500 underline"><a
                                        href="{{ route('type-evaluations.edit', $item->id) }}">edit</a></td>
                                <td>
                                    <form class="delete-form" action="{{ route('type-evaluations.destroy', $item->id) }}"
                                        method="post">
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
