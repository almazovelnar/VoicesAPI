<?php

namespace Voices;

use GuzzleHttp\ClientInterface;
use \GuzzleHttp\Client as GuzzleClient;

class Client
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    protected string $baseUrl = 'https://voices.az/api/';

    public function __construct(
        protected string $token
    )
    {
    }

    /**
     * @return GuzzleClient|ClientInterface
     */
    public function getHttpClient(): GuzzleClient|ClientInterface
    {
        if (null === $this->httpClient) {
            $this->httpClient = $this->createDefaultHttpClient();
        }

        return $this->httpClient;
    }

    public function createDefaultHttpClient(): GuzzleClient
    {
        return new GuzzleClient([
            'base_url' => $this->baseUrl,
        ]);
    }

    public function get(string $endpoint)
    {
        return $this->getHttpClient()->get($endpoint);
    }
}