<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginSessionController
{
    /**
     * Displays the login form.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Authenticates a user and creates a new session.
     *
     * @param  UserLoginRequest  $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(UserLoginRequest $request): RedirectResponse
    {
        // Validate and retrieve the login credentials
        $attributes = $request->validated();

        // Attempt to authenticate the user
        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match'
            ]);
        }

        // Regenerate the session to prevent session fixation
        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    /**
     * Logs out the authenticated user and terminates the session.
     *
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        // Log out the authenticated user
        Auth::logout();

        return redirect()->route('home');
    }
}
