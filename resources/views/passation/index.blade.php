@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        <div class="display shadow-2xl container p-4 bg-white rounded-5">
            <div class="flex flex-wrap w-full">
                @foreach ($classes as $item)
                    <x-classe-card :to="'passations.classe'" :data="$item"></x-classe-card>
                @endforeach
            </div>
        </div>
    </div>
@endsection
