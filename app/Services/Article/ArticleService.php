<?php

namespace Ultra\Shop\Services\Article;

use Ultra\Shop\Services\Articles\Requests\GetArticles;

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
