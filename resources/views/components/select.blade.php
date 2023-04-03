<select readonly 
    {{ $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}>

    @if (isset($val))
        <option selected hidden value="{{ $val->id }}">
            @if (isset($val->email))
                {{ $val->employer->nom . ' ' . $val->employer->prenom }}
            @else
                @if (isset($val->niveau))
                    {{ $val->niveau->nom . ' ' . $val->nom }}
                @else
                    {{ $val->nom }}
                @endif
            @endif
        </option>
    @else
        <option disabled selected hidden>Selectionner une option</option>
    @endif

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
                        @if (isset($item->niveau))
                            {{ $item->niveau->nom . ' ' . $item->nom }}
                        @else
                            {{ $item->nom }}
                        @endif
                    @endif
                @endif
            @endif
        </option>
    @endforeach
</select>
