<?php

namespace App\Providers;

use App\Domain\Contact\ContactRepositoryInterface;
use App\Infrastructure\Eloquent\ContactRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // bind: 都度必要になったらインスタンスを作成する
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
