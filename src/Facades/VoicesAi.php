<?php

namespace Voices\Facades;

use Voices\DTO\VoicesAiDTO;
use Voices\Services\SpeechToText;
use Voices\Services\TextToSpeech;

class VoicesAi
{
    public static $apiToken;

    public static function textToSpeech(): TextToSpeech
    {
        return TextToSpeech::instance(new VoicesAiDTO(token: self::$apiToken));
    }

    public static function speechToText(): SpeechToText
    {
        return SpeechToText::instance(new VoicesAiDTO(token: self::$apiToken));
    }

    public static function initialize(string $token): void
    {
        self::$apiToken = $token;
    }
}
