<?php

namespace Voices\Services;

use Voices\Client;

class TextToSpeech
{
    public function __construct(
        protected Client $client
    )
    {
    }

    public function getVoices()
    {
        return $this->client->get('get-voices');
    }
}