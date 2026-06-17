<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passaporte.io | Testes ACL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            max-width: 800px;
            width: 100%;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .nav-links a {
            color: #ffffff;
            text-decoration: none;
            margin-left: 20px;
            border: 1px solid #555;
            padding: 8px 16px;
            border-radius: 4px;
        }
        .nav-links a.btn-primary {
            background-color: #ffffff;
            color: #121212;
            border-color: #ffffff;
            font-weight: bold;
        }
        .card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        h1, h2 {
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #333;
        }
        th {
            background-color: #2a2a2a;
        }
        code {
            background-color: #2a2a2a;
            padding: 4px 8px;
            border-radius: 4px;
            font-family: monospace;
        }
        ul {
            margin: 10px 0 0 0;
            padding-left: 20px;
        }
        li {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

    <div class="container">
        
        <div class="header">
            <div class="logo">Passaporte.io</div>
            <div class="nav-links">
                <a href="{{ url('/login') }}">Entrar</a>
                <a href="{{ url('/cadastro') }}" class="btn-primary">Criar Conta</a>
            </div>
        </div>

        <div class="card">
            <h1>Painel de Validacao de Niveis de Acesso</h1>
            <p>Este ambiente serve para testar as regras de seguranca dos Middlewares (ACL) do Laravel. Use as contas abaixo para testar o sistema.</p>
        </div>

        <div class="card">
            <h2>Dados de Acesso (Contas de Teste)</h2>
            <table>
                <thead>
                    <tr>
                        <th>Perfil</th>
                        <th>E-mail</th>
                        <th>Senha</th>
                        <th>Rota Permitida</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Organizador</strong></td>
                        <td><code>organizador@teste.com</code></td>
                        <td><code>senha123</code></td>
                        <td><code>/admin/eventos</code></td>
                    </tr>
                    <tr>
                        <td><strong>Participante</strong></td>
                        <td><code>participante@teste.com</code></td>
                        <td><code>senha123</code></td>
                        <td><code>/meus-ingressos</code></td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>

</body>
</html>