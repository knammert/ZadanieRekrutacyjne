<?php
namespace App\Repository;

use App\Models\Order;
use App\Repository\AddressRepository;


class OrderRepository
{
    private Order $orderModel;
    private AddressRepository $addressRepository;

    public function __construct(Order $orderModel, AddressRepository $addressRepository)
    {
        $this->orderModel = $orderModel;
        $this->addressRepository = $addressRepository;
    }

    public function storeOrder($data, $idAddress, $idUser) :int
    {
        if(isset($data['diffrentAddress'])) {
            $idAddress = $this->addressRepository->storeDiffrentShippingAddress($data);
        }
        $this->orderModel->user_id = $idUser;
        $this->orderModel->shipping_id = $data['shipping'];
        $this->orderModel->payment_id = $data['payment'];
        $this->orderModel->address_id = $idAddress;
        //Tutaj zmienić na obliczoną już w js
        $this->orderModel->total = 115.00;
        $this->orderModel->comment = $data['comment'] ?? '';
        $this->orderModel->save();
        return $this->orderModel->id;

    }

}
