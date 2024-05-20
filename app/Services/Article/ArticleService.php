<?php

namespace App\Services\Article;

use App\Services\Article\Requests\GetArticles;

class ArticleService
{
    public function __construct(
        private ArticleConnector $articleConnector,
    ) {
    }

    public function getArticles(string $channel): array
    {
        return $this->articleConnector->send(new GetArticles($channel))->json('data');
    }
}
