<?php

declare(strict_types = 1);

namespace App\Service;

use App\Config\AnalyticsConfig;
use App\Entity\UrlClick;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;
use System\Exception\HttpInvalidResponseException;

class AnalyticsService
{
    private Client $httpClient;
    private AnalyticsConfig $analyticsConfig;

    public function __construct(Client $httpClient, AnalyticsConfig $analyticsConfig)
    {
        $this->httpClient = $httpClient;
        $this->analyticsConfig = $analyticsConfig;
    }


    public function sendUrlClickAnalytics(UrlClick $urlClick): void
    {
        $url = $this->analyticsConfig->getAnalyticsBaseUrl() . '/click/register';
        $response = $this->httpClient->post($url, ['json' => $urlClick->toArray()]);
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new HttpInvalidResponseException();
        }
    }
}
