@extends('layouts.admin')
@section('content')
    <div class=" container flex flex-col justify-between gap-5 h-full">

        <div class="frm-identity flex flex-col justify-center items-center  gap-5 shadow-2xl relative bg-white rounded-5 pb-5  w-full h-full  z-20">
            <div class="w-full h-3/4 bg-red-500 rounded-t-5">
                lk
            </div>
            <div class="flex flex-row justify-center w-full">
                <form action="{{route('settings.store')}}" method="post" class="flex items-center gap-2">
                    @csrf
                    <x-label class="">Annee Scolaire :</x-label>
                    <div class="w-60 h-10 flex flex-row justify-end items-center gap-2">
                        <x-select :val="$current" :collection="$annees" class="block mt-1 w-full" name='annee' required></x-select>
                        <x-button>choisir</x-button>
                    </div>
                </form>
            </div>

    </div>
@endsection
