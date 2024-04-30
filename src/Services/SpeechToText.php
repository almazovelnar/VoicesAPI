<?php

namespace Voices\Services;

use Voices\Client;

class SpeechToText
{
    private static $instance;
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public static function instance(?string $token = null): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self();

            if ($token) {
                self::$instance->setToken($token);
            }
        }

        return self::$instance;
    }

    public function setToken($token): Client
    {
        return $this->client->auth($token);
    }
}