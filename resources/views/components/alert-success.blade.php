@props(['messages'])

@if (session('success'))
    <div {{ $attributes->merge(['class' => 'text-sm text-green-600 space-y-1']) }}>{{ session('success') }}</div>
@endif
