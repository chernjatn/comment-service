<?php

namespace Tests\Unit\Service;

use App\Enums\Channel;
use App\Services\Article\ArticleConnector;
use App\Services\Article\ArticleManager;
use App\Services\Article\ArticleService;
use App\Services\Article\DTO\ArticleDTO;
use App\Services\Article\Requests\GetArticles;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Tests\TestCase;

class ArticleManagerTest extends TestCase
{
    protected ArticleManager $articleManager;
    protected function setUp(): void
    {
        parent::setUp();

        $mockClient = new MockClient([
            GetArticles::class => MockResponse::make(body: [
                'data' => [
                    [
                        'id' => 1,
                        'title' => 'test',
                    ]
                ]
            ]),
        ]);

        $connector = new ArticleConnector();

        $connector->withMockClient($mockClient);

        $articleService = new ArticleService($connector);

        $this->articleManager = new ArticleManager($articleService);
    }

    public function testGetArticlesReturnDataInValidFormat()
    {
        $channel = Channel::OZERKI;

        $articles = $this->articleManager->getArticles($channel->value, mt_rand(11111, 55555));

        $this->assertTrue(array_shift($articles) instanceof ArticleDTO);
    }
}
