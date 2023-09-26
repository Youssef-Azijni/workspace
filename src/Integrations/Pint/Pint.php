<?php

namespace Gedachtegoed\Janitor\Integrations\Pint;

use Gedachtegoed\Janitor\Integrations\Builder;

class Pint extends Builder
{

    public function __invoke()
    {
        $this
            ->composerRequire('laravel/pint --dev')
            ->composerUpdate('laravel/pint')
            ->publishesConfigs([
                'pint.json' => base_dir('pint.json')
            ])
            ->provideDusterLintConfig([
                // Already included in Duster
            ])
            ->provideDusterFixConfig([
                // Already included in Duster
            ])
            ->provideVscodeRecommendedPlugins('open-southeners.laravel-pint')
            ->provideVscodeWorkspaceConfig([
                'laravel-pint.enable' => true,
            ]);
    }
}
