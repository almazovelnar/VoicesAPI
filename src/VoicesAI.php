<?php

namespace Voices;

use Voices\Services\SpeechToText;
use Voices\Services\TextToSpeech;

class VoicesAI
{
    private static $apiToken;

    public static function textToSpeech(): TextToSpeech
    {
        return TextToSpeech::instance(self::$apiToken);
    }

    public static function speechToText(): SpeechToText
    {
        return SpeechToText::instance(self::$apiToken);
    }

    public static function initialize(string $token): void
    {
        self::$apiToken = $token;
    }
}
