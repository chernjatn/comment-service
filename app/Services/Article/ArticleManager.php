<?php

namespace App\Services\Article;

class ArticleManager
{
    public function __construct(
        private readonly ArticleService $articleService,
    ) {
    }

    public function getArticles(string $channel): array
    {
        $articles = $this->articleService->getArticles($channel);

        return array_map(fn (array $data) => [
            'ext_id' => $data['id'],
            'title'  => $data['title']
        ], $articles);
    }
}
