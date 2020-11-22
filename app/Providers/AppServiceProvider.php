<?php

namespace App\Providers;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        $running_mode = $this->app->runningInConsole() ? "cli" : "web";
        if($running_mode == 'cli'){
            \Log::setDefaultDriver( 'daily_cli');
        }else{
            \Log::setDefaultDriver( 'daily');
        }
        view()->composer('*', function ($view)
        {
            $view->with([
                'categories' => Category::where('parent_id',null)->get(),
                'category_pro' => Category::where('parent_id',null)->limit(4)->get(),
            ]);
        });
    }
}
