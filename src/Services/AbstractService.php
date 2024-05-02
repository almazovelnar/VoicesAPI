<?php

namespace Voices\Services;

use Voices\Client;
use Voices\DTO\VoicesAiDTO;

abstract class AbstractService
{
    private static $instance;

    /**
     * @var Client
     */
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param VoicesAiDTO|null $voicesAi
     * @return static
     */
    public static function instance(?VoicesAiDTO $voicesAi = null): static
    {
        if (empty(static::$instance)) {
            static::$instance = new static();

            if ($voicesAi->getToken()) {
                static::$instance->setToken($voicesAi->getToken());
            }

            if ($voicesAi->getLanguage()) {
                static::$instance->setLanguage($voicesAi->getLanguage());
            }
        }

        return static::$instance;
    }

    /**
     * @param $token
     * @return Client
     */
    public function setToken($token): Client
    {
        return $this->client->auth($token);
    }

    /**
     * @param $language
     * @return Client
     */
    public function setLanguage($language): Client
    {
        return $this->client->language($language);
    }
}
