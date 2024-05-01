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
    public function getList(): mixed
    {
        return $this->client->get('services/text-to-speech/get-projects');
    }

    /**
     * @param int $projectId
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function getById(int $projectId): mixed
    {
        return $this->client->get("services/text-to-speech/{$projectId}");
    }

    /**
     * @param string $requestId
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function getResponse(string $requestId): mixed
    {
        return $this->client->get("services/text-to-speech/get-response/{$requestId}");
    }
}
