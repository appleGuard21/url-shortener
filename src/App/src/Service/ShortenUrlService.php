<?php

declare(strict_types=1);

namespace App\Service;

use System\Service\RedisService;

class ShortenUrlService
{
    private RedisService $redisService;

    private const CHARACTERS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public const ROUTE_LENGTH = 6;

    public function __construct(RedisService $redisService)
    {
        $this->redisService = $redisService;
    }

    public function shortenUrl(string $url): string
    {
        do {
            $shortUrlId = $this->generateRandomString();
        } while ($this->redisService->isKeyExists($shortUrlId));
        $this->redisService->setData($shortUrlId, $url);

        return $shortUrlId;
    }

    private function generateRandomString(): string
    {
        $charactersLength = strlen(self::CHARACTERS);
        $randomString = '';
        for ($i = 0; $i < self::ROUTE_LENGTH; $i++) {
            $randomString .= self::CHARACTERS[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
