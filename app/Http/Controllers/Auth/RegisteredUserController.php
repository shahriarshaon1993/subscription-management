<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\UserRegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredUserController
{
    /**
     * Show the registration form.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  UserRegisterRequest  $request
     * @return RedirectResponse
     */
    public function store(UserRegisterRequest $request): RedirectResponse
    {
        // Get the validated attributes from the request
        $attributes = $request->validated();

        // Retrieve the 'subscriber' role from the roles table
        $role = Role::query()->where('name', 'subscriber')->first();

        // Create a new user with the validated attributes
        $user = User::query()->create($attributes);

        // Assign the 'subscriber' role to the newly created user
        $user->roles()->attach($role->id);

        // Log the user in
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registration successful!');
    }
}
