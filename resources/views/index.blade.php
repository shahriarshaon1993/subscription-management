<x-layout>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <x-form-heading title="Pricing" description="Choose an affordable plan that’s packed with the best features"/>

        <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0 mt-12">
            @foreach($plans as $plan)
                <x-plan-card :plan="$plan" />
            @endforeach
        </div>
</x-layout>
