<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Flight;
use App\Models\Client;
use App\Models\User;
use App\Policies\FlightPolicy;
use App\Policies\ClientPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Flight::class => FlightPolicy::class,
        Client::class => ClientPolicy::class,
        'App\Models\User' => 'App\Policies\AdminPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function register(): void
    {
        // يمكنك تسجيل أي خدمات إضافية هنا إذا لزم الأمر
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // إضافة بوابات (Gates) إذا لزم الأمر
        // مثال على بوابة يمكن إضافتها هنا:
        // Gate::define('admin-access', function ($user) {
        //     return $user->is_admin;
        // });
    }
}
