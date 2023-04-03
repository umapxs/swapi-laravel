@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-900 focus:border-gray-900 ring-gray-900 rounded-md shadow-sm']) !!}>
