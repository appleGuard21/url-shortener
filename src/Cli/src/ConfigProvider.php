<?php

declare(strict_types=1);

namespace Cli;

use Cli\Command\Worker\SendDataToAnalyticsServiceWorker;

/**
 * The configuration provider for the Cli module
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
            'laminas-cli' => $this->getCliConfig(),
        ];
    }

    public function getCliConfig(): array
    {
        return [
            'commands' => [
                SendDataToAnalyticsServiceWorker::COMMAND_NAME => SendDataToAnalyticsServiceWorker::class,
            ],
        ];
    }
}
