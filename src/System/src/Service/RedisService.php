<?php

declare(strict_types=1);

namespace System\Service;

use Predis\Client;

class RedisService
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function setData(string $key, string $value): void
    {
        $this->client->set($key, $value);
    }

    public function getData(string $key): string
    {
        return $this->client->get($key) ?? '';
    }

    public function isKeyExists(string $key): bool
    {
        return (bool) $this->client->exists($key);
    }
}
