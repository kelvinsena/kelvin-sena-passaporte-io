<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passaporte.io | Meus Ingressos</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            letter-spacing: -0.01em;
        }
        .container {
            max-width: 900px;
            width: 100%;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #1e293b;
            padding-bottom: 24px;
            margin-bottom: 32px;
        }
        .logo {
            font-size: 22px;
            font-weight: 800;
            color: #3b82f6;
            text-decoration: none;
        }
        .nav-links button {
            color: #94a3b8;
            background: transparent;
            border: 1px solid #334155;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }
        
        /* Alertas */
        .alert-success {
            background-color: #065f46;
            border: 1px solid #10b981;
            color: #34d399;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Grid de Eventos */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 24px;
        }
        .event-card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }
        .badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #065f46;
            color: #34d399;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 20px;
            text-transform: uppercase;
        }
        .event-title {
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 10px 0;
            color: #ffffff;
            padding-right: 60px;
        }
        .event-desc {
            font-size: 13px;
            color: #94a3b8;
            margin: 0 0 16px 0;
            line-height: 1.4;
        }
        .event-meta {
            font-size: 12px;
            color: #cbd5e1;
            margin-bottom: 6px;
        }
        
        /* Botões de Ação */
        .btn-action {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            margin-top: 16px;
            font-family: inherit;
            transition: background 0.15s;
        }
        .btn-subscribe {
            background-color: #3b82f6;
            color: #ffffff;
        }
        .btn-subscribe:hover { background-color: #2563eb; }
        
        .btn-unsubscribe {
            background-color: #111827;
            color: #f87171;
            border: 1px solid #f87171;
        }
        .btn-unsubscribe:hover { background-color: #7f1d1d; color: #ffffff; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <div class="logo">Passaporte.io</div>
            <div class="nav-links">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Sair da Conta</button>
                </form>
            </div>
        </div>

        @if(session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div style="margin-bottom: 8px;">
            <h1 style="font-size: 26px; margin: 0;">Vitrine de Eventos</h1>
            <p style="color: #94a3b8; margin: 4px 0 0 0; font-size: 14px;">Inscreva-se nos eventos disponíveis ou gerencie suas vagas reservadas.</p>
        </div>

        <div class="events-grid">
            @if($eventos->isEmpty())
                <div style="grid-column: 1/-1; text-align: center; color: #94a3b8; padding: 40px 0;">
                    Nenhum evento disponível na plataforma no momento.
                </div>
            @else
                @foreach($eventos as $evento)
                    <div class="event-card">
                        <div>
                            @if(in_array($evento->id, $meusEventosIds))
                                <span class="badge">Inscrito</span>
                            @endif

                            <h3 class="event-title">{{ $evento->title }}</h3>
                            <p class="event-desc">{{ Str::limit($evento->description, 100) }}</p>
                        </div>

                        <div>
                            <div class="event-meta">📅 {{ \Carbon\Carbon::parse($evento->date_time)->format('d/m/Y - H:i') }}</div>
                            <div class="event-meta">📍 {{ $evento->location }}</div>
                            <div class="event-meta">👥 Capacidade: {{ $evento->capacity }} vagas</div>

                            @if(in_array($evento->id, $meusEventosIds))
                                <form action="{{ route('events.unsubscribe', $evento->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-unsubscribe">Cancelar Inscrição</button>
                                </form>
                            @else
                                <form action="{{ route('events.subscribe', $evento->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-action btn-subscribe">Garantir Minha Vaga</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

</body>
</html>