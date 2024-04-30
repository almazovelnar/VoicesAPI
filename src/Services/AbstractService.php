<?php

namespace Voices\Services;

use Voices\Client;

abstract class AbstractService
{
    private static $instance;
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public static function instance(?string $token = null): static
    {
        if (empty(static::$instance)) {
            static::$instance = new static();

            if ($token) {
                static::$instance->setToken($token);
            }
        }

        return static::$instance;
    }

    public function setToken($token): Client
    {
        return $this->client->auth($token);
    }
}
