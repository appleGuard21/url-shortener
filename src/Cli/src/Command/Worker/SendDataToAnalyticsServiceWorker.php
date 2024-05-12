<?php

declare(strict_types=1);

namespace Cli\Command\Worker;

use App\Entity\UrlClick;
use App\Service\AnalyticsService;
use Cli\Command\BaseWorker;
use Cli\Entity\Task\SendDataToAnalyticsServiceTask;
use Psr\Log\LoggerInterface;
use System\Service\BeanstalkService;

class SendDataToAnalyticsServiceWorker extends BaseWorker
{
    public const COMMAND_NAME = 'worker:send_data_to_analytics_service';
    public const TUBE_NAME = 'send_data_to_analytics_service';

    protected string $commandName = self::COMMAND_NAME;
    protected string $commandDescription = 'Sends click-through data to the analytics service';
    private AnalyticsService $analyticsService;

    public function __construct(
        LoggerInterface $logger,
        BeanstalkService $beanstalkService,
        AnalyticsService $analyticsService
    ) {
        $this->analyticsService = $analyticsService;
        parent::__construct($logger, $beanstalkService);
    }

    protected function handleJob(array $jobPayload): void
    {
        $task = new SendDataToAnalyticsServiceTask($jobPayload);
        $urlClick = UrlClick::builder()
            ->longUrl($task->getLongUrl())
            ->urlId($task->getUrlId())
            ->ipAddress($task->getIpAddress())
            ->userAgent($task->getUserAgent())
            ->referer($task->getReferer())
            ->build();

        $this->analyticsService->sendUrlClickAnalytics($urlClick);
    }
}
