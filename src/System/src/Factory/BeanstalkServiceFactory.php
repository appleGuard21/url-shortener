<?php

declare(strict_types=1);

namespace System\Factory;

use Pheanstalk\Pheanstalk;
use Psr\Container\ContainerInterface;
use System\Service\BeanstalkService;

class BeanstalkServiceFactory
{
    public function __invoke(ContainerInterface $container): BeanstalkService
    {
        $config = $container->get('config')['beanstalk'];
        $client = Pheanstalk::create($config['host'], $config['port']);

        return new BeanstalkService($client);
    }
}
