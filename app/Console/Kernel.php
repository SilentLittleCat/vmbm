<?php

namespace App\Console;

use App\Models\AD;
use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Log;

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
        $schedule->call(function () {
            $res = AD::where('id', '>', 0)->update(['day_num' => 0]);
            if($res) {
                $info = Carbon::now() . ': Success, ad day num update';
            } else {
                $info = Carbon::now() . ': Error, ad day num update';
            }
            Log::info($info);
        })->dailyAt('1:00');
        $schedule->call(function () {
            $time = Carbon::now()->subHour()->toDateTimeString();
            Device::where('status_date_time', '<', $time)->update(['status' => 3]);
        })->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
