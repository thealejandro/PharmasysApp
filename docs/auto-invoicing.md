# Facturación automática de "Clientes Varios" (FEL)

Automatiza la facturación diaria que hoy se hace a mano: extraer las ventas del día
del sistema origen, cargarlas en `items_invoice_days` y emitir un DTE por tienda ante
la SAT (FEL). El objetivo final es que corra **sola cada noche a las 23:55** (hora de
Guatemala) y notifique el resultado.

> ⚠️ **Esto emite facturación fiscal REAL ante la SAT.** Nada se activa solo hasta
> validarlo. Ver *Fase 3*.
>
> 🔒 **Este archivo NO contiene credenciales.** Los valores reales (hosts, usuarios,
> contraseñas, NIT/emisor) viven **solo** en el `.env` local y en las Config Vars de
> Heroku, que están fuera de git. Nunca pongas valores reales aquí (el repo es público).

---

## 1. Qué se agregó (rama `feature/auto-invoicing`)

| Archivo | Cambio |
|---|---|
| `app/Console/Commands/InvoicesDaily.php` | **Nuevo.** Comando `invoices:daily`. |
| `app/Http/Controllers/SoapFELController.php` | Refactor **retrocompatible**: `certificateDTE()` y `generateXMLtoCertificate()` aceptan `?string $emissionDate`. Si es `null`, se comportan igual que antes (botón manual). Además los `Auth::user()` ahora son *null-safe* (`Auth::check()`), para no truenar en un cron sin sesión. |
| `app/Console/Kernel.php` | Entrada de `schedule()` para las 23:55 — **comentada a propósito** (se activa en Fase 3). |

El comando **reutiliza la misma lógica del botón manual** (`SalesTable::generateInvoices`)
para garantizar paridad fiscal: el único cambio es *de dónde sale la fecha de emisión*
(se inyecta por parámetro en vez de leer `FEL_DATE` + rol de `Auth`).

### El comando

```
php artisan invoices:daily {fecha?} {--dry-run} {--time=HH:MM:SS} {--no-reload}
```

- `fecha` — `Y-m-d`. Por defecto hoy (America/Guatemala).
- `--dry-run` — hace ETL y **arma el XML del DTE, pero NO emite** ante la SAT (guarda el XML en `storage/app/dte-dryrun/` para revisar).
- `--time` — hora de emisión (por defecto, la hora actual).
- `--no-reload` — no re-extrae del origen; factura lo que ya está en `items_invoice_days`.
- `--cf-limit` — tope en GTQ por factura CF/Clientes Varios (default **2499**). La SAT rechaza una factura CF desde Q2,500, así que si una tienda vende más, se **divide en varias facturas** por debajo del tope.

Qué hace, en orden:
1. **Extrae** del origen (conexión `pharmaWeb`) las ventas de la fecha (query *Ventas Diarias*, por rango `[fecha, fecha+1)`).
2. **Carga** en `items_invoice_days` (`TRUNCATE` + `INSERT`, en transacción).
3. **Factura** por tienda con `SoapFELController::certificateDTE()`, inyectando la fecha de emisión.
   Si el total de una tienda alcanza el tope CF (`--cf-limit`, default Q2,499), **divide en
   varias facturas** por debajo del tope (regla SAT: CF/Clientes Varios no puede desde Q2,500).
   Los nombres de producto se **escapan para XML** (`&`, `<`, `>`, comillas) para no romper el DTE.
4. **Idempotencia**: no re-emite si ya existe un DTE para esa tienda+fecha (`fel_invoices`),
   y limpia `items_invoice_days` por tienda tras emitir con éxito. Además un *lock* evita
   corridas simultáneas/dobles.
5. **Notifica** por correo (si `INVOICE_NOTIFY_EMAIL` está definido) y deja todo en el log.

---

## 2. Variables de entorno requeridas

Definir en Heroku (app `pharmasysapp`) y en el `.env` local de pruebas. **Usa los valores
reales de tu entorno, no los pongas en git.**

```dotenv
# Conexión al sistema ORIGEN (Pharmasys Web / RDS) -> conexión `pharmaWeb`
DB_HOST_2=<RDS_HOST>
DB_PORT_2=3306
DB_DATABASE_2=<RDS_DATABASE>
DB_USERNAME_2=<RDS_USER>
DB_PASSWORD_2=<RDS_PASSWORD>

# Opcional: correo de aviso del resultado nocturno
INVOICE_NOTIFY_EMAIL=<tu-correo>
```

> `FEL_DATE` deja de ser necesaria para el flujo automático (la fecha se inyecta).
> El botón manual la sigue usando; no la quites hasta migrar del todo.

---

## 3. Entorno local para validar (desde cualquier máquina)

PharmasysApp es **Laravel 8.65 / Livewire 2.9**. El lockfile exige **PHP 8.0/8.1**
(`nette/schema` requiere `>=7.1 <8.2`), así que **PHP 8.4 no sirve**.

```bash
# 1) PHP 8.1 (macOS/Homebrew). Puedes tener varias versiones a la vez.
brew install php@8.1
alias php81="/usr/local/opt/php@8.1/bin/php"   # usar php 8.1 solo para este proyecto

# 2) Dependencias
cd PharmasysApp
php81 $(which composer) install

# 3) MySQL local (arrancar el servidor ya instalado, o via brew)
mysql -h127.0.0.1 -uroot -e "CREATE DATABASE IF NOT EXISTS pharmasysapp;"

# 4) .env de pruebas: DESTINO = local, ORIGEN = RDS (solo lectura)
cp .env.example .env    # y editar con tus valores reales (ver abajo)
php81 artisan key:generate
php81 artisan migrate    # crea stores, items_invoice_days, fel_invoices, ...

# 5) Copiar el catálogo de tiendas (con dataFEL) desde el destino remoto a local,
#    porque el XML del DTE necesita stores.dataFEL real:
mysqldump -h <STACKHERO_HOST> -uroot -p pharmasysapp stores \
  | mysql -h127.0.0.1 -uroot pharmasysapp
```

`.env` local de pruebas — claves relevantes (rellena con tus valores reales):

```dotenv
APP_ENV=local
APP_DEBUG=true
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=pharmasysapp
DB_USERNAME=root
DB_PASSWORD=
# Origen (lectura):
DB_HOST_2=<RDS_HOST>
DB_DATABASE_2=<RDS_DATABASE>
DB_USERNAME_2=<RDS_USER>
DB_PASSWORD_2=<RDS_PASSWORD>
# FEL (para armar el XML; en dry-run no se llama a la SAT):
FEL_NIT=<...>
FEL_NAME_ISSUER=<...>
FEL_CERTIFICADOR=<...>
FEL_CERTIFICADOR_NIT=<...>
FEL_REQUESTOR=<...>
FEL_USER=<...>
```

> Puedes copiar los valores de FEL directo desde las Config Vars de Heroku de `pharmasysapp`.

---

## 4. Validación (dry-run) — obligatorio antes de emitir real

```bash
php81 artisan invoices:daily <YYYY-MM-DD> --dry-run
```

- Debe extraer, cargar y reportar `GranTotal` por tienda **sin** emitir.
- **Comparar el XML generado contra una factura buena conocida** (misma tienda/día
  facturado a mano) para confirmar que montos, IVA y `FechaHoraEmision` coinciden.

---

## 5. Emisión real controlada

```bash
php81 artisan invoices:daily <YYYY-MM-DD>      # un solo día, verificable
```

Verificar en el panel / portal SAT que el DTE quedó bien. Recién entonces seguir.

### Catch-up de días pendientes (retro-fechados)

Regla SAT: un día `D` se puede emitir hasta `D+5`.

```bash
for d in <dias>; do php81 artisan invoices:daily 2026-07-$d; done
```

---

## 6. Fase 3 — activar el automático ✅ HECHO (2026-07-13)

1. ~~Descomentar el bloque `invoices:daily` en `app/Console/Kernel.php`.~~ Hecho (commit `8304c5a`).
2. ~~Desplegar a Heroku.~~ Hecho: `git push heroku feature/auto-invoicing:master` → `v1281`.
3. ~~Add-on **Heroku Scheduler**~~ instalado (`scheduler:standard`, gratis) con job:
   ```
   php artisan schedule:run
   ```
   cada 10 min. (Laravel dispara `invoices:daily` solo a las 23:55 America/Guatemala.)
4. ~~Confirmar variables `DB_*_2` e `INVOICE_NOTIFY_EMAIL`~~ configuradas en Heroku.

**Primera corrida automática esperada: hoy 2026-07-13 a las 23:55 (GT).** Verificar al día
siguiente con `heroku logs --app pharmasysapp --source app | grep invoices:daily` y/o el
correo de aviso.

---

## 7. Notas de seguridad / pendientes

- **Facturación fiscal real**: cualquier error de noche = DTE real. Por eso: idempotencia,
  dry-run previo, y notificación del resultado.
- **`APP_DEBUG=true` en producción**: bajarlo a `false` (fuga de stack traces).
- **Credenciales**: nunca en git (repo público). Si alguna se compartió en claro, rotarla.
- **Requisito de datos**: cada `sucursal_id` del origen debe existir en `stores.storeID`
  del destino (por el FK de `items_invoice_days`). El flujo manual ya asume esto.
