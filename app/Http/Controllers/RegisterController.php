<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeUserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $this->validateUser($request);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $this->sendWelcomeEmail($user, $validated);

        return back()->with('success', '¡Usuario registrado con éxito! Correo de bienvenida enviado.');
    }

    protected function validateUser(Request $request): array
    {
        return $request->validate($this->validationRules(), $this->validationMessages());
    }

    protected function validationRules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    protected function validationMessages(): array
    {
        return [
            'email.unique' => 'Este correo electrónico ya se encuentra registrado.',
            'password.confirmed' => 'Las contraseñas ingresadas no coinciden.',
        ];
    }

    protected function sendWelcomeEmail(User $user, array $validated): void
    {
        Mail::to($user->email)->send(new WelcomeUserMail($validated));
    }
}
