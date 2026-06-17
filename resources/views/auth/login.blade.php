@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center my-12">
    <div class="card w-full max-w-sm shadow-2xl bg-base-100">
        <form action="{{ route('login') }}" method="POST" class="card-body">
            @csrf
            <h2 class="text-2xl font-bold text-center text-primary mb-4">Entrar no Passaporte.io</h2>

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
                    <span class="label-text font-semibold">E-mail</span>
                </label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="seuemail@teste.com" class="input input-bordered w-full" required />
            </div>

            <div class="form-control mt-2">
                <label class="label">
                    <span class="label-text font-semibold">Senha</span>
                </label>
                <input type="password" name="password" placeholder="••••••••" class="input input-bordered w-full" required   />
            </div>

            <div class="form-control mt-6">
                <button type="submit" class="btn btn-primary w-full text-white">Fazer Login</button>
            </div>

            <p class="text-center text-sm mt-4">
                Não tem uma conta? <a href="{{ route('register') }}" class="link link-primary font-semibold">Cadastre-se aqui</a>
            </p>
        </form>
    </div>
</div>
@endsection