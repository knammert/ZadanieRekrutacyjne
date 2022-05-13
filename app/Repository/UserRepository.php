<?php
namespace App\Repository;

use App\Models\User;


class UserRepository
{
    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    //Zapisywanie nowego użytkownika
    public function storeUser(array $data, int $addressId): int
    {
        $this->userModel->login = $data['login'];
        $this->userModel->password = md5($data['password']);
        $this->userModel->name = $data['name'];
        $this->userModel->surname = $data['surname'];
        $this->userModel->address_id = $addressId;
        $this->userModel->newsletter = $data['newsletter'];;
        $this->userModel->phone = $data['phone'];
        $this->userModel->save();
        return $this->userModel->id;
    }


}
