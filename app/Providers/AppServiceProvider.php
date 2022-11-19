<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

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
        View::composer('layouts.app', function ($view) {

            $menuSidebar = Menu::where('section_menu', 'Y')
                ->where('status', 'Y')
                ->with(['children' => function($query) {
                    $query->orderBy('urut', 'asc')
                        ->where('status', 'Y')
                        ->whereHas('grupUser', function($query) {
                            $query->where('grup_user_id', session('userLogin')->grup_user_id);
                        });
                }])
                ->whereHas('grupUser', function($query) {
                    $query->where('grup_user_id', session('userLogin')->grup_user_id);
                })
                ->orderBy('urut', 'asc')
                ->get();
            $view->with('menuSidebar', $menuSidebar);
        });
    }
}
