<?php
namespace App\Repository;

use App\Models\Order;
use App\Repository\AddressRepository;
use App\Repository\ShippingRepository;


class OrderRepository
{
    private Order $orderModel;
    private AddressRepository $addressRepository;
    private CartRepository $cartRepository;
    private ShippingRepository $shippingRepository;
    private DiscountRepository $discountRepository;

    public function __construct(Order $orderModel,
     AddressRepository $addressRepository,
     CartRepository $cartRepository,
     ShippingRepository $shippingRepository,
     DiscountRepository $discountRepository
     )
    {
        $this->orderModel = $orderModel;
        $this->addressRepository = $addressRepository;
        $this->cartRepository = $cartRepository;
        $this->shippingRepository = $shippingRepository;
        $this->discountRepository = $discountRepository;
    }

    public function storeOrder($data, $idAddress, $idUser):int
    {
        $total = 0;
        if(isset($data['diffrentAddress'])) {
            $idAddress = $this->addressRepository->storeDiffrentShippingAddress($data);
        }
        $total = $this->cartRepository->getTotalCard($data['idCart']);
        $total += $this->shippingRepository->getShippingPrice($data['shipping']);

        if($data['discountId'] != '0'){
            $total += $this->discountRepository->getDiscountAmount($data['discountId']);
        }

        $this->orderModel->user_id = $idUser;
        $this->orderModel->shipping_id = $data['shipping'];
        $this->orderModel->payment_id = $data['payment'];
        $this->orderModel->address_id = $idAddress;
        $this->orderModel->discount_id = $data['discountId'];
        $this->orderModel->total = $total;
        $this->orderModel->comment = $data['comment'] ?? '';
        $this->orderModel->save();
        return $this->orderModel->id;
    }



}
