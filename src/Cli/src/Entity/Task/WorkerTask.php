<?php

declare(strict_types = 1);

namespace Cli\Entity\Task;

use Pheanstalk\Values\TubeName;

interface WorkerTask
{
    public function getTubeName(): TubeName;
    public function getData(): array;
}
