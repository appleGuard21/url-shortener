<?php

declare(strict_types=1);

return [
    'beanstalk' => [
        'host' => (string)getenv('BEANSTALK_HOST') ?? 'localhost',
        'port' => (int)getenv('BEANSTALK_PORT') ?? 11300,
    ],
];
