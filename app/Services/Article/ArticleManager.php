<?php

namespace App\Services\Article;

class ArticleManager
{
    public function __construct(
        private readonly ArticleService $articleService,
    ) {
    }

    public function getArticles(): ArticlesCollection
    {
        $articles = $this->articleService->getArticles()->json('cartId');

        //return ArticleCo;
    }
}
