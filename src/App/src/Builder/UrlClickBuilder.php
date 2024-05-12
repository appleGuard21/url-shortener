<?php

declare(strict_types = 1);

namespace App\Builder;

use App\Entity\UrlClick;

class UrlClickBuilder
{
    private UrlClick $urlClick;

    public function __construct(UrlClick $urlClick)
    {
        $this->urlClick = $urlClick;
    }

    public function urlId(string $urlId): UrlClickBuilder
    {
        $this->urlClick->setUrlId($urlId);
        return $this;
    }

    public function longUrl(string $longUrl): UrlClickBuilder
    {
        $this->urlClick->setLongUrl($longUrl);
        return $this;
    }

    public function ipAddress(string $ipAddress): UrlClickBuilder
    {
        $this->urlClick->setIpAddress($ipAddress);
        return $this;
    }

    public function userAgent(string $userAgent): UrlClickBuilder
    {
        $this->urlClick->setUserAgent($userAgent);
        return $this;
    }

    public function referer(string $referer): UrlClickBuilder
    {
        $this->urlClick->setReferer($referer);
        return $this;
    }

    public function build(): UrlClick
    {
        return $this->urlClick;
    }
}
