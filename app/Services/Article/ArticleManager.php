<?php

namespace App\Services\Article;

use App\Services\Article\DTO\ArticleDTO;

class ArticleManager
{
    public function __construct(
        private readonly ArticleService $articleService,
    ) {
    }

    public function getArticles(string $channel, int $version): array
    {
        $articles = $this->articleService->getArticles($channel);

        return array_map(fn (array $data) => ArticleDTO::fromResponse($data, $channel, $version), $articles);
    }
}
