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
                    <span class="uppercase font-semibold">{{ env('ecole') ? env('ecole') : env('APP_NAME') }}</span>
                    <span class="uppercase font-semibold">{{ $annee }}</span>
                    <span class="uppercase font-semibold">Reçu N° : 00{{ $self->id }}</span>
                    <table class="border-collapse mt-4">
                        <thead>
                            <tr>
                                <td colspan="" class="uppercase">ELEVE: <span
                                        class="font-semibold">{{ $self->frequentation->eleve->nomComplet() }}</span></td>
                            </tr>
                            <tr>
                                <td colspan="" class="uppercase">CLASSE: <span
                                        class="font-semibold">{{ $self->frequentation->eleve->classe()->nomComplet() }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="" class="uppercase">PAYÉ À LA: <span
                                        class="font-semibold">{{ $self->moyen_paiement->nom }}</span></td>
                                @if ($self->reference !== null)
                                    <td colspan="" class="uppercase">REF : <span
                                            class="font-semibold">{{ $self->reference }}</span></td>
                                @endif
                            </tr>
                        </thead>
                        </thead>
                        <thead class="">
                            <th class="uppercase border py-1 px-2  ">FRAIS</th>
                            <th class="uppercase border py-1 px-2">Montant Payé</th>
                            <th class="uppercase border py-1 px-2">Date</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="uppercase border py-1 px-2 text-center">{{ $self->frais->nom }}</td>
                                <td class="uppercase border py-1 px-2 text-center">
                                    {{ $self->montant_paye . ' ' . $self->frais->type_frais->devise }} </td>
                                <td class="uppercase border py-1 px-2 text-center">le {{ date_format(date_create($self->date),'d/m/Y') }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="pt-8 italic" colspan="3" class="self-end">Fait à {{env('VILLE')}} le {{date('d/m/Y')}}</th>
                            </tr>
                            <tr>
                                <th class="pt-2 pb-8" colspan="3" class="self-end">Secretariat</th>
                            </tr>
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
