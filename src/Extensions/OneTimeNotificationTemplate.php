<?php

namespace BotMan\Drivers\Facebook\Extensions;

use JsonSerializable;

class OneTimeNotificationTemplate implements JsonSerializable
{
    protected array $payload;

    public static function create(string $text): static
    {
        return new static($text);
    }

    public function __construct(protected string $text)
    {
    }

    public function payload(array $payload): self
    {
        $this->payload = $payload;

        return $this;
    }

    public function toArray()
    {
        return [
            'attachment' => [
                'type' => 'template',
                'payload' => [
                    'template_type' => 'one_time_notif_req',
                    'title' => $this->text,
                    'payload' => json_encode($this->payload),
                ],
            ],
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
