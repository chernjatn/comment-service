<?php

namespace Ultra\Shop\Services\Cart\DTO;

use Ultra\Shop\Services\Cart\Traits\InitialPrice;
use Ultra\Shop\Services\Prices\Price;

class ArticleDTO
{
    use InitialPrice;

    public readonly Price $sum;
    public readonly Price $cartItemsAmount;
    public readonly BonusDTO $bonus;
    public readonly ?Price $deliveryAmount;

    public function __construct(array $amount) {
        $this->sum = $this->initialPrice($amount['sum']);
        $this->cartItemsAmount = $this->initialPrice($amount['cartItems']);
        $this->bonus = new BonusDTO(
            $amount['bonus']['writeoffBonus'],
            $amount['bonus']['availablePayment'],
            $amount['bonus']['chargedBonus']
        );
        $this->deliveryAmount = !is_null($amount['delivery']) ? $this->initialPrice($amount['delivery']) : null;
    }
}
