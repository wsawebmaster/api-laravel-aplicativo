## 🧩 API em Laravel 11 + React Native

API em Laravel 11 que fornece o backend para um aplicativo de gerenciamento financeiro desenvolvido em React Native.

## ⚙️ Requisitos

- PHP 8.2+
- MySQL 8+
- Composer

## 🛠️ Instalação (rápido)

1. Clone o repositório

```bash
git clone --branch dev-master https://github.com/wsawebmaster/api-laravel-aplicativo.git .
```

2. Instale dependências PHP

```bash
composer install
```

3. Copie o arquivo de ambiente

```bash
cp .env.example .env    # Unix / Git Bash
copy .env.example .env  # Windows CMD
```

4. Gere a chave da aplicação

```bash
php artisan key:generate
```

5. Configure `.env` (credenciais do banco de dados, host, porta, etc.)

6. Execute migrações e seeds (se houver)

```bash
php artisan migrate
```

7. Informações adicionais

Criar a migration
```
php artisan make:migration create_name_table
```
```
php artisan make:migration create_bills_table
```

Executar as migration
```
php artisan migrate
```
## ▶️ Executando localmente

```bash
php artisan serve
```

A API estará disponível em `http://127.0.0.1:8000` por padrão. [Listar usuários](http://127.0.0.1:8000/api/user)

## 🔧 Comandos úteis

- Instalar dependências: `composer install`
- Gerar chave: `php artisan key:generate`
- Rodar servidor: `php artisan serve`
- Migrar banco: `php artisan migrate`

## 📄 Estrutura resumida

- `app/` — código da aplicação (Models, Http/Controllers, Providers)
- `routes/` — definição de rotas (`api.php`, `web.php`)
- `database/` — migrations, seeders e factories
- `resources/` — views, assets (CSS/JS)

## 👨🏻‍💻 Contato

<p style="padding-top:5px">
	<img src="https://avatars.githubusercontent.com/u/52001930?s=400&u=fb999c966c5c652a8357cbede4b1112e79cbfe18&v=4" alt="avatar" style="width:96px;height:96px;border-radius:50%;object-fit:cover;">

<p>&nbsp&nbsp&nbsp Wagner Andrade<br>
    &nbsp&nbsp&nbsp
    <a href="https://github.com/wsawebmaster">
    GitHub</a>&nbsp;|&nbsp;
    <a href="https://www.linkedin.com/in/
wsawebmaster">LinkedIn</a>
&nbsp;|&nbsp;
<a href="mailto:wsawebmaster@yahoo.com.br">
    Email</a>
  &nbsp;|&nbsp;
</p>

