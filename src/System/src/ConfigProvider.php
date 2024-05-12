<?php

declare(strict_types=1);

namespace System;

use Laminas\Stratigility\Middleware\ErrorHandler;
use Psr\Log\LoggerInterface;
use System\Delegator\ErrorHandlerDelegatorFactory;
use System\Factory\BeanstalkServiceFactory;
use System\Factory\MonologFactory;
use System\Factory\RedisServiceFactory;
use System\Service\BeanstalkService;
use System\Service\RedisService;

/**
 * The configuration provider for the System module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'factories' => [
                LoggerInterface::class => MonologFactory::class,
                RedisService::class => RedisServiceFactory::class,
                BeanstalkService::class => BeanstalkServiceFactory::class,
            ],
            'delegators' => [
                ErrorHandler::class => [
                    ErrorHandlerDelegatorFactory::class,
                ],
            ],
        ];
    }
}
