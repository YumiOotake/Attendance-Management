<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.user_create');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        User::create([
            'login_id' => $request->login_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        // ホームページにリダイレクト
        return redirect()->route('admin.users');
    }
}
