<?php

namespace Voices\DTO;

class VoicesAiDTO
{

    public function __construct(
        protected ?string $token,
        protected ?string $language,
    )
    {
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }
}
