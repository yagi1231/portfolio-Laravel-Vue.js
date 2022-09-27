<?php

namespace App\Providers;

use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Menu\MenuRepository;
use App\Repositories\Reservation\ReservationRepository;
use App\Repositories\Search\SearchRepository;
use App\Service\CustomerService;
use App\Service\MenuService;
use App\Service\ReservationService;
use Illuminate\Support\ServiceProvider;
use App\Service\SeachService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ReservationService::class, ReservationRepository::class);
        $this->app->bind(CustomerService::class, CustomerRepository::class);
        $this->app->bind(MenuService::class, MenuRepository::class);
        $this->app->bind(SeachService::class, SearchRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
