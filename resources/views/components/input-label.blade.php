@props(['value', 'required' => false ])
<div class="{{ $required ? 'flex' : '' }}">
    <label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
        {{ $value ?? $slot }}
    </label>
    @if($required)
    <span class="text-red-500">*</span>
    @endif
</div>
