<?php

namespace App\Services\Entity;

use App\Models\Article;

class AddArticles
{
    public static function process(array $articles)
    {
        Article::upsert($articles, ['ext_id', 'channel'], ['title', 'version']);
    }
}