<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Repository\UserRepository;
use App\Repository\OrderRepository;
use App\Repository\AddressRepository;
use App\Http\Requests\StoreOrderRequest;
use App\Repository\OrderItemsRepository;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    private UserRepository $userRepository;
    private AddressRepository $addressRepository;
    private OrderRepository $orderRepository;
    private OrderItemsRepository $orderItemsRepository;

    public function __construct(UserRepository $userRepository, AddressRepository $addressRepository, OrderRepository $orderRepository, OrderItemsRepository $orderItemsRepository)
    {
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
        $this->orderRepository = $orderRepository;
        $this->orderItemsRepository = $orderItemsRepository;

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrder(StoreOrderRequest $request)
    {
        $data = $request->validated();
        // $idAddress = $this->addressRepository->storeUserAddress($data);
        // $idUser = $this->userRepository->storeUser($data, $idAddress);
        // $idOrder = $this->orderRepository->storeOrder($data, $idAddress, $idUser);
        // $this->orderItemsRepository->storeOrderItems($data, $idOrder);

        return response()->json(['success'=>'Successfully']);
    }


}
