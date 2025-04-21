<x-layout>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <x-form-heading :title="$plan->name" :description="$plan->description"/>

    <x-forms.form method="POST" action="{{ route('plan.buy', $plan->slug) }}">
        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
            <div class="col-span-2 space-y-4">
                <x-forms.input label="Name" name="name" type="text" placeholder="Your name"/>
                <x-forms.input label="Email" name="email" type="text" placeholder="Your email"/>
                <x-forms.input label="Password" name="password" type="password" placeholder="Your password"/>
                <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" placeholder="Re-type password"/>
            </div>
        </div>
        <div class="mt-4">
            <x-forms.button class="block w-full" type="submit">Create Account & Proceed to Payment</x-forms.button>
        </div>
    </x-forms.form>
</x-layout>
