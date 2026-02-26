@extends('layouts.app')

@section('title' , 'dashboard')

@section('content')

    <div class="mt-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center gap-3 flex-wrap">
                <h4 class="mb-0">Lista de usuarios</h4>
                <form class="d-flex gap-2 align-items-center flex-wrap" role="search" method="GET" action="{{ route('dashboard') }}">
                    <input class="form-control" style="width: 240px;" name="search" type="search" placeholder="Pesquisar" value="{{ $search ?? '' }}" aria-label="Pesquisar">
                    <button class="btn btn-outline-success" type="submit">Pesquisar</button>
                </form>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th width="220">Acoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-success btn-sm">Editar</a>

                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuario?')">Deletar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Nenhum usuario encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
