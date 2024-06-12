<?php

namespace App\Services\Article\DTO;

use Illuminate\Contracts\Support\Arrayable;

class ArticleDTO implements Arrayable
{
    public function __construct(
        public readonly int    $extId,
        public readonly string $title,
        public readonly string $channel,
        public readonly int    $version
    )
    {
    }

    static function fromResponse(array $data, string $channel, int $version): self
    {
        return new self($data['id'], $data['title'], $channel, $version);
    }

    public function toArray(): array
    {
        return [
            'ext_id'  => $this->extId,
            'title'   => $this->title,
            'channel' => $this->channel,
            'version' => $this->version
        ];
    }
}
