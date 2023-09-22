<?php

namespace Gedachtegoed\Janitor;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->publishConfigs();
        $this->registerCommandAliasses();
    }

    public function registerCommandAliasses()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\Integrate::class,
                Commands\Install::class,
                Commands\Update::class,
            ]);
        }
    }

    protected function publishConfigs()
    {
        /*
        |--------------------------------------------------------------------------
        | Duster config
        |--------------------------------------------------------------------------
        */
        $this->publishes([
            __DIR__ . '/../resources/config/duster.json' => base_path('duster.json')
        ], 'janitor-config');

        /*
        |--------------------------------------------------------------------------
        | 3rd party configs
        |--------------------------------------------------------------------------
        */
        $this->publishes([
            __DIR__ . '/../resources/config/.php-cs-fixer.dist.php' => base_path('.php-cs-fixer.dist.php'),
            __DIR__ . '/../resources/config/duster-with-custom-configs.json' => base_path('duster.json'),
            __DIR__ . '/../resources/config/.prettierrc.json' => base_path('.prettierrc.json'),
            __DIR__ . '/../resources/config/.phpcs.xml.dist' => base_path('.phpcs.xml.dist'),
            __DIR__ . '/../resources/config/phpstan.neon' => base_path('phpstan.neon'),
            __DIR__ . '/../resources/config/tlint.json' => base_path('tlint.json'),
            __DIR__ . '/../resources/config/pint.json' => base_path('pint.json'),
        ], 'janitor-3rd-party-configs');

        /*
        |--------------------------------------------------------------------------
        | Github Actions
        |--------------------------------------------------------------------------
        */
        $this->publishes([
            __DIR__ . '/../resources/workflows/static-analysis.yml' => base_path('.github/workflows/static-analysis.yml'),
            __DIR__ . '/../resources/workflows/duster-fix.yml' => base_path('.github/workflows/duster-fix.yml'),
            __DIR__ . '/../resources/workflows/pest-tests.yml' => base_path('.github/workflows/pest-tests.yml')
        ], 'janitor-github-actions');

        /*
        |--------------------------------------------------------------------------
        | Visual Studio Code integration
        |--------------------------------------------------------------------------
        */
        $this->publishes([
            __DIR__ . '/../resources/config/.vscode/extensions.json' => base_path('.vscode/extensions.json'),
            __DIR__ . '/../resources/config/.vscode/settings.json' => base_path('.vscode/settings.json')
        ], 'janitor-vscode-workspace-settings');

        /*
        |--------------------------------------------------------------------------
        | PhpStorm integration
        |--------------------------------------------------------------------------
        */
        //
    }
}
