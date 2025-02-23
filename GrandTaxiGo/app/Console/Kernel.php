<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // Exemple : annuler les réservations non acceptées qui sont passées
        $schedule->call(function () {
            $reservations = \App\Models\Reservation::where('departure_time', '<=', now())
                ->where('status', 'pending')
                // ->where('is_accepted', false)
                ->get();
    
            foreach ($reservations as $reservation) {
                $reservation->status = 'cancelled';
                $reservation->save();
            }
        })->everyMinute();  
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
