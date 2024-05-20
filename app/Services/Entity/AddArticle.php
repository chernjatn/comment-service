<?php

namespace App\Services\Entity;

use App\Models\Article;

class AddArticle
{
    public static function process(array $articles)
    {
        Article::upsert($articles, 'ext_id', ['title']);
    }
}
