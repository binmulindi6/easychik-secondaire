@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">

        @if (isset($search))
            <x-nav-frais :search="$search" :pagename="$page_name"></x-nav-frais>
        @else
            <x-nav-frais :pagename="$page_name"></x-nav-frais>
        @endif
        
        @if (isset($self))

            <div class="display flex justify-center shadow-2xl p-4 bg-white rounded-5">
                {{-- <div class="pb-0 mb-0 bg-white rounded-t-2xl">
                    <span> Reçu Faiement</span>
                </div> --}}
                <div id="printable" class="max-w0 flex flex-col justify-center items-center p-5 border">
                    <span class="uppercase font-semibold">S.A.S</span>
                    <span class="uppercase font-semibold">{{$annee}}</span>
                    <span class="uppercase font-semibold">Reçu N° : 00{{$self->id}}</span>
                    <table class="border-collapse mt-4">
                        <thead>
                            <td colspan="" class="uppercase">ELEVE: <span class="font-semibold">{{$self->frequentation->eleve->nomComplet()}}</span></td>
                        <thead>
                        </thead>
                            <td colspan="" class="uppercase pb-2">CLASSE: <span class="font-semibold">{{$self->frequentation->eleve->classe()->nomComplet()}}</span></td>
                        </thead>
                        <thead class="">
                            <th class="uppercase border py-1 px-2  ">FRAIS</th>
                            <th class="uppercase border py-1 px-2">Montant Payé</th>
                            <th class="uppercase border py-1 px-2">Date</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="uppercase border py-1 px-2 text-center">{{$self->frais->nom}}</td>
                                <td class="uppercase border py-1 px-2 text-center">{{ $self->montant_paye . " " . $self->frais->type_frais->devise}} </td>
                                <td class="uppercase border py-1 px-2 text-center">{{ $self->date }}</td>
                            </tr>
                        </tbody>
                        <tfoot >
                            <th class="p-8" colspan="3" class="self-end">Secretariat</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endif
    </div>

@endsection


<script defer>
    // const inputType = document.querySelector(".frm-create");
    // console.log(inputType);
    // inputType.addEventListener('onChange', ()=>{
    //     console.log(inputType.value);
    // });
</script>