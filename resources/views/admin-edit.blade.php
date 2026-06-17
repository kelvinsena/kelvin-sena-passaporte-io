<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passaporte.io | Editar Evento</title>
    <style>
        body { font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif; background-color: #0f172a; color: #f8fafc; margin: 0; padding: 40px 20px; display: flex; justify-content: center; }
        .container { max-width: 600px; width: 100%; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #1e293b; padding-bottom: 24px; margin-bottom: 32px; }
        .logo { font-size: 22px; font-weight: 800; color: #3b82f6; text-decoration: none; }
        .card { background-color: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 32px; }
        h1 { font-size: 24px; margin: 0 0 24px 0; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #cbd5e1; }
        input, textarea, select { width: 100%; padding: 12px; background-color: #0f172a; border: 1px solid #334155; border-radius: 6px; color: #ffffff; font-size: 14px; box-sizing: border-box; }
        input:focus, textarea:focus, select:focus { outline: none; border-color: #3b82f6; }
        .form-footer { display: flex; justify-content: flex-end; gap: 12px; margin-top: 32px; }
        .btn { padding: 10px 24px; border-radius: 6px; font-weight: 600; font-size: 14px; cursor: pointer; text-decoration: none; border: none; }
        .btn-cancel { background-color: transparent; color: #94a3b8; border: 1px solid #334155; }
        .btn-submit { background-color: #fbbf24; color: #0f172a; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <a href="{{ url('/') }}" class="logo">Passaporte.io</a>
            <a href="{{ route('admin.events.index') }}" style="color: #94a3b8; text-decoration: none; font-size: 14px;">Voltar</a>
        </div>

        <div class="card">
            <h1>Editar Evento</h1>

            <form action="{{ route('admin.events.update', $evento->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Título do Evento</label>
                    <input type="text" id="title" name="title" value="{{ $evento->title }}" required>
                </div>

                <div class="form-group">
                    <label for="category">Categoria</label>
                    <select id="category" name="category_id" required>
                        <option value="1" {{ $evento->category_id == 1 ? 'selected' : '' }}>Curso</option>
                        <option value="2" {{ $evento->category_id == 2 ? 'selected' : '' }}>Workshop</option>
                        <option value="3" {{ $evento->category_id == 3 ? 'selected' : '' }}>Palestra</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Descrição Detalhada</label>
                    <textarea id="description" name="description" required>{{ $evento->description }}</textarea>
                </div>

                <div style="display: flex; gap: 15px;">
                    <div class="form-group" style="flex: 1;">
                        <label for="date_time">Data e Horário</label>
                        <input type="datetime-local" id="date_time" name="date_time" value="{{ date('Y-m-d\TH:i', strtotime($evento->date_time)) }}" required>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label for="capacity">Capacidade (Vagas)</label>
                        <input type="number" id="capacity" name="capacity" value="{{ $evento->capacity }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="location">Localização</label>
                    <input type="text" id="location" name="location" value="{{ $evento->location }}" required>
                </div>

                <div class="form-footer">
                    <a href="{{ route('admin.events.index') }}" class="btn btn-cancel">Cancelar</a>
                    <button type="submit" class="btn btn-submit">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>