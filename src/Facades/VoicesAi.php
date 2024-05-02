<?php

namespace Voices\Facades;

use Voices\DTO\VoicesAiDTO;
use Voices\Services\SpeechToText;
use Voices\Services\TextToSpeech;

class VoicesAi
{
    public static $apiToken;
    public static $language;

    public static function textToSpeech(): TextToSpeech
    {
        return TextToSpeech::instance(self::params());
    }

    public static function speechToText(): SpeechToText
    {
        return SpeechToText::instance(self::params());
    }

    public static function params(): VoicesAiDTO
    {
        return new VoicesAiDTO(
            token: self::$apiToken,
            language: self::$language
        );
    }

    public static function initialize(string $token, ?string $language = 'en')
    {
        self::$apiToken = $token;
        self::$language = $language;
    }

    public static function setLocale(string $language)
    {
        self::$language = $language;
    }
}
