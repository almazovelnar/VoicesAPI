<?php

namespace Voices;

use Throwable;
use GuzzleHttp\ClientInterface;
use Voices\Exceptions\TokenException;
use GuzzleHttp\Client as GuzzleClient;
use Voices\Exceptions\VoicesAiException;
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
     * @param string $endpoint
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function get(string $endpoint): mixed
    {
        try {
            return json_decode($this->httpClient->get($this->getUri($endpoint), [
                'headers' => $this->getHeaders()
            ])->getBody(), true);
        } catch (TokenException $e) {
            throw $e;
        } catch (Throwable $e) {
            if (in_array($e->getCode(), [401, 405])) {
                throw new TokenException('Unauthorized or token is not valid');
            }

            throw new VoicesAiException('Something went wrong');
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
            throw new TokenException('Token is not find', 403);
        }

        return [
            'Authorization' => "{$this->token}",
            'Content-Type: application/json',
            'Accept: application/json',
        ];
    }
}
