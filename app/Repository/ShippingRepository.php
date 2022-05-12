<?php
namespace App\Repository;

use App\Models\Shipping;

class ShippingRepository
{
    private Shipping $shippingModel;

    public function __construct(Shipping $shippingModel)
    {
        $this->shippingModel = $shippingModel;
    }

    public function getShippingMethods()
    {
        return $this->shippingModel->get();
    }
    public function getShippingPrice($idShipping)
    {
        $shipping = $this->shippingModel->find($idShipping);

        return $shipping->price;
    }


}
