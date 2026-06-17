<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passaporte.io | Painel do Organizador</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
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
        .card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }
        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h1 { font-size: 24px; margin: 0 0 6px 0; }
        h2 { font-size: 18px; margin: 0 0 16px 0; color: #cbd5e1; }
        p { margin: 0; color: #94a3b8; font-size: 14px; }
        .btn-action {
            background-color: #3b82f6;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            font-size: 14px;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { text-align: left; padding: 14px 16px; }
        th { background-color: #111827; color: #94a3b8; font-size: 12px; text-transform: uppercase; font-weight: 700; }
        td { border-bottom: 1px solid #334155; font-size: 14px; color: #e2e8f0; }
        .event-title { font-weight: 600; color: #ffffff; }
        .actions-cell { display: flex; gap: 16px; align-items: center; }
        .btn-edit { color: #fbbf24; text-decoration: none; font-size: 13px; font-weight: 500; }
        .btn-delete { color: #f87171; background: none; border: none; padding: 0; font-size: 13px; font-weight: 500; cursor: pointer; font-family: inherit; }
        .btn-delete:hover, .btn-edit:hover { text-decoration: underline; }
        .alert-success { background-color: #065f46; border: 1px solid #10b981; color: #34d399; padding: 16px; border-radius: 8px; margin-bottom: 24px; font-size: 14px; font-weight: 600; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <div class="logo">Passaporte.io</div>
            <div class="nav-links">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Sair do Painel</button>
                </form>
            </div>
        </div>

        @if(session('status'))
            <div class="alert-success">{{ session('status') }}</div>
        @endif

        <div class="card card-header-flex">
            <div>
                <h1>Painel do Organizador</h1>
                <p>Gerenciamento de eventos cadastrados sob sua responsabilidade.</p>
            </div>
            <a href="{{ route('admin.events.create') }}" class="btn-action">Criar Evento</a>
        </div>

        <div class="card">
            <h2>Lista de Eventos Ativos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Título do Evento</th>
                        <th>Data e Horário</th>
                        <th>Capacidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if($eventos->isEmpty())
                        <tr>
                            <td colspan="4" style="text-align: center; color: #94a3b8;">Nenhum evento cadastrado no momento.</td>
                        </tr>
                    @else
                        @foreach($eventos as $evento)
                            <tr>
                                <td class="event-title">{{ $evento->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($evento->date_time)->format('d/m/Y H:i') }}</td>
                                <td>{{ $evento->capacity }} vagas</td>
                                <td class="actions-cell">
                                    <a href="{{ route('admin.events.edit', $evento->id) }}" class="btn-edit">Editar</a>
                                    
                                    <form action="{{ route('admin.events.destroy', $evento->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Deseja realmente excluir este evento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>