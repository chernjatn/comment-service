<?php

use App\Services\Article\ArticleManager;

function articleManager(): ArticleManager
{
    return app(ArticleManager::class);
}
