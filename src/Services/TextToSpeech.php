<?php

namespace Voices\Services;

use Voices\Exceptions\TokenException;
use Voices\Exceptions\VoicesAiException;

class TextToSpeech extends AbstractService
{
    /**
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function getVoices(): mixed
    {
        return $this->client->get('get-voices');
    }

    /**
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function getProjects(): mixed
    {
        return $this->client->get('services/text-to-speech/get-projects');
    }
}
