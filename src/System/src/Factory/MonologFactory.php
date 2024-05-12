<?php

declare(strict_types=1);

namespace System\Factory;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class MonologFactory
{
    private array $handlers;

    public function __invoke(ContainerInterface $container): LoggerInterface
    {
        $config = $container->get('config')['monolog'];
        $this->addHandlers($config['handlers']);
        $logger = new Logger($config['name']);
        $logger->setHandlers($this->handlers);

        return $logger;
    }

    private function addHandlers(array $handlers): void
    {
        foreach ($handlers as $handler) {
            $streamHandler = new StreamHandler(
                $handler['stream'],
                $handler['level']
            );
            $this->handlers[] = $streamHandler;
        }
    }
}
