<?php

declare(strict_types=1);

return [
    'analytics' => [
      'base_url' => (string)getenv('ANALYTICS_BASE_URL') ?? '',
    ],
];
