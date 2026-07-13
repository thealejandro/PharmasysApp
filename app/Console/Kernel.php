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
        $schedule->command('invoices:daily')
            ->dailyAt('23:55')
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
