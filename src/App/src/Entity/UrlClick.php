<?php

declare(strict_types=1);

namespace App\Entity;

use App\Builder\UrlClickBuilder;

class UrlClick
{
    private string $urlId;
    private string $longUrl;
    private string $ipAddress;
    private string $userAgent;
    private string $referer;

    public static function builder(): UrlClickBuilder
    {
        return new UrlClickBuilder(new self());
    }

    public function getUrlId(): string
    {
        return $this->urlId ?? '';
    }

    public function setUrlId(string $urlId): void
    {
        $this->urlId = $urlId;
    }

    public function getLongUrl(): string
    {
        return $this->longUrl ?? '';
    }

    public function setLongUrl(string $longUrl): void
    {
        $this->longUrl = $longUrl;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress ?? '';
    }

    public function setIpAddress(string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent ?? '';
    }

    public function setUserAgent(string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }

    public function getReferer(): string
    {
        return $this->referer ?? '';
    }

    public function setReferer(string $referer): void
    {
        $this->referer = $referer;
    }

    public function toArray(): array
    {
        return [
            'urlId' => $this->getUrlId(),
            'longUrl' => $this->getLongUrl(),
            'ipAddress' => $this->getIpAddress(),
            'userAgent' => $this->getUserAgent(),
            'referer' => $this->getReferer(),
        ];
    }
}
