<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $sort = (string) $request->query('sort', 'desc');

        if (!in_array($sort, ['asc', 'desc'], true)) {
            $sort = 'desc';
        }

        $query = User::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    if (ctype_digit($search)) {
                        $subQuery->where('id', (int) $search)->orWhere('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                        return;
                    }

                    $subQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            });

        if ($sort === 'asc') {
            $query->orderBy('id');
        } else {
            $query->orderByDesc('id');
        }

        $users = $query
            ->paginate(10)
            ->withQueryString();

        return view('dashboard', compact('users', 'search', 'sort'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('dashboard')->with('success', 'Usuario atualizado com sucesso.');
    }

    public function destroy(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()->route('dashboard')->with('error', 'Voce nao pode excluir seu proprio usuario.');
        }

        $user->delete();

        return redirect()->route('dashboard')->with('success', 'Usuario removido com sucesso.');
    }
}
