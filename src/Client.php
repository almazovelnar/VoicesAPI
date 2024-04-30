<?php

namespace Voices;

use Throwable;
use GuzzleHttp\ClientInterface;
use Voices\Exceptions\TokenException;
use \GuzzleHttp\Client as GuzzleClient;
use Voices\Exceptions\VoicesAIException;
use GuzzleHttp\Exception\GuzzleException;

class Client
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    protected $token;

    protected string $baseUrl = 'https://voices.az/api/';

    public function __construct()
    {
        $this->httpClient = new GuzzleClient();
    }

    public function auth(string $token): static
    {
        $this->token = $token;
        return $this;
    }


    public function getUri(string $endpoint): string
    {
        return $this->baseUrl . ltrim($endpoint, '/');
    }

    /**
     * @throws VoicesAIException
     * @throws TokenException
     */
    public function get(string $endpoint)
    {
        try {
            return json_decode($this->httpClient->get($this->getUri($endpoint), [
                'headers' => $this->getHeaders()
            ])->getBody(), true);
        } catch (Throwable $e) {
            if (in_array($e->getCode(), [401, 405])) {
                throw new TokenException('Unauthorized or token is not valid');
            }

            throw new VoicesAIException('Something went wrong');
        }
    }

    /**
     * @throws GuzzleException
     * @throws TokenException
     */
    public function post(string $endpoint)
    {
        return json_decode($this->httpClient->post($this->getUri($endpoint), [
            'headers' => $this->getHeaders()
        ])->getBody(), true);
    }

    /**
     * @throws TokenException
     */
    public function getHeaders(): array
    {
        if (empty($this->token)) {
            throw new TokenException('Token is not find');
        }

        return [
            'Authorization' => "{$this->token}",
            'Content-Type: application/json',
            'Accept: application/json',
        ];
    }
}
