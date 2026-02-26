<?php

namespace App\Http\Controllers\Auth;  // muito importante!

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Mostra o formulário
    public function show()
    {
        return view('register');
    }

    
    // Processa o cadastro
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Verifica se o email já existe
        $userExists = User::where('email', $request->email)->first();

        if ($userExists) {
        // Se já existe, redireciona para login com mensagem
            return redirect('/login')->with('info', 'Email já cadastrado! Faça login.')-> with('email', $request->email);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Cadastro realizado com sucesso!');
    }
}