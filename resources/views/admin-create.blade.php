<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passaporte.io | Novo Evento</title>
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
            max-width: 600px;
            width: 100%;
        }
        
        /* Topo / Navbar */
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
            letter-spacing: -0.03em;
        }

        .card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 24px 0;
            letter-spacing: -0.02em;
        }

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

        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #cbd5e1;
        }
        input, textarea, select {
            width: 100%;
            padding: 12px;
            background-color: #0f172a;
            border: 1px solid #334155;
            border-radius: 6px;
            color: #ffffff;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.15s ease;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #3b82f6;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: flex;
            gap: 16px;
        }
        .form-row .form-group {
            flex: 1;
        }

        .form-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 32px;
        }
        .btn {
            padding: 10px 24px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.15s ease;
        }
        .btn-cancel {
            background-color: transparent;
            color: #94a3b8;
            border: 1px solid #334155;
        }
        .btn-cancel:hover {
            background-color: #334155;
            color: #ffffff;
        }
        .btn-submit {
            background-color: #3b82f6;
            color: #ffffff;
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
        }
        .btn-submit:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <a href="{{ url('/') }}" class="logo">Passaporte.io</a>
            <a href="{{ route('admin.events.index') }}" style="color: #94a3b8; text-decoration: none; font-size: 14px;">Voltar ao Painel</a>
        </div>

        <div class="card">
            @if(session('status'))
                <div class="alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <h1>Criar Novo Evento</h1>

            <form action="{{ route('admin.events.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="title">Título do Evento</label>
                    <input type="text" id="title" name="title" placeholder="Ex: Workshop de Kotlin para Iniciantes" required>
                </div>

                <div class="form-group">
                    <label for="category">Categoria</label>
                    <select id="category" name="category_id" required>
                        <option value="">Selecione uma categoria</option>
                        <option value="1">Curso</option>
                        <option value="2">Workshop</option>
                        <option value="3">Palestra</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Descrição Detalhada</label>
                    <textarea id="description" name="description" placeholder="Descreva os principais tópicos, pré-requisitos e cronograma do evento..." required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="date_time">Data e Horário</label>
                        <input type="datetime-local" id="date_time" name="date_time" required>
                    </div>
                    <div class="form-group">
                        <label for="capacity">Capacidade (Vagas)</label>
                        <input type="number" id="capacity" name="capacity" placeholder="Ex: 50" min="1" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="location">Localização / Ambiente</label>
                    <input type="text" id="location" name="location" placeholder="Ex: Laboratório 03 - ETEC Zona Leste" required>
                </div>

                <div class="form-footer">
                    <a href="{{ route('admin.events.index') }}" class="btn btn-cancel">Cancelar</a>
                    <button type="submit" class="btn btn-submit">Publicar Evento</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>