<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Policies\BarangPolicy;
use App\Models\Barang;
use App\Policies\LostPolicy;
use App\Models\Lost;


// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::policy(Barang::class, BarangPolicy::class);
        Gate::policy(Lost::class, LostPolicy::class);
    }
}
