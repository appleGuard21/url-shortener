<?php

declare(strict_types=1);

namespace System\Service;

use Cli\Entity\Task\WorkerTask;
use Pheanstalk\Pheanstalk;

class BeanstalkService
{
    private Pheanstalk $client;

    public function __construct(Pheanstalk $client)
    {
        $this->client = $client;
    }

    public function getClient(): Pheanstalk
    {
        return $this->client;
    }

    public function addTask(WorkerTask $task): void
    {
        $this->getClient()->useTube($task->getTubeName());
        $this->getClient()->put(json_encode($task->getData()));
    }
}
