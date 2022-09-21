@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5" >

        <x-nav-users :pagename="$page_name"> </x-nav-users>
        
        
        @if (isset($items))
        @if ($page_name == "Employers/Edit")    
        <div class="display hidden container p-5 bg-white rounded-5 shadow-2xl">
        @else
            <div class="display container p-5 bg-white rounded-5 shadow-2xl">
        @endif
            
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Employers</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Nom </th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Email </th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Fonction</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Classe</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Satut</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" >Action</th>
                        </thead>
                        <tbody>
                        
                                @foreach ($items as $item)
                                    <tr class="">
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">{{$item->employer->nom . " " . $item->employer->prenom}}</td>
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">{{$item->email}}</td>
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">{{$item->employer->fonctions[0]->nom}}</td>
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">{{$item->classe->niveau . " - " .$item->classe->nom}}</td>
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                            @if ($item->isActive == "0")
                                            <form action="{{ route('users.statut', $item->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="statut" value="{{$item->isActive}}" >
                                                <button type="submit" title="Active"class="bg-gradient-to-tl cursor-pointer from-red-500 to-pink-400 px-3.6 text-xss rounded-1.8 py-2.2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                    Desactive
                                                </button>
                                                </form>
                                            @else
                                            <form action="{{ route('users.statut', $item->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="statut" value="{{$item->isActive}}" >
                                                <button type="submit" title="Desactive"class="bg-gradient-to-tl cursor-pointer from-emerald-500 to-teal-400 px-3.6 text-xss rounded-1.8 py-2.2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                    Active
                                                </button>
                                                </form>
                                            @endif
                                        </td>
                                        <td class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                            <div class="flex justify-center gap-4 align-middle">
                                                <a title="modifier" href="{{ route('users.edit',$item->id) }}"><i class="fa fa-solid fa-pen"></i></a>
                                                <form action="{{ route('users.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="effacer"><i class="text-red-500 fa fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        
        </div>
        @endif
    </div>
    </div>

@endsection