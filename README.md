Proyecto API Client con Laravel y Vue.js
Este proyecto consiste en un cliente API desarrollado con Vue.js (frontend) y un servidor API desarrollado con Laravel (backend). Sigue estas instrucciones para configurar y ejecutar el proyecto en tu entorno local.

Requisitos previos
Tener instalado:

Git
PHP (versión 7.4 o superior)
Composer
Node.js y npm (versión 14 o superior)
Docker y Docker Compose (opcional, si deseas usar contenedores)
Crear un repositorio en GitHub llamado api-client-karavek-vue y clonarlo en tu máquina local:

git clone https://github.com/tu_usuario/api-client-karavek-vue.git
cd api-client-karavek-vue
Dentro del repositorio, crea dos carpetas:

backend: Para el código del servidor Laravel.
frontend: Para el código del cliente Vue.js.
Configuración
Backend (Laravel)
Entra a la carpeta backend:

cd backend
Instala las dependencias de Laravel:

composer install
Crea un archivo .env basado en .env.example y configura los detalles de conexión a la base de datos:

cp .env.example .env
Genera la clave de la aplicación:

php artisan key:generate
Configura y migra la base de datos:

php artisan migrate
Inicia el servidor de desarrollo:

php artisan serve
El servidor estará disponible en http://localhost:8000.

Frontend (Vue.js)
Entra a la carpeta frontend:


cd frontend
Instala las dependencias:


npm install
Inicia el servidor de desarrollo:

npm run serve
El cliente estará disponible en http://localhost:8080.

Ejecución con Docker (opcional)
En la raíz del proyecto, asegúrate de tener un archivo docker-compose.yml configurado correctamente.
Levanta los contenedores con:

docker-compose up -d
Accede al frontend en http://localhost:8080 y al backend en http://localhost:8000.

Comandos útiles

Backend

Iniciar el servidor: php artisan serve
Migrar la base de datos: php artisan migrate
Crear clave de la app: php artisan key:generate

Frontend

Iniciar el cliente: npm run serve
Instalar dependencias: npm install
Créditos
Proyecto desarrollado por [Mark Wang].