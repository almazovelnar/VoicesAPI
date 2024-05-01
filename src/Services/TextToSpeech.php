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
     * @param int|null $language_id
     * @param int|null $voiced_id
     * @param int|null $speed
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function synthesize(string $text, ?int $language_id = 6, ?int $voiced_id = null, ?int $speed = 1): mixed
    {
        return $this->client->post("services/text-to-speech/synthesize", [
            'text'        => $text,
            'language_id' => $language_id,
            'voiced_id'   => $voiced_id,
            'speed'       => $speed,
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
     * @param array|null $filter
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function getVoices(?array $filter = []): mixed
    {
        return $this->client->get('get-voices', query: $filter);
    }
}
