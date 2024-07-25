<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // يمكنك تسجيل أي خدمات هنا، مثل:
        // $this->app->singleton(SomeService::class, function ($app) {
        //     return new SomeService();
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // تعيين حجم عمود الفهرس الافتراضي، إذا كنت تستخدم قاعدة بيانات MySQL
        Schema::defaultStringLength(191);

        // تسجيل المراقبين (Observers)
        // تسجيل مراقب للتغييرات على نموذج User كمثال
        User::observe(UserObserver::class);

        // تسجيل أي إعدادات أو وظائف أخرى تحتاجها عند بدء تشغيل التطبيق
        // مثال: يمكنك استخدام هذا المكان لتحديد البوابات (Gates) أو غيرها من الإعدادات
    }
}
