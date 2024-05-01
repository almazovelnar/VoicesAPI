<?php

namespace Voices\Services;

use Voices\Exceptions\TokenException;
use Voices\Exceptions\VoicesAiException;

class SpeechToText extends AbstractService
{
    /**
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function getList(): mixed
    {
        return $this->client->get('services/speech-to-text/get-projects');
    }

    /**
     * @param int $projectId
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function getById(int $projectId): mixed
    {
        return $this->client->get("services/speech-to-text/{$projectId}");
    }

    /**
     * @param $youtubeUrl
     * @param $voice
     * @param int|null $languageId
     * @param int|null $diarize
     * @param int|null $demucs
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function recognize($youtubeUrl, $voice, ?int $languageId = 6, ?int $diarize = 1, ?int $demucs = 0): mixed
    {
        return $this->client->post("services/speech-to-text/recognize", [
            'youtube_url' => $youtubeUrl,
            'voice'       => $voice,
            'language_id' => $languageId ?? 6,
            'diarize'     => $diarize ?? 1,
            'demucs'      => $demucs ?? 0,
        ]);
    }

    /**
     * @param int $projectId
     * @param string|null $format
     * @return mixed
     * @throws TokenException
     * @throws VoicesAiException
     */
    public function export(int $projectId, ?string $format = 'txt'): mixed
    {
        return $this->client->post("services/speech-to-text/export/{$projectId}", [
            'format' => $format,
        ]);
    }
}
