<?php

namespace Voices;

use GuzzleHttp\ClientInterface;
use \GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

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
        $this->httpClient = new GuzzleClient();
    }

    public function getUri(string $endpoint): string
    {
        return $this->baseUrl . ltrim($endpoint, '/');
    }

    public function get(string $endpoint)
    {
        return json_decode($this->httpClient->get($this->getUri($endpoint), [
            'Authorization' => "{$this->token}"
        ])->getBody(), true);
    }

    public function post(string $endpoint)
    {
        return json_decode($this->httpClient->post($this->getUri($endpoint), [
            'Authorization' => "{$this->token}"
        ])->getBody(), true);
    }
}
