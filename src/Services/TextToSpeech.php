<?php

namespace Voices\Services;

use Voices\Client;
use Voices\Exceptions\TokenException;
use Voices\Exceptions\VoicesAIException;

class TextToSpeech extends AbstractService
{
    /**
     * @throws VoicesAIException
     * @throws TokenException
     */
    public function getVoices()
    {
        return $this->client->get('get-voices');
    }
}
