@extends('layouts.app')

@section('title', 'Recuperacao de senha')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h3 mb-4">Recuperacao de senha</h1>

                    <form method="POST" action="/recSenha">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Informe seu email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', session('email')) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
