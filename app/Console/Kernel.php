<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // === Facturacion automatica de Clientes Varios (FEL) ===
        // Requiere el add-on "Heroku Scheduler" corriendo `php artisan schedule:run`
        // cada 10 min, y las config vars DB_HOST_2/PORT_2/DATABASE_2/USERNAME_2/PASSWORD_2
        // (conexion `pharmaWeb` al origen). Ver App\Console\Commands\InvoicesDaily.
        //
        // NO usar ->dailyAt('23:55'): el Heroku Scheduler dispara `schedule:run` cada
        // ~10 min pero con jitter (no alineado al reloj), y dailyAt() solo ejecuta si
        // schedule:run corre EXACTAMENTE en ese minuto. En la practica los ticks saltaron
        // de 23:50 a 00:01, saltandose el minuto 23:55 todas las noches (bug detectado
        // 2026-07-14: 0 facturas automaticas desde el deploy). Usamos un rango de
        // minutos (23:50-23:59) para que casi seguro algun tick caiga dentro; es seguro
        // que dispare mas de una vez porque el comando ya es idempotente por tienda+fecha.
        //
        // No se factura domingo (regla del negocio).
        $schedule->command('invoices:daily')
            ->cron('50-59 23 * * 1-6')
            ->timezone('America/Guatemala')
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
