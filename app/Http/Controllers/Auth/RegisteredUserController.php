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
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
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
            'email.unique' => 'Esiste già questo indirizzo email',

            'password.required' => 'La password è obbligatoria',
            'password.min' => 'La password deve essere di almeno 8 caratteri',
            'password.confirmed' => 'La password non corrisponde',

            'surname.string' => 'Il cognome deve essere una stringa',
            'surname.max' => 'Il cognome puù contenere massimo 100 caratteri',

            'date_of_birth.date_format' => 'La data deve avere il formato Y-m-d',
        ]);

        $validated_data = $validator->validated();

        // Creo User con dati per il login
        $user = User::create([
            // 'name' => $request->name,
            'email' => $validated_data['email'],
            'password' => $validated_data['password'],
        ]);

        // Creo UserDetail con dati personali sfruttando la relazione tra le due tabelle
        $user_detail = $user->user_detail()->create([
            'name' => $validated_data['name'],
            'surname' => $validated_data['surname'],
            'date_of_birth' => $validated_data['date_of_birth'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Reindirizzo al frontend
        // return redirect('http://localhost:5174');
        
        return redirect(RouteServiceProvider::HOME);
    }
}