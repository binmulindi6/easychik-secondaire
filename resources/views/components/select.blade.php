@if (isset($submitOnChage) || isset($submitOnChange))
    <select readonly onchange="this.form.submit()"
        {{ $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}>
    @else
        @if (isset($isSelectedLink))
            <select id="{{ $isSelectedLink }}"
                {{ $attributes->merge(['class' => 'isSelectLink rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}>
            @else
                <select
                    {{ $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}>
        @endif
@endif

@if (isset($val))
    @if (isset($val->id))
        <option selected hidden value="{{ $val->id }}">
        @else
        <option selected hidden value="{{ $val }}">
    @endif
    @if (isset($val->email))
        @if (isset($only))
            @if ($only === 'Parent')
                @if ($val->isParent())
                    {{ $val->parrain->nom . ' ' . $val->parrain->prenom }}
                @endif
            @endif
            @if ($only === 'Enseignant')
                @if ($val->isEnseignant())
                    {{ $val->employer->nom . ' ' . $val->employer->prenom }}
                @endif
            @endif
        @else
            {{ $val->employer->nom . ' ' . $val->employer->prenom }}
        @endif
    @else
        @if (isset($val->max_periode))
            {{ $val->nom . " : " . $val->niveau->nom . " " . $val->section->nom }}
        @else
            @if (isset($val->niveau))
                {{ $val->niveau->nom . " " . $val->section->nom . ' ' . $val->nom }}
            @else
                @if (isset($val->annee_scolaire))
                    {{ $val->nom . ' ' . $val->annee_scolaire->nom }}
                @else
                    @if (isset($val->nom))
                        {{ $val->nom }}
                    @else
                        {{ $val }}
                    @endif
                @endif
            @endif
        @endif
    @endif
    </option>
@else
    @if (isset($placeholder))
        <option disabled selected hidden>{{ $placeholder }}</option>
    @else
        <option disabled selected hidden>Selectionner une option</option>
    @endif
@endif
@if (isset($isSelectedLink))
    <option value="isLink">
        + {{ $linkName }}
    </option>
@endif
@if (isset($isHoraire))
    <option value="RECREATION">RECREATION</option>
@endif
@if (isset($all))
    <option value="all"> {{ $all }} </option>
@endif
@if (isset($collection) && $collection !== null)
    @if (isset($only))
        @foreach ($collection as $item)
            @if ($only === 'Enseignant')
                @if ($item->isEnseignant())
                    <option value="{{ $item->id }}">
                        @if (isset($item->email))
                            {{ $item->employer->nom . ' ' . $item->employer->prenom }}
                        @endif
                    </option>
                @endif
            @endif
            @if ($only === 'Parent')
                @if ($item->isParent())
                    <option value="{{ $item->id }}">
                        @if (isset($item->email))
                            {{ $item->parrain->nom . ' ' . $item->parrain->prenom }}
                        @endif
                    </option>
                @endif
            @endif
        @endforeach
    @else
        @foreach ($collection as $item)
            <option value="{{ $item->id }}">
                @if (isset($item->email))
                    {{ $item->employer->nom . ' ' . $item->employer->prenom }}
                @else
                    @if (isset($item->trimestre))
                        {{ $item->nom . ' ' . $item->trimestre->annee_scolaire->nom }}
                    @else
                        @if (isset($item->annee_scolaire))
                            {{ $item->nom . ' ' . $item->annee_scolaire->nom }}
                        @else
                            @if (isset($item->niveau) && isset($item->encadrements))
                            {{ $item->niveau->nom . " " . $item->section->nom . ' ' . $item->nom }}
                            @else
                                @if (isset($item->max_periode))
                                {{ $item->nom . " : " . $item->niveau->nom . " " . $item->section->nom }}
                                @else
                                    @if (isset($item->type_frais))
                                        {{ $item->nom . ' (en ' . $item->type_frais->devise . ')' }}
                                    @else
                                        @if (isset($item->devise))
                                            {{ $item->nom . ' (en ' . $item->devise . ')' }}
                                        @else
                                            @if (isset($item->nom))
                                                {{ $item->nom }}
                                            @else
                                                {{ $item }}
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endif
                    @endif
                @endif
            </option>
        @endforeach
    @endif
@endif
</select>


{{-- <select link="{{ route('categories.create') }}" id="isSelectLink" name="devise" id="nom"
    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-4/12"
    required>
    <option value="isLink">
        ➕ Ajouter
    </option>
    <option selected value="USD">USD</option>
    <option value="CDF">CDF</option>
</select> --}}
