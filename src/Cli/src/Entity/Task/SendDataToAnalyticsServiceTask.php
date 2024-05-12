<?php

declare(strict_types=1);

namespace Cli\Entity\Task;

use Cli\Command\Worker\SendDataToAnalyticsServiceWorker;
use Pheanstalk\Values\TubeName;
use System\Exception\MissingDataException;

class SendDataToAnalyticsServiceTask implements WorkerTask
{
    private TubeName $tubeName;
    private string $urlId;
    private string $longUrl;
    private string $ipAddress;
    private string $userAgent;
    private string $referer;

    public function __construct(array $data)
    {
        $this->tubeName = new TubeName(SendDataToAnalyticsServiceWorker::TUBE_NAME);
        if (
            isset($data['urlId'])
            && isset($data['longUrl'])
            && isset($data['ipAddress'])
            && isset($data['userAgent'])
            && isset($data['referer'])
        ) {
            $this->urlId = $data['urlId'];
            $this->longUrl = $data['longUrl'];
            $this->ipAddress = $data['ipAddress'];
            $this->userAgent = $data['userAgent'];
            $this->referer = $data['referer'];
        } else {
            throw new MissingDataException();
        }
    }

    public function getTubeName(): TubeName
    {
        return $this->tubeName;
    }

    public function getUrlId(): string
    {
        return $this->urlId;
    }

    public function getLongUrl(): string
    {
        return $this->longUrl;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function getReferer(): string
    {
        return $this->referer;
    }

    public function getData(): array
    {
        return [
            'urlId' => $this->urlId,
            'longUrl' => $this->longUrl,
            'ipAddress' => $this->ipAddress,
            'userAgent' => $this->userAgent,
            'referer' => $this->referer
        ];
    }
}
