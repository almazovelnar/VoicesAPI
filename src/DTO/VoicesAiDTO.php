<?php

namespace Voices\DTO;

class VoicesAiDTO
{
    protected ?string $token;

    public function __construct(
        ?string $token = null
    )
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }
}
