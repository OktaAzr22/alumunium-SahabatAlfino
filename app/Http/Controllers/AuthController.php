<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255',

                'email' => 'required|email|unique:users,email',

                'password' => 'required|min:6|confirmed',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect('/')
                ->withErrors($e->validator)
                ->withInput()
                ->with('openModal', 'userRegisterModal');
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],

            'password' => $validated['password'],
        ]);

        $user->assignRole('user');

        Auth::login($user);

        return $this->redirectByRole($user);
    }

    public function login(Request $request)
    {
        try {

            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect('/')
                ->withErrors($e->validator)
                ->withInput()
                ->with('openModal', 'userLoginModal');
        }

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return $this->redirectByRole(Auth::user());
        }

        return redirect('/')
            ->withErrors([
                'login' => 'Email atau password salah',
            ])
            ->withInput()
            ->with('openModal', 'userLoginModal');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
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