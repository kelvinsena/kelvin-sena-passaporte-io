@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center my-6">
    <div class="card w-full max-w-md shadow-2xl bg-base-100">
        <form action="{{ route('register') }}" method="POST" class="card-body">
            @csrf
            <h2 class="text-2xl font-bold text-center text-primary mb-4">Criar Nova Conta</h2>

            @if($errors->any())
                <div class="alert alert-error text-white text-sm py-2 mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Nome Completo</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Seu Nome" class="input input-bordered w-full" required />
            </div>php artisan serve

            <div class="form-control mt-2">
                <label class="label">
                    <span class="label-text font-semibold">E-mail</span>
                </label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="seuemail@teste.com" class="input input-bordered w-full" required />
            </div>

            <div class="form-control mt-2">
                <label class="label">
                    <span class="label-text font-semibold">Tipo de Perfil</span>
                </label>
                <select name="role" class="select select-bordered w-full" required>
                    <option value="participante" {{ old('role') == 'participante' ? 'selected' : '' }}>Quero participar de eventos (Participante)</option>
                    <option value="organizador" {{ old('role') == 'organizador' ? 'selected' : '' }}>Quero criar e gerenciar eventos (Organizador)</option>
                </select>
            </div>

            <div class="form-control mt-2">
                <label class="label">
                    <span class="label-text font-semibold">Senha (mínimo 6 caracteres)</span>
                </label>
                <input type="password" name="password" placeholder="••••••••" class="input input-bordered w-full" required />
            </div>

            <div class="form-control mt-2">
                <label class="label">
                    <span class="label-text font-semibold">Confirme a Senha</span>
                </label>
                <input type="password" name="password_confirmation" placeholder="••••••••" class="input input-bordered w-full" required />
            </div>

            <div class="form-control mt-6">
                <button type="submit" class="btn btn-primary w-full text-white">Criar Minha Conta</button>
            </div>

            <p class="text-center text-sm mt-4">
                Já possui uma conta? <a href="{{ route('login') }}" class="link link-primary font-semibold">Faça Login</a>
            </p>
        </form>
    </div>
</div>
@endsection