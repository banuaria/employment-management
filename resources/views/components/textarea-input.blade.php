@props(['disabled' => false, 'rows'])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['rows' => $rows ?? 4, 'class' => 'border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}></textarea>