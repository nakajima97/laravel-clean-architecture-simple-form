<?php

namespace App\Providers;

use App\Domain\Contact\ContactRepositoryInterface;
use App\Infrastructure\Eloquent\ContactRepository;
use Illuminate\Support\ServiceProvider;

/**
 * アプリケーションサービスプロバイダ。
 *
 * DIコンテナへのバインドやアプリケーション全体のサービス設定を行います。
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションサービスの登録。
     */
    public function register(): void
    {
        // bind: 都度必要になったらインスタンスを作成する
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
    }

    /**
     * アプリケーションサービスの起動処理。
     */
    public function boot(): void
    {
        //
    }
}
