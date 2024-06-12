<?php

namespace App\Services\Entity;

use App\Models\Article;
use App\Services\Article\DTO\ArticleDTO;

class AddArticles
{
    public static function process(array $articles)
    {
        $articles = array_map(fn (ArticleDTO $articleDTO) => $articleDTO->toArray(), $articles);

        Article::upsert($articles, ['ext_id', 'channel'], ['title', 'version']);
    }
}
