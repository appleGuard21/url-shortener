<?php

declare(strict_types=1);

namespace App\Config;

class AnalyticsConfig
{
    private string $analyticsBaseUrl;

    public function __construct(string $analyticsBaseUrl)
    {
        $this->analyticsBaseUrl = $analyticsBaseUrl;
    }

    public function getAnalyticsBaseUrl(): string
    {
        return $this->analyticsBaseUrl;
    }
}
