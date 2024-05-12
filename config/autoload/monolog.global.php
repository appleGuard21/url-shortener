<?php

declare(strict_types=1);

use Monolog\Level;

return [
    'monolog' => [
        'handlers' => [
            [
                'stream' => 'php://stdout',
                'level'  => Level::Info,
            ],
        ],
        'name' => 'logger',
    ],
];
