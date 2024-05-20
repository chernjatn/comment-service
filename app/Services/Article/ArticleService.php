<?php

namespace App\Services\Article;

use App\Services\Article\Requests\GetArticles;

class ArticleService
{
    public function __construct(
        private ArticleConnector $articleConnector,
    ) {
    }

    public function getArticles()
    {
        return $this->articleConnector->send(new GetArticles());
    }
}
