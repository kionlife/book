<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        require base_path('routes/channels.php');

        Broadcast::channel('chat', function ($user) {
            return Auth::check(); // or any authentication logic
        });
    }
}
