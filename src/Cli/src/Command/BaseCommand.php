<?php

declare(strict_types=1);

namespace Cli\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;

abstract class BaseCommand extends Command
{
    public const COMMAND_NAME = '';

    protected string $commandName = '';
    protected string $commandDescription = '';
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct();
        $this->logger = $logger;
    }

    protected function configure(): void
    {
        $this
            ->setName($this->getCommandName())
            ->setDescription($this->getCommandDescription());
    }

    protected function getCommandName(): string
    {
        return $this->commandName;
    }

    protected function getCommandDescription(): string
    {
        return $this->commandDescription;
    }
}
