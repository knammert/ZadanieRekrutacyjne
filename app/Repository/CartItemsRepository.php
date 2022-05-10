<?php
namespace App\Repository;

use App\Models\Cart_item;

class CartItemsRepository
{
    private Cart_item $cartItemsModel;

    public function __construct(Cart_item $cartItemsModel)
    {
        $this->cartItemsModel = $cartItemsModel;
    }

    public function getCartItems($id)
    {
        return $this->cartItemsModel->get();
    }


}
