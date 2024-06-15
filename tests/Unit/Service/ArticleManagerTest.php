<?php

namespace Tests\Unit\Service;

use App\Services\Article\DTO\ArticleDTO;
use Tests\TestCase;
use Tests\Trait\HasFakeImportArticles;

class ArticleManagerTest extends TestCase
{
    use HasFakeImportArticles;

    public function testGetArticlesReturnDataInValidFormat()
    {
        $articles = $this->getFakeImportArticles();

        $this->assertTrue(array_shift($articles) instanceof ArticleDTO);
    }
}
