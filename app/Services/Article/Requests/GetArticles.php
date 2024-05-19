<?php

namespace Ultra\Shop\Services\Articles\Requests;

use Saloon\Enums\Method;

class GetArticles extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/articles';
    }
}
