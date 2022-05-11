<?php
namespace App\Repository;

use App\Models\Cart_item;
use App\Models\Order_item;

class OrderItemsRepository
{
    private Order_item $orderItemsModel;
    private Cart_item $cartItemModel;

    public function __construct(Order_item $orderItemsModel, Cart_item  $cartItemModel)
    {
        $this->orderItemsModel = $orderItemsModel;
        $this->cartItemModel = $cartItemModel;
    }

    public function storeOrderItems($data, $idOrder) : void
    {

        $cartItems = $this->cartItemModel
        ->where('cart_id', $data['idCart'])
        ->get();

        foreach($cartItems as $cartItem){
            $this->orderItemsModel = new Order_item();
            $this->orderItemsModel->order_id = $idOrder;
            $this->orderItemsModel->product_id = $cartItem->product_id;
            $this->orderItemsModel->quantity = $cartItem->quantity;
            $this->orderItemsModel->save();
        }
    }


}
