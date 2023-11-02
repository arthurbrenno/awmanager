<?php

namespace Framework\Http;
use Framework\Http\Constants\StatusCodes;


readonly class Response
{
    /** @noinspection PhpPropertyOnlyWrittenInspection */
    public function __construct(
        private ?string $content = '',
        private int     $status  = StatusCodes::OK,
        private array   $headers = []
    )
    {}

    public function send(): void
    {
        foreach ($this->headers as $header => $value) {
            header("$header: $value");
        }

        echo $this->content;
    }
}