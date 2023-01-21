<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installation

Clonar el repositorio:

```sh
git clone https://github.com/FerEscobarDev/usersCrud.git usersCrud
cd usersCrud
```

Instalar dependencias PHP:

```sh
composer install
```

Instalar dependencias NPM:

```sh
npm ci
```

Build assets:

```sh
npm run dev
```

Configuración:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Crear una base de datos SQLite, puedes usar la que prefieras y configurar el archivo .env acorde a la BD.
Si usas SQLite recuerda tener las extenciones de pdo_sqlite habilitadas

```sh
touch database/database.sqlite
```

Correr las migraciones:

```sh
php artisan migrate
```

Correr seeders:

```sh
php artisan db:seed
```

Ejecuta el servidor:

```sh
php artisan serve
```

Para iniciar sesión:

- **Username:** admin@prueba.com
- **Password:** PasswordAdmin
