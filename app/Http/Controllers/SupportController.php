<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:150',
        ]);

        $support = new Support();
        $support->name = $validated['name'];
        $support->phone = $validated['phone'];
        $support->email = $validated['email'];
        $support->user_id = Auth::check() ? Auth::id() : null;
        $support->message = null;
        $support->save();

        return redirect()->back()->with('success', 'Ваш запрос успешно отправлен!');
    }
}
