<select {{ $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}>
    
    @if (isset($val))
        <option selected hidden value="{{ $val->id }}">
            @if (isset($val->niveau))
                {{ $val->niveau . " " . $val->nom }}
            @else
                {{ $val->nom }}
            @endif
        </option>
    @else
        <option disabled selected hidden>Select an option</option>
    @endif

    @foreach ($collection as $item)
    <option value="{{ $item->id }}">
        @if (isset($item->trimestre))
            {{$item->nom . " " . $item->trimestre->annee_scolaire->nom}}
        @else
            @if (isset($item->annee_scolaire))
                {{$item->nom . " " . $item->annee_scolaire->nom}}
            @else
                @if (isset($item->niveau))
                {{$item->niveau . " " . $item->nom}}
                @else
                    {{$item->nom}}
                @endif
            @endif
        @endif
    </option>
    @endforeach
</select>
