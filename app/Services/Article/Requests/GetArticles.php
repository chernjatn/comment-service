<?php

namespace App\Services\Article\Requests;

use Saloon\Enums\Method;

class GetArticles
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/articles';
    }
}
