# 🎮 GameStore - Full Stack App

Aplicación web de tienda de videojuegos desarrollada con:

⚙️ Backend: Laravel (API REST)

🎨 Frontend: React

🔐 Autenticación: Laravel Passport (OAuth2)

🗄️ Base de datos: MySQL

🚀 Instalación del proyecto
📦 1. Clonar repositorio
git clone https://github.com/lxcxsito/Sprint5-IA-ApiRest.git
cd gamestore
🛠️ BACKEND (Laravel API)
📍 Ir al backend
cd backend
📥 Instalar dependencias
composer install
⚙️ Configurar entorno
cp .env.example .env

Editar .env con tus datos de base de datos:

DB_DATABASE=gamestore
DB_USERNAME=root
DB_PASSWORD=
🔑 Generar clave
php artisan key:generate
🗄️ Base de datos
php artisan migrate

(Opcional: con datos de prueba)

php artisan db:seed
🔐 Configurar Laravel Passport
php artisan passport:install

Esto generará las claves necesarias para la autenticación OAuth2.

Asegúrate de tener en tu modelo User:

use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
}

Y en config/auth.php:

'guards' => [
    'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
],
▶️ Ejecutar servidor
php artisan serve

API disponible en:

http://localhost:8000
🎨 FRONTEND (React)
📍 Ir al frontend
cd frontend
📥 Instalar dependencias
npm install
⚙️ Configurar API

En src/services/api.js:

const API_URL = "http://localhost:8000/api";
▶️ Ejecutar frontend
npm run dev

o si usas CRA:

npm start

Frontend disponible en:

http://localhost:3000
🔐 Autenticación

El sistema usa Laravel Passport con tokens Bearer:

Login guarda el token en localStorage

Axios lo envía automáticamente en cada request

Logout elimina el token

Ejemplo header:

Authorization: Bearer {token}
📌 Funcionalidades
👤 Usuario

Registro

Login / Logout

Ver juegos

Comprar juegos

Biblioteca personal

📊 Estadísticas

⭐ Top Rated Games

🛒 Most Sold Games

🏆 Top Buyers

🔑 Admin

Gestión de juegos

Gestión de compras

🧠 Estructura del proyecto
gamestore/
│
├── backend/        # Laravel API
│
└── frontend/       # React App
⚠️ Problemas comunes
❌ No funciona autenticación

Ejecuta:

php artisan passport:install
❌ Error 401 (Unauthorized)

Verifica que el token exista en localStorage

Revisa interceptor de Axios

❌ CORS error

Instalar/configurar:

php artisan config:clear

y revisar config/cors.php

👨‍💻 Autor

Proyecto desarrollado como práctica Full Stack 🚀