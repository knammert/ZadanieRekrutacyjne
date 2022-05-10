<?php
namespace App\Repository;

use App\Models\Address;

class AddressRepository
{
    private Address $addressModel;

    public function __construct(Address $addressModel)
    {
        $this->addressModel = $addressModel;
    }

    public function storeUserAddress(array $data): int
    {
        $this->addressModel->country = $data['country'];
        $this->addressModel->address = $data['address'];
        $this->addressModel->zipcode = $data['zipcode'];
        $this->addressModel->city = $data['city'];
        $this->addressModel->save();
        return $this->addressModel->id;
    }


}
