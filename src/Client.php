<?php

namespace Voices;

use Throwable;
use Voices\Exceptions\TokenException;
use GuzzleHttp\Client as GuzzleClient;
use Voices\Exceptions\VoicesAiException;

class Client
{
    protected $httpClient;

    protected $token;

    protected string $baseUrl = 'https://voices.az/api/';

    public function __construct()
    {
        $this->httpClient = new GuzzleClient();
    }

    /**
     * @param string $token
     * @return $this
     */
    public function auth(string $token): static
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param string $endpoint
     * @return string
     */
    public function getUri(string $endpoint): string
    {
        return $this->baseUrl . ltrim($endpoint, '/');
    }

    /**
     * @param string $endpoint
     * @param array|null $params
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function get(string $endpoint, ?array $params = [], ?array $query = []): mixed
    {
        return $this->request('GET', $endpoint, $params, $query);
    }

    /**
     * @param string $endpoint
     * @param array|null $params
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function post(string $endpoint, ?array $params = [], ?array $query = []): mixed
    {
        return $this->request('POST', $endpoint, $params, $query);
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array $params
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function request(string $method, string $endpoint, array $params, array $query): mixed
    {
        try {
            return json_decode($this->httpClient->request($method, $this->getUri($endpoint), [
                'headers'     => $this->getHeaders(),
                'query'       => $query,
                'form_params' => $params
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
     * @return string[]
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
