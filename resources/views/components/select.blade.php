<select {{ $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}>
    
    
    <option disabled selected >Select an option</option>
    @foreach ($collection as $item)
    <option value="{{ $item->id }}">
        @if (isset($item->annee_scolaire))
            {{$item->nom . " " . $item->annee_scolaire->nom}}
        @else
            @if (isset($item->niveau))
            {{$item->niveau . " " . $item->nom}}
            @else
                {{$item->nom}}
            @endif
        @endif
    
    </option>
    @endforeach
</select>
