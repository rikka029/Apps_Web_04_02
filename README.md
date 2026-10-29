# Apps_Web_04_02

## CRUD de productos: peticiones HTTP en Laravel 12

Práctica individual de Aplicaciones Web. La aplicación muestra un listado de productos y permite buscar, filtrar, crear, editar y eliminar productos con Laravel 12, Blade, Bootstrap 5, Sass y Vite.

Los productos se guardan en la sesión del navegador; no se usa una base de datos. Para que las sesiones funcionen sin SQLite, la configuración de ejemplo usa el controlador `file`.

## Requisitos

- PHP 8.2 o superior con Composer
- Node.js y npm

## Instalación en Windows (PowerShell)

```powershell
git clone https://github.com/rikka029/Apps_Web_04_02.git
cd Apps_Web_04_02
composer install
Copy-Item .env.example .env
php artisan key:generate
npm install
```

Abre dos terminales en la carpeta del proyecto. En la primera inicia Laravel:

```powershell
php artisan serve
```

En la segunda inicia Vite:

```powershell
npm run dev
```

Visita `http://127.0.0.1:8000`.

## Funcionalidades y métodos HTTP

| Método | Ruta | Función |
| --- | --- | --- |
| GET | `/productos?buscar=...&categoria=...` | Lista y filtra por nombre y categoría |
| GET | `/productos/create` | Muestra el formulario de alta |
| POST | `/productos` | Valida y crea un producto |
| GET | `/productos/{id}/edit` | Muestra el formulario de edición |
| PUT | `/productos/{id}` | Valida y actualiza un producto |
| DELETE | `/productos/{id}` | Elimina un producto tras confirmación |

Los formularios usan `@csrf`; los formularios de actualización y eliminación simulan PUT y DELETE con `@method`. Los errores de validación se muestran junto a los campos y las operaciones exitosas muestran alertas de Bootstrap.

## Estructura principal

- `routes/web.php`: rutas del recurso `productos`.
- `app/Http/Controllers/ProductoController.php`: filtros, validación y operaciones de sesión.
- `resources/views/layouts/app.blade.php`: layout y alerta global.
- `resources/views/productos/`: listado, alta y edición.
- `resources/sass/app.scss` y `resources/js/app.js`: activos compilados por Vite.

## Compilar los activos

```powershell
npm run build
```
