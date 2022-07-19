<?php

namespace App\Providers;

use App\Nova\Box;
use App\Nova\Comment;
use App\Nova\Dashboards\Main;
use App\Nova\Permission;
use App\Nova\Price;
use App\Nova\Role;
use App\Nova\User;
use Illuminate\Foundation\Vite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::style('nova-extra', asset('css/nova-extra.css'));
        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('view-grid'),
                MenuSection::make('Admin', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Role::class),
                    MenuItem::resource(Permission::class),
                ])->icon('cog')
                    ->collapsable()
                    ->canSee(function (NovaRequest $request) {
                        return $request->user()->isAdmin();
                    }),

                MenuSection::make('Content', [
                    MenuItem::resource(Box::class)->name('Subscription Boxes'),
                    MenuItem::resource(Price::class),
                    MenuItem::resource(Comment::class),
                ])->icon('database')
                    ->collapsable()
                    ->canSee(function (NovaRequest $request) {
                        return $request->user()->can('create_content');
                    })
            ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true; // allow all users to access nova.
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
