<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:100'],
            'surname' => ['nullable', 'string', 'max:100'],
            'date_of_birth' => ['nullable', 'date_format:Y-m-d'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.string' => 'Il nome deve essere una stringa',
            'name.max' => 'Il nome puù contenere massimo 100 caratteri',

            'email.required' => 'L\'email è obbligatoria',
            'email.string' => 'L\'email deve essere una stringa',
            'email.email' => 'L\'email deve essere un\'indirizzo email valido',
            'email.max' => 'L\'email può contenere al massimo 255 caratteri',

            'surname.string' => 'Il cognome deve essere una stringa',
            'surname.max' => 'Il cognome puù contenere massimo 100 caratteri',

            'date_of_birth.date_format' => 'La data deve avere il formato Y-m-d',
        ]);

        $user = User::create([
            // 'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}