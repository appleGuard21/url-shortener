<?php

declare(strict_types=1);

namespace System\Factory;

use Predis\Client;
use Psr\Container\ContainerInterface;
use System\Service\RedisService;

class RedisServiceFactory
{
    public function __invoke(ContainerInterface $container): RedisService
    {
        $config = $container->get('config')['redis'];
        $client = new Client($config);

        return new RedisService($client);
    }
}
