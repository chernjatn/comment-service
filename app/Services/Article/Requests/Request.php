<?php

namespace Ultra\Shop\Services\Cart\Requests;

use Saloon\Http\Request as SaloonRequest;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

abstract class Request extends SaloonRequest implements HasBody
{
    use HasJsonBody;

    public function __construct(
        public readonly ?string $cartId = null,
    ) {
    }

    protected int $timeout = 60;

    protected function defaultConfig(): array
    {
        return [
            'timeout' => 60,
        ];
    }

    protected function defaultBody(): array
    {
        if (!is_null($this->cartId)) {
            return ['cartId' => $this->cartId];
        }

        return customer()->getCartIdentParam();
    }
}
