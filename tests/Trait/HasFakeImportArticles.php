<?php

namespace Tests\Trait;

use App\Enums\Channel;
use App\Services\Article\ArticleConnector;
use App\Services\Article\ArticleManager;
use App\Services\Article\ArticleService;
use App\Services\Article\Requests\GetArticles;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

trait HasFakeImportArticles
{
    public function createFakeArticleManager(): ArticleManager
    {
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

        return new ArticleManager(new ArticleService($connector));
    }

    public function getFakeImportArticles(): array
    {
        $channel = Channel::OZERKI;

        return $this->createFakeArticleManager()->getArticles($channel->value, mt_rand(11111, 55555));
    }
}
