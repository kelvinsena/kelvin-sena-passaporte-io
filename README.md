##  Configuração e Instalação

Siga o passo a passo abaixo para rodar a aplicação localmente no seu ambiente de desenvolvimento:

# Acesse a pasta do projeto
cd passaporte-io

# Instale as dependências do Composer
composer install 


Duplique o arquivo de configurações padrão:
cp .env.example .env

DB_CONNECTION=sqlite
# O Laravel criará automaticamente o banco de dados sqlite em database/database.sqlite

 Gerar a chave de segurança
 php artisan key:generate

 Tabelas do banco de dados
 php artisan migrate --seed

 Inicie o Servidor
 php artisan serve
