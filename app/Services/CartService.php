<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartService
{
    /**
     * Saves product in cart with amount.
     *
     * @param int $productId The ID of product to save.
     * @param int $amount The amount
     * @return Collection The updated cart.
     */
    public function set(int $productId, int $amount): Collection
    {
        $cart = $this->get();
        $product = $cart->where('product_id', $productId)->first();
        if (is_null($product) && $amount > 0) {
            $cart->add([
                'product_id' => $productId,
                'amount' => $amount,
            ]);
        } else {
            if ($amount > 0) {
                $cart = $cart->map(function (array $item) use ($productId, $amount) {
                    if ($item['product_id'] === $productId) {
                        $item['amount'] = $amount;
                    }

                    return $item;
                });
            } else {
                $cart = $cart->filter(function (array $item) use ($productId) {
                    return $item['product_id'] != $productId;
                });
            }
        }
        $this->save($cart);

        return $cart;
    }

    /**
     * Get cart from session.
     *
     * @return Collection<array> Cart (product ID => amount)
     */
    public function get(): Collection
    {
        try {
            return collect(session()->get('cart', []));
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface) {
            return collect();
        }
    }

    /**
     * Saves cart to session.
     *
     * @param Collection $cart The cart to save.
     */
    public function save(Collection $cart): void
    {
        session()->put('cart', $cart->toArray());
    }
}
