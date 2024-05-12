<?php

declare(strict_types=1);

return [
    'redis' => [
        'scheme'   => 'tcp',
        'host'     => (string)getenv('REDIS_HOST') ?? 'localhost',
        'port'     => (int)getenv('REDIS_PORT') ?? 6379,
        'database' => (int)getenv('REDIS_DATABASE') ?? 0,
    ],
];
