<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class TemplateServiceProvider extends ServiceProvider
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

    private static function requestingTemplate() {
        return collect(app('view')->getShared())->has('template');
    }

    public static function render($key) {

        if (static::requestingTemplate()) {
            return '{{' . $key . '}}';
        }
        return app('view')->shared('viewData')->get($key);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //  echo e($__bladeCompiler->applyEchoHandler($short));

        Blade::directive('render', function ($expr) {
            if (static::requestingTemplate()) {
                $key = Str::of($expr)->after("$")->toString();
                return '@{{' . $key . '}}';
            }

            return '<?php echo e($__bladeCompiler->applyEchoHandler('. $expr .')) ?>';
        });

        Blade::directive('renderif', function ($expr) {
            if (static::requestingTemplate()) {
                $key = Str::of($expr)->after("$")->toString();
                return '@{{#' . $key . '}}';
            }

            return "<?php if(!!($expr)): ?>";
        });

        Blade::directive('renderelse', function ($expr) {
            if (static::requestingTemplate()) {
                $key = Str::of($expr)->after("$")->toString();
                return '@{{/' . $key . '}}' . '@{{^' . $key . '}}';
            }

            return "<?php else: ?>";
        });

        Blade::directive('endrenderif', function ($expr) {
            if (static::requestingTemplate()) {
                $key = Str::of($expr)->after("$")->toString();
                return '@{{/' . $key . '}}';
            }

            return "<?php endif; ?>";
        });

        Blade::directive('highlight', function ($expr) {
            if (static::requestingTemplate()) {
                $key = Str::of($expr)->after("$")->toString();
                return '@{{#helpers.highlight}}{ "attribute": "'. $key . '" }@{{/helpers.highlight}}';
//                return '@{{' . $key . '}}';
            }

            return '<?php echo e($__bladeCompiler->applyEchoHandler('. $expr .')) ?>';
        });
    }
}
