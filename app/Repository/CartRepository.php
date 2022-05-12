<?php
namespace App\Repository;

use App\Models\Cart;

class CartRepository
{
    private Cart $cartModel;

    public function __construct(Cart $cartModel)
    {
        $this->cartModel = $cartModel;
    }

    public function getCart($id)
    {
        return $this->cartModel->find($id);
    }

    public function getTotalCard($id): float
    {
        $cart = $this->cartModel->find($id);

        return $cart->total;
    }


}
