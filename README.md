# Laravel 12 – Gestión de Proyectos y Tareas (API REST)
---

## Requisitos del sistema

- **PHP** 8.3.21
- **Composer** (v2 o superior)
- **Laravel** 12.16
- **XAMPP** 8.2.12 (MySQL + Apache)
- **Navegador moderno** para visualizar las librerías Swagger y Telescope

---

## Instalación paso a paso

### 1. Clona el repositorio: 
	git clone https://github.com/usuario/repositorio.git
	cd repositorio

### 2. Instala dependencias: 
	composer install
### 3. Copia el archivo env: (en windows copiar o crear un .env y copiar de .env.example)
	cp .env.example .env
### 4. Configurar la bd en el .env de esta forma:
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=prueba-overskull-arias
	DB_USERNAME=root
	DB_PASSWORD=
### 5. Genera la clave de la app
	php artisan key:generate
### 6. Ejecutar migraciones 
	php artisan migrate

### 7. Generar documentacion swagger
    php artisan l5-swagger:generate

### 8. Levantar servidor de php :
    php artisan serve

### Acceder a swagger
    http://localhost:8000/api/documentation


### Como probar filtros en Tareas y Proyectos
    ## Tareas
    GET /api/tasks
    Parámetros disponibles:
    status (ej. completed)

    priority (ej. high)

    due_date (formato YYYY-MM-DD)

    project_id (UUID del proyecto)
    Ejemplo :
    GET /api/tasks?status=pending&priority=high

    ## Proyectos
    GET /api/projects

    Parámetros disponibles:

    status (ej. active)

    name (coincidencia parcial)

    from y to (rango de fechas de creación)

    Ejemplo:
    GET /api/projects?status=inactive&from=2024-01-01&to=2024-12-31

## Para acceder a un log de auditorias ingresar a 
    http://localhost:8000/api/audits