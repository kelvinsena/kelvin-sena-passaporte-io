<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passaporte.io</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-base-200 min-h-screen flex flex-col justify-between">

    <div class="navbar bg-base-100 shadow-md px-4 md:px-8">
        <div class="flex-1">
            <a href="{{ route('home') }}" class="btn btn-ghost text-xl font-bold text-primary">Passaporte.io</a>
        </div>
        <div class="flex-none gap-2">
            @auth
                <span class="text-sm font-medium hidden sm:inline">Olá, <strong>{{ Auth::user()->name }}</strong> ({{ ucfirst(Auth::user()->role) }})</span>
                
                @if(Auth::user()->role === 'organizador')
                    <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-outline btn-accent">Painel Admin</a>
                @else
                    <a href="{{ route('participante.tickets') }}" class="btn btn-sm btn-outline btn-accent">Meus Ingressos</a>
                @endif

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-error text-white">Sair</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-ghost">Login</a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Cadastrar</a>
            @endauth
        </div>
    </div>

    <main class="container mx-auto p-4 md:p-8 flex-grow">
        @if(session('success'))
            <div class="alert alert-success shadow-lg mb-6">
                <div>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error shadow-lg mb-6 text-white">
                <div>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer footer-center p-4 bg-base-300 text-base-content text-sm">
        <aside>
            <p>© 2026 Passaporte.io - Sistema de Gestão de Eventos e Ingressos.</p>
        </aside>
    </footer>

</body>
</html>