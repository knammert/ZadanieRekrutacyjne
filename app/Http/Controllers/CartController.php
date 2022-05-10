<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\PaymentRepository;
use App\Repository\ShippingRepository;
use App\Repository\CartItemsRepository;

class CartController extends Controller
{
    private ShippingRepository $shippingRepository;
    private PaymentRepository $paymentRepository;
    private CartItemsRepository $cartRepository;

    public function __construct(ShippingRepository $shippingRepository, PaymentRepository $paymentRepository, CartItemsRepository $cartItemRepository)
    {
        $this->shippingRepository = $shippingRepository;
        $this->paymentRepository = $paymentRepository;
        $this->cartItemRepository = $cartItemRepository;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showOrder($id)
    {
       $shippingMethods = $this->shippingRepository->getShippingMethods();
       $paymentMethods = $this->paymentRepository->getPaymentMethods();
       $cartItems = $this->cartItemRepository->getCartItems($id);


        return view('checkout', [
            'shippingMethods' => $shippingMethods,
            'paymentMethods' => $paymentMethods,
            'cartItems' => $cartItems
        ]);
    }

}
