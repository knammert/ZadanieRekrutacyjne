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
    //Pobieranie metod dostawy
    public function getShippingMethods()
    {
        return $this->shippingModel->get();
    }
    //Pobieranie płatności dostawy o danym id
    public function getShippingPrice($idShipping)
    {
        $shipping = $this->shippingModel->find($idShipping);

        return $shipping->price;
    }


}
