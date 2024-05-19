<?php

namespace Ultra\Shop\Services\Cart;

use Saloon\Contracts\Response;
use Saloon\Helpers\RequestExceptionHelper;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use Throwable;
use Ultra\Shop\Services\Cart\Exceptions\CartException;
use Ultra\Shop\Services\ExternalApi\Tracker\ExternalApiService;
use Ultra\Shop\Services\ExternalApi\Tracker\Middleware\GuzzleMiddleware as TrackMiddleware;

class ArticleConnector extends Connector implements HasBody
{
    use HasJsonBody;

    use AcceptsJson;
    use AlwaysThrowOnErrors;

    private ?int $regionId = null;

    public function __construct()
    {
        $this->sender()->addMiddleware(new TrackMiddleware(ExternalApiService::CART));
    }

    public function resolveBaseUrl(): string
    {
        return config('article.url', '');
    }

    protected function defaultBody(): array
    {
        return [
            'regionId' => $this->regionId ?? location()->getRegion()->getId(),
        ];
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        $requestException = RequestExceptionHelper::create($response, $senderException);

        return new ArticleException('Cart Error: ' . $requestException->getMessage(), $requestException->getCode(), $requestException);
    }

    //TODO удалить после импорта корзин
    public function setRegionId(int $regionId): self
    {
        $this->regionId = $regionId;

        return $this;
    }
}
