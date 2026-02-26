@extends('layouts.app')

@section('title', 'Cadastro')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h3 mb-4">Cadastro</h1>

                    <form method="POST" action="/register">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                    </form>

                    <p class="mt-3 mb-0 text-center">Ja tem uma conta? <a href="/login">Entrar</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
