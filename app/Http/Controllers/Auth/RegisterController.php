<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function index(): view
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $validateData = $request->validated();

        try {
            DB::beginTransaction();

            $validateData['password'] = Hash::make($validateData['password']);

            $user = new User($validateData);

            $user->save();

            Auth::login($user);

            DB::commit();


            return redirect()->route('profile');

        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('error', 'Ошибка регистрации, попробуйте еще раз');
        }
    }
}
