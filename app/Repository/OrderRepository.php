<?php
namespace App\Repository;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
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

    //Zapis do bazy zamówienia
    //Do zmiennej $total podliczana jest całkowita kwota zamówienia uwzględniajaca rabat oraz dostawę
    public function storeOrder($data, $idAddress, $idUser)
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

        do {
            $orderNumber = mt_rand( 1000000000, 9999999999 );
         } while ( DB::table( 'orders' )->where( 'orderNumber', $orderNumber )->exists() );

        $this->orderModel->user_id = $idUser;
        $this->orderModel->shipping_id = $data['shipping'];
        $this->orderModel->payment_id = $data['payment'];
        $this->orderModel->address_id = $idAddress;
        $this->orderModel->discount_id = $data['discountId'];
        $this->orderModel->orderNumber = $orderNumber;
        $this->orderModel->total = $total;
        $this->orderModel->comment = $data['comment'] ?? '';
        $this->orderModel->save();

        return $this->orderModel;
    }



}
