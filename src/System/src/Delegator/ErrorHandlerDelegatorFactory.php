<?php

declare(strict_types=1);

namespace System\Delegator;

use Laminas\Stratigility\Middleware\ErrorHandler;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use System\Listener\LoggingErrorListener;

class ErrorHandlerDelegatorFactory
{
    public function __invoke(ContainerInterface $container, string $name, callable $callback): ErrorHandler
    {
        $listener = new LoggingErrorListener($container->get(LoggerInterface::class));
        $errorHandler = $callback();
        $errorHandler->attachListener($listener);

        return $errorHandler;
    }
}
