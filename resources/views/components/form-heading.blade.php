@props(['title', 'description'])

<div class="mx-auto max-w-2xl text-center">
    <h2 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl">
        {{ $title }}
    </h2>
    <p class="mt-2 text-lg/8 text-gray-600">{{ $description }}</p>
</div>
