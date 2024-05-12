<?php

declare(strict_types = 1);

namespace Cli\Command;

use Pheanstalk\Values\TubeName;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use System\Service\BeanstalkService;

abstract class BaseWorker extends BaseCommand
{
    protected const TUBE_NAME = '';

    private BeanstalkService $beanstalkService;

    public function __construct(LoggerInterface $logger, BeanstalkService $beanstalkService)
    {
        parent::__construct($logger);
        $this->beanstalkService = $beanstalkService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $client = $this->beanstalkService->getClient();
        $client->watch(new TubeName(static::TUBE_NAME));
        while (true) {
            $job = $client->reserve();
            try {
                $jobPayload = json_decode($job->getData(), true) ?? [];
                $this->handleJob($jobPayload);
                $client->delete($job);
            } catch (\Throwable $e) {
                $this->logger->error($e->getMessage(), $e->getTrace());
                $client->release($job);
            }
        }
    }

    abstract protected function handleJob(array $jobPayload): void;
}
