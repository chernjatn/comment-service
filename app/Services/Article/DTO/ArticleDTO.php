<?php

namespace App\Services\Article\DTO;

use Illuminate\Contracts\Support\Arrayable;

class ArticleDTO implements Arrayable
{
    public readonly int $id;
    public readonly string $title;

    public function __construct(array $data) {
        $this->id    = $data['id'];
        $this->title = $data['title'];
    }

    public function toArray()
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
        ];
    }
}
