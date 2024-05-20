<?php

namespace App\Services\Article;

use Saloon\Contracts\Response;
use Saloon\Helpers\RequestExceptionHelper;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use Throwable;
use App\Services\Article\Exceptions\ArticleException;

class ArticleConnector extends Connector implements HasBody
{
    use HasJsonBody;

    use AcceptsJson;
    use AlwaysThrowOnErrors;

    public function resolveBaseUrl(): string
    {
        return config('article.url', '');
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        $requestException = RequestExceptionHelper::create($response, $senderException);

        return new ArticleException('Cart Error: ' . $requestException->getMessage(), $requestException->getCode(), $requestException);
    }
}
