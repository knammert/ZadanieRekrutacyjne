<?php
namespace App\Repository;

use App\Models\Cart_item;

class CartItemsRepository
{
    private Cart_item $cartItemModel;

    public function __construct(Cart_item $cartItemModel)
    {
        $this->cartItemModel = $cartItemModel;
    }

    public function getCartItems($id)
    {
        return $this->cartItemModel
        ->where('cart_id', $id)
        ->get();
    }


}
