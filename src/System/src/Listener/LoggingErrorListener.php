<?php

declare(strict_types=1);

namespace System\Listener;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class LoggingErrorListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(Throwable $e, ServerRequestInterface $request, ResponseInterface $response): void
    {
        $this->logger->error($e->getMessage(), $e->getTrace());
    }
}
