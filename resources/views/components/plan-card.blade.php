@props(['plan'])

<div class="flex flex-col align-stretch px-6 py-8 mx-auto lg:mx-0 max-w-lg text-center rounded-lg border shadow border-gray-600 bg-gray-800 text-white">
    <h3 class="mb-4 text-2xl font-semibold">
        {{ $plan->name }}
    </h3>

    <div class="flex justify-center items-baseline my-8">
        <span class="mr-2 text-5xl font-extrabold">
            ${{ $plan->price }}
        </span>

        <span class="text-2xl dark:text-gray-400">
            {{ $plan->billing_cycle }}
        </span>
    </div>

    <ul role="list" class="mb-8 space-y-4 text-left">
        <li class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
            </svg>
            <span>Feature 1</span>
        </li>

        <li class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
            </svg>
            <span>Feature 2</span>
        </li>
    </ul>

    <a href="{{ route('plan.show', $plan->slug) }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        Subscribe
    </a>
</div>


