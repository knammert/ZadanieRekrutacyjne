<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Repository\UserRepository;
use App\Repository\OrderRepository;
use App\Repository\AddressRepository;
use App\Repository\DiscountRepository;
use App\Http\Requests\StoreOrderRequest;
use App\Repository\OrderItemsRepository;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    private UserRepository $userRepository;
    private AddressRepository $addressRepository;
    private OrderRepository $orderRepository;
    private OrderItemsRepository $orderItemsRepository;
    private DiscountRepository $discountRepository;

    public function __construct(UserRepository $userRepository,
    AddressRepository $addressRepository,
    OrderRepository $orderRepository,
    OrderItemsRepository $orderItemsRepository,
    DiscountRepository $discountRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
        $this->orderRepository = $orderRepository;
        $this->orderItemsRepository = $orderItemsRepository;
        $this->discountRepository = $discountRepository;
    }
    /**
     * Kontroler zapisania nowego zamówienia w bazie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrder(StoreOrderRequest $request)
    {
        $data = $request->validated();
        $idAddress = $this->addressRepository->storeUserAddress($data);
        $user = $this->userRepository->storeUser($data, $idAddress);
        $order = $this->orderRepository->storeOrder($data, $idAddress, $user->id);
        $this->orderItemsRepository->storeOrderItems($data, $order->id);

        return response()->json(['url'=>url("/ordered/?name={$user->name}&orderNumber={$order->orderNumber}&total={$order->total}&orderDate={$order->created_at}")]);

    }
    public function getDiscountId(Request $request){

        $validated = $request->validate([
            'discountCode' => 'required'
        ]);
        $discount =  $this->discountRepository->checkIfDiscountCodeExist($validated);

        return $discount;
    }

}
