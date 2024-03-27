<?php

namespace App\Console;

use App\Http\Controllers\Admin\Api\LineApiController;
use App\Http\Controllers\Api\JwebController;
use App\Http\Controllers\Kbox\KboxCompanyController;
use App\Models\Api\LineApiReceive;
use App\Models\Api\LineApiUser;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call([LineApiController::class, 'schedule_sending'])->cron('* * * * *');
        $schedule->call([JwebController::class, 'schedule_check_posts'])->cron('* * * * *');
        // $schedule->call([KboxCompanyController::class, 'schedule_backup_database'])->cron('* * * * *');
        $schedule->call([KboxCompanyController::class, 'schedule_backup_database'])->dailyAt('00:00');
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


/**
 *  cd project-directory
 *  crontab -e
 *  Select an editor.  To change later, run 'select-editor'.
 *  1. /bin/nano
 *  1 [enter]
 *  * * * * * cd /var/www/html/oandyah && php artisan schedule:run >> /dev/null 2>&1		を追加
 * 
 * スケジュールを追加した際は ターミナルで以下を実行
 * php artisan schedule:run >> /dev/null 2>&1
 */