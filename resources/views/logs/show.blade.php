@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">
        <x-back :link="route('logs')"></x-back>
        <div class=" h-full shadow-2xl container p-4 bg-white rounded-5 flex flex-col justify-center items-center gap-5">

            <div class="flex flex-row gap-5 justify-center w-full md:w-10/12 bg-zinc-100 rounded py-2 px-4">
                <span class="fa fa-solid fa-list rounded-full p-5 bg-zinc-100 text-8 shadow-xxs"></span>
                <div class="flex flex-row justify-between items-center w-full">
                    <div class="flex flex-row gap-2">
                        @if (str_contains($log->event, 'Creation'))
                            <span
                                class="px-4 py-2 rounded from-blue-700 bg-gradient-to-r to-blue-400 text-white font-semibold">{{ $log->event }}</span>
                        @endif
                        @if (str_contains($log->event, 'Modification'))
                            <span
                                class="px-4 py-2 rounded from-green-700 bg-gradient-to-r to-green-400 text-white font-semibold">{{ $log->event }}</span>
                        @endif
                        @if (str_contains($log->event, 'Suppression'))
                            <span
                                class="px-4 py-2 rounded from-red-700 bg-gradient-to-r to-red-400 text-white font-semibold">{{ $log->event }}</span>
                        @endif
                        @if (str_contains($log->event, 'Restoration'))
                            <span
                                class="px-4 py-2 rounded from-zinc-700 bg-gradient-to-r to-zinc-400 text-white font-semibold">{{ $log->event }}</span>
                        @endif
                        <span
                            class="px-4 py-2 rounded from-blue-700 bg-gradient-to-r to-blue-400 text-white font-semibold">{{ $log->table_name }}</span>
                    </div>
                    <span
                        class="px-4 py-2 rounded from-green-700 bg-gradient-to-r to-blue-400 text-white font-semibold">{{ $log->created_at }}</span>
                </div>
            </div>
            <div class="flex flex-col md:flex-row gap-5 w-full md:w-10/12">
                <div class="flex flex-col gap-4 w-full md:w-10/12 bg-zinc-100 rounded py-2 px-4">
                    <span class="text-center font-semibold uppercase">l'element</span>
                    @if ($log->item() !== null)
                        @dump($log->item())
                        @if (str_contains($log->event, 'Suppression'))
                            <form action="{{ route('logs.restore', $log->id) }}" method="post"
                                class="flex justify-center items-center">
                                @csrf
                                @method('PUT')
                                <x-button>Restorer l'element</x-button>
                            </form>
                        @endif
                    @else
                        <span class="uppercase font-semibold text-center"> <span
                                class="fa fa-solid fa-info-circle text-red-500"> </span> l'element a été Restorer</span>
                    @endif
                </div>
                <div class="flex flex-col gap-4  w-full md:w-10/12 bg-zinc-100 rounded py-2 px-4">
                    <span class="text-center font-semibold uppercase">l'utilisateur</span>
                    <div class="flex flex-col ">
                        <span> <span class="font-semibold">Identifiant :</span> {{ $log->user()->email }}</span>
                        @if ($log->user()->isParent())
                            <span>
                                <span class="font-semibold">Nom :</span> {{ $log->user()->parrain->nomComplet() }}</span>
                            <span>
                                <span class="font-semibold">Type:</span> Parent</span>
                        @else
                            <span>
                                <span class="font-semibold">Nom :</span> {{ $log->user()->employer->nomComplet() }}</span>
                            <span>
                                <span class="font-semibold">Type:</span>
                                @foreach ($log->user()->employer->fonctions as $item)
                                    {{ $item->nom }},
                                @endforeach
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
