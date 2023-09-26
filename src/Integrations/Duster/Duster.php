<?php

namespace Gedachtegoed\Janitor\Integrations\Duster;

use Illuminate\Console\Command;
use Gedachtegoed\Janitor\Integrations\Builder;
use function Laravel\Prompts\table;

class Duster extends Builder
{

    public function __invoke()
    {
        $this
            ->composerRequire('tightenco/duster --dev')
            ->composerUpdate('tightenco/duster')
            ->publishesConfigs([
                'duster.json' => base_dir('duster.json')
            ])
            ->composerScripts([
                'lint' => 'vendor/bin/duster lint',
                'fix' => 'vendor/bin/duster fix',
                'analyze' => 'vendor/bin/phpstan analyse',
                'baseline' => 'vendor/bin/phpstan analyse --generate-baselin'
            ])
            ->afterInstall(function(Command $command) {
                table(
                    ['Command', 'Description'],
                    [
                        ['composer lint', 'Lints your code with duster and phpstan including any additional linters configured in duster.json'],
                        ['composer fix', 'Fixes your code with duster including any additional fixers configured in duster.json'],
                        ['composer analyze', 'Runs phpstan separately'],
                        ['composer baseline', 'Generate a static analysis baseline']
                    ]
                );
            });
    }
}
