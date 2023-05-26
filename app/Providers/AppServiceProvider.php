<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();

        // untuk authentikasi pake gete
        //untuk 1. authentikasi middleware meiliki kelebihan yaitu bisa meng auth semua method tetapi tdk fleksible
        // untuk gate kelebihannya bisa feksibel bisa di pake di halamn manapun tinggal tambah @can('nama yg ada di provider') @endcan di bagian yg mau di auth
        Gate::define('admin', function(User $user)
        {
            return $user->is_admin;
        });
    }
}
