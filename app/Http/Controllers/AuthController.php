<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],

            // otomatis hash dari model
            'password' => $validated['password'],
        ]);

        $user->assignRole('user');

        Auth::login($user);

        return $this->redirectByRole($user);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return $this->redirectByRole(Auth::user());
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function redirectByRole($user)
    {
        if ($user->hasRole('super_admin')) {
            return redirect('/super-admin');
        }

        if ($user->hasRole('admin')) {
            return redirect('/admin');
        }

        return redirect('/dashboard');
    }
}