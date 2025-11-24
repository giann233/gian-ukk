<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'member', // Default role for new registrations
            ]);

            event(new Registered($user));

            Auth::login($user);

            // Transfer guest cart to user cart after registration
            \App\Models\Keranjang::transferGuestCartToUser($user->id);

            return redirect(route('login.member', absolute: false));
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Check if it's a unique email validation error
            if ($e->errors() && isset($e->errors()['email'])) {
                session()->flash('register_error', 'Email sudah terdaftar. Silakan gunakan email lain atau login jika sudah memiliki akun.');
            } else {
                session()->flash('register_error', 'Terjadi kesalahan dalam pendaftaran. Silakan coba lagi.');
            }

            return redirect()->back()->withInput($request->except('password', 'password_confirmation'));
        }
    }
}
