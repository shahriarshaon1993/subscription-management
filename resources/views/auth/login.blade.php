<x-layout>
    <x-form-heading title="Login" description="Sign in to your account"/>

    <x-forms.form method="POST" action="{{ route('login') }}">
        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
            <div class="col-span-2 space-y-4">
                <x-forms.input label="Email" name="email" type="email" placeholder="Your email"/>
                <x-forms.input label="Password" name="password" type="password" placeholder="Your password"/>
            </div>
        </div>
        <div class="mt-4">
            <x-forms.button type="submit">Log In</x-forms.button>
        </div>
    </x-forms.form>
</x-layout>
