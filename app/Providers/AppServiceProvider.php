<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register Blade directives for section visibility
        Blade::if('sectionVisible', function ($section) {
            if (!is_array($section)) {
                return true;
            }

            // Check for new __visible meta key (from unwrapped data)
            if (isset($section['__visible'])) {
                return $section['__visible'] === true;
            }

            // Check if section has old 'visible' key (for wrapped data)
            if (isset($section['visible'])) {
                return $section['visible'] === true;
            }

            // Default to visible
            return true;
        });

        // Helper to get section data (unwrap if needed)
        Blade::directive('sectionData', function ($expression) {
            return "<?php
                \$__sectionData = {$expression};
                if (isset(\$__sectionData['data']) && is_array(\$__sectionData['data'])) {
                    \$__sectionData = \$__sectionData['data'];
                } else {
                    unset(\$__sectionData['visible']);
                }
                echo '';
            ?>";
        });
    }
}
