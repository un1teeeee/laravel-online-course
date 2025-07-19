<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
class LoginController extends Controller
{
    public function index(): view
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $validateData = $request->validated();

        try {
            if (Auth::attempt(['email' => $validateData['email'], 'password' => $validateData['password']])) {

                $request->session()->regenerate();

                return redirect()->route('profile');
            } else {

                return back()->withErrors([
                    'email' => 'Неверный логин или пароль.',
                ]);
            }
        } catch (\Exception $e) {

            Log::error('Ошибка аутентификации пользователя: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withErrors([
                'email' => 'Произошла ошибка при входе. Пожалуйста, попробуйте позже.',
            ]);
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        return redirect()->route('home');
    }
}
