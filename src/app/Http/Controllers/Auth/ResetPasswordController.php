<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    // Mostra o formulário de reset (com o token)
    public function showResetForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    // Processa o reset
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect('/login')->with('success', 'Senha redefinida com sucesso!');
        } else {
            return back()->withErrors(['email' => 'Não conseguimos redefinir a senha.']);
        }
    }
}