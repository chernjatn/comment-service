<?php

namespace Ultra\Shop\Services\Cart;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Ultra\Shop\Contracts\Common\Response;
use Ultra\Shop\Contracts\Inventories\StoreProducts;
use Ultra\Shop\Contracts\Order\Delivery\DeliveryMethod;
use Ultra\Shop\Entities\Store;
use Ultra\Shop\Services\Cart\DTO\CalculateDTO;
use Ultra\Shop\Services\Cart\DTO\CartDTO;
use Ultra\Shop\Services\Order\Delivery\TimeSlotRequest;

class ArticleManager
{
    public function __construct(
        private readonly ArticleService $articleService,
    ) {
    }

    public function getArticles(): ArticlesCollection
    {
        $articles = $this->articleService->getArticles()->json('cartId');

        //return ArticleCo;
    }
}
