<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Repository\UserRepository;
use App\Repository\AddressRepository;


class OrderController extends Controller
{
    private UserRepository $userRepository;
    private AddressRepository $addressRepository;

    public function __construct(UserRepository $userRepository, AddressRepository $addressRepository)
    {
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrder(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'login' => 'unique:users',
        ]);
        $addressId = $this->addressRepository->storeUserAddress($data);
        $this->userRepository->storeUser($data, $addressId);

        //return response()->json(['success'=>'Got Simple Ajax Request.']);
    }


}
