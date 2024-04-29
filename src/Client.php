<?php

namespace GM\Voices;

use GuzzleHttp\Client;

class Api
{
    protected Client $client;

    protected string $baseUrl = 'https://voices.az/api/';

    public function __construct(
        protected string $token
    )
    {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers'  => [
                'Authorization' => "{$this->token}",
            ]
        ]);
    }

    public function get()
    {

    }
}