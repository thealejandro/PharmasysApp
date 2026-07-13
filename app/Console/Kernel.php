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
        // DESACTIVADO a proposito. Activar SOLO despues de validar con --dry-run y una
        // emision real controlada. Requiere ademas el add-on "Heroku Scheduler" corriendo
        // `php artisan schedule:run` cada 10 min. Ver App\Console\Commands\InvoicesDaily.
        // $schedule->command('invoices:daily')
        //     ->dailyAt('23:55')
        //     ->timezone('America/Guatemala')
        //     ->withoutOverlapping();
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
