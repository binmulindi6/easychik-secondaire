@props(['disabled' => false, 'submitOnChange' => false])

@if (isset($submitOnChange) && $submitOnChange === true)
    <input onchange="this.form.submit()" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!} required>
@else
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!} {{isset($not_required) ? '' : 'required'}}>
@endif