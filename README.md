# PharmasysApp

Reescritura del sistema de farmacia y punto de venta [Pharmasys](https://github.com/thealejandro/Pharmasys) sobre Laravel 10, Jetstream y Livewire 3.

- Estado: **alpha** (rama `0.3.0.1-alpha`). No está en producción; el sistema que opera a diario sigue siendo Pharmasys (Laravel 6).
- El último trabajo en esta rama es de diciembre de 2023. La rama `feature/auto-invoicing` (julio de 2026) contiene la facturación automática nocturna que después se portó al repo de producción.

## Relación con otros repos

| Repo | Qué es |
|---|---|
| [XACodev/PharmasysPreview](https://github.com/XACodev/PharmasysPreview) | Prototipo original de 2019 en PHP plano + jQuery. |
| [thealejandro/Pharmasys](https://github.com/thealejandro/Pharmasys) | Sistema en producción (Laravel 6, privado). |
| **thealejandro/PharmasysApp** (este) | Reescritura en Laravel 10 + Livewire, alpha. |
| [thealejandro/xPharma](https://github.com/thealejandro/xPharma) | Esqueleto de 2025 en Laravel 12 + React/TypeScript. |

## Qué hay implementado

- Autenticación completa con Jetstream (Fortify): login, registro, verificación de correo, 2FA, tokens de API con Sanctum, perfil y sesiones. Las pruebas de `tests/Feature` son las que trae Jetstream.
- CRUD vía controladores para los catálogos: categorías, contactos, productos (`items`), laboratorios, encargados (`managers`), proveedores, registros de venta, vendedores y sucursales (`stores`). Las rutas siguen el patrón `recurso`, `recurso/create`, `recurso/{id}/sw`, `recurso/{id}/up`, `DELETE recurso/{id}`.
- Modelo de datos para compras (`purchases`, `purchase_items`, `purchase_balances`), ventas (`sales`, `sale_items`), inventario por sucursal (`inventorie_stores`) y asignación de encargados.
- Componentes Livewire: venta de productos (`SellItems`, `Market/Seller/Sale/TableItem`), selección de productos en modal y actualización de inventario por administrador.
- Pantallas de módulos como vistas Blade (`Route::view`): inventarios, compras, bodega/mercado, envíos, facturación, ajustes, cierres (`settlements`) y vencimientos. Varias son solo maquetas pendientes de lógica.
- Roles y permisos con `spatie/laravel-permission`; seeders `DefaultDataConfig` (usuarios y configuración inicial) y `DataDBTest` (datos de prueba).

Limitaciones conocidas: las rutas de CRUD y de módulos están fuera del grupo `auth:sanctum`, es decir, sin protección de sesión; no hay facturación electrónica en esta rama; los seeders crean usuarios con contraseñas de ejemplo que deben cambiarse.

## Stack

| Componente | Versión |
|---|---|
| PHP | ^8.1 (Sail usa 8.2) |
| Laravel | 10.23 (`composer.lock`) |
| Jetstream / Livewire | 4.x / 3.0.5 |
| Sanctum, spatie/laravel-permission, maatwebsite/excel, WireUI | ^3.2, ^5.5, ^3.1, ^1.18 |
| Front | Blade, Tailwind 3, daisyUI 3.7, Alpine 3.13, Vite 4 |
| Base de datos | MySQL 8 (docker-compose de Sail) |

## Puesta en marcha local

Requisitos: PHP 8.1+ con `ext-soap`, `ext-intl`, `ext-simplexml` y `ext-curl`, Composer, Node 18+, MySQL. Alternativa: Docker con Laravel Sail.

```bash
composer install
cp .env.example .env
php artisan key:generate
# Editar .env: DB_* (el ejemplo apunta a un host ficticio)
php artisan migrate
php artisan db:seed            # DefaultDataConfig + DataDBTest
npm install
npm run dev                    # Vite en desarrollo; npm run build para producción
php artisan serve
```

Con Sail: `./vendor/bin/sail up -d` levanta la app, MySQL, Redis, Meilisearch y Mailpit según `docker-compose.yml`.

## Scripts útiles

| Comando | Para qué |
|---|---|
| `npm run dev` / `npm run build` | Compilar assets con Vite |
| `vendor/bin/phpunit` | Pruebas de Jetstream |
| `vendor/bin/pint` | Formato de código PHP |

## Despliegue

El repo conserva configuración para tres destinos históricos: `Procfile` (Heroku, PHP con Apache), `vercel.json` (Vercel con `vercel-php` y `api/index.php` como entrada) y `docker-compose.yml` (Sail). Ninguno está en uso para esta alpha.

## Estructura

```
app/Http/Controllers/  CRUD de catálogos, compras, ventas e inventario
app/Livewire/          Componentes de venta, selección y actualización de productos
app/Models/            Un modelo por tabla
app/Actions/           Acciones de Fortify y Jetstream
database/migrations/   Esquema (2022-2023)
database/seeders/      DefaultDataConfig, DataDBTest
resources/views/modules/  Pantallas por módulo (inventories, purchases, market, edit, settlements, expirations)
resources/views/livewire/ Vistas de componentes Livewire y datatables
routes/web.php         Rutas de CRUD y de vistas de módulos
```

## Licencia

Software propietario de XACode. Todos los derechos reservados. (El `license: MIT` de `composer.json` pertenece al esqueleto de Laravel.)
