<?php

namespace Tests\Unit\Service\Entity;

use App\Services\Entity\AddArticles;
use Tests\TestCase;
use Tests\Trait\HasFakeImportArticles;

class AddArticlesTest extends TestCase
{
    use HasFakeImportArticles;

    public function testProcessUpdateOrCreateArticles()
    {
        $articles = $this->getFakeImportArticles();

        AddArticles::process($articles);

        $article = array_shift($articles);

        $this->assertDatabaseHas('articles', $article->toArray());
    }
}
