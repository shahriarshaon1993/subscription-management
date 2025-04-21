@props(['error' => false])

@if ($error)
    <p class="text-red-500 text-sm mt-1">{{ $error }}</p>
@endif
