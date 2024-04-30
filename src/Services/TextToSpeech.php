<?php

namespace Voices\Services;

use Voices\Client;
use Voices\Exceptions\TokenException;
use Voices\Exceptions\VoicesAIException;

class TextToSpeech
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

    /**
     * @throws VoicesAIException
     * @throws TokenException
     */
    public function getVoices()
    {
        return $this->client->get('get-voices');
    }

    public function setToken($token): Client
    {
        return $this->client->auth($token);
    }
}
