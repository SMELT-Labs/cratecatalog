<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;
use Lib\TailwindAspectRatio;
use Lib\TailwindSpacing;

class TailwindServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function parseArgs($expr) {
        return Str::of($expr)->split("/,\s*/")->map(function($item) {
            if (Str::of($item)->startsWith("$")) {
                $key = Str::of($item)->after("$")->toString();
                return app('view')->shared('viewData')->get($key);
            }
            return $item;
        })->toArray();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view){
            View::share('viewName', $view->getName());
//            dump($view->getData());
            View::share('viewData', collect($view->getData()));
        });

        Blade::directive('aspect', function ($expr) {
            $args = Str::of($expr)->split("/,\s*/")->toArray();
            return aspect(...$args)->generate();
        });

        Blade::stringable(function (TailwindSpacing $spacing) {
            return "<?php echo 'hello spacing';?>";
        });

        Blade::directive('margin', function ($expr) {
            $args = $this->parseArgs($expr);

            return TailwindSpacing::generate(function () use ($args) {
                return TailwindSpacing::margin(...$args);
            });
        });

        Blade::directive('padding', function ($expr) {
            $args = $this->parseArgs($expr);

            return TailwindSpacing::generate(function () use ($args) {
                return TailwindSpacing::padding(...$args);
            });
        });

        Blade::directive('width', function ($expr) {
            $args = $this->parseArgs($expr);

            return TailwindSpacing::generate(function () use ($args) {
                return TailwindSpacing::width(...$args);
            });
        });

        Blade::directive('tw', function ($expr) {
            $args = $this->parseArgs($expr);
            dd($args);
            return TailwindSpacing::generate(function () use ($args) {
                return TailwindSpacing::width(...$args);
            });
        });
    }
}
