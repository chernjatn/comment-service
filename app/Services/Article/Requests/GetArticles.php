<?php

namespace App\Services\Article\Requests;

use Saloon\Http\Request as SaloonRequest;
use Saloon\Enums\Method;

class GetArticles extends SaloonRequest
{
    protected Method $method = Method::GET;

    public function __construct(private string $channel)
    {
    }

    protected function defaultHeaders(): array
    {
        return [
            'X-Channel' => $this->channel,
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/articles';
    }
}
