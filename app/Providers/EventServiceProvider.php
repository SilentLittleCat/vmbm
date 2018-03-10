<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Subscribe' => [
            'App\Listeners\Subscribe',
        ],
        'App\Events\Unsubscribe' => [
            'App\Listeners\Unsubscribe',
        ],
        'App\Events\Scan' => [
            'App\Listeners\Scan',
        ],
        'App\Events\GetTissueEvent' => [
            'App\Listeners\GetTissueListener',
        ],
        'App\Events\WechatPayEvent' => [
            'App\Listeners\WechatPayListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
