@extends('layouts.app')

@section('title', 'Editar usuario')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Editar usuario #{{ $user->id }}</h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nova senha (opcional)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar</a>
                            <button type="submit" class="btn btn-primary">Salvar alteracoes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
