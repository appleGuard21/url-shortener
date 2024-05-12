<?php

declare(strict_types=1);

namespace App\Factory;

use App\Config\AnalyticsConfig;
use Psr\Container\ContainerInterface;

class AnalyticsConfigFactory
{
    public function __invoke(ContainerInterface $container): AnalyticsConfig
    {
        $config = $container->get('config')['analytics'];
        $analyticsBaseUrl = $config['base_url'];

        return new AnalyticsConfig($analyticsBaseUrl);
    }
}
