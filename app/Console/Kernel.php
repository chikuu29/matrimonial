<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\HourlyUpdate::class,
        'App\Console\Commands\updateUser'


    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        
        $schedule->call('reminderController@startExecution')->everyMinute();
                 
        // Run hourly from 8 AM to 5 PM on weekdays...
        
        $schedule->command('updateUser:insert')
        ->everyMinute()->sendOutputTo('./test.txt');

        $schedule->command('everyMinute:update')
        ->everyMinute();

        
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
 
        require base_path('routes/console.php');
    }
}
