Requisitos: 
    - PHP 8.3^
    - Laravel 12
    - Mysql
    - Composer

Instalacion: 
    1. Tener descargado e instalado PHP
    2. Clonar el repositorio https://github.com/daz081/laravel-mid-level-project-task-api-CristianArias.git
    3. Ejecutar npm install sobre la carpeta donde se clono el proyecto
    4. Clonar .env.example si no existe un archivo .env y colocar 
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=pruebatecnicaarias
    DB_USERNAME=root
    DB_PASSWORD=
    4. Ejecutar php artisan migrate sobre la carpeta del proyecto
    5. Para levantar un servidor local de pruebas ejecutar: php artisan serve