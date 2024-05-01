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
    public function getList(): mixed
    {
        return $this->client->get("services/text-to-speech/get-projects");
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
     * @param string $text
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function synthesize(string $text): mixed
    {
        return $this->client->post("services/text-to-speech/synthesize", [
            'text' => $text,
        ]);
    }

    /**
     * @param string $requestId
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function getSynthesisResponse(string $requestId): mixed
    {
        return $this->client->get("services/text-to-speech/get-response/{$requestId}");
    }

    /**
     * @param int $projectId
     * @param string|null $format
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function export(int $projectId, ?string $format = 'wav'): mixed
    {
        return $this->client->post("services/text-to-speech/export/{$projectId}", [
            'format' => $format,
        ]);
    }

    /**
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function getVoices(): mixed
    {
        return $this->client->get('get-voices');
    }
}
