@extends('layouts.admin')

@section('content')
    <div class="h-full container flex flex-col justify-between gap-5 ">
        <div class=" min-h-75-screen h-[75vh] w-full shadow-2xl container p-4 bg-white rounded-5 flex flex-col items-center gap-4">
            <span class="text-5 font-serif font-semibold">Historique des Evenements</span>
            <div id="my-terminal" class="max-h-10/12 flex-1 flex flex-col items-left w-full md:w-11/12 bg-zinc-100 rounded p-5 overflow-y-scroll">
                @foreach ($logs as $item)
                    <a href="{{route('logs.show', $item->id)}}" class="hover:text-blue-500 hover:underline hover:font-semibold border-b font-serif"> 
                        sas\admin\logfiles> [{{$item->created_at}}] 
                        <span class="text-red-500"> {{$item->event}} </span>sur
                        <span class="text-blue-700"> {{$item->table_name}} </span> par {{ $item->user()->email }}
                        {{-- {{$item->event}} --}}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
