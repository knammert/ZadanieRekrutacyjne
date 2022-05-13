<?php
namespace App\Repository;

use App\Models\Discount;


class DiscountRepository
{
    private Discount $discountModel;

    public function __construct(Discount $discountModel)
    {
        $this->discountModel = $discountModel;
    }
    //pobieranie rabatu
    public function getDiscount($id)
    {
        return $this->discountModel->find($id);
    }
    // Sprawdzenie czy istnieje podany kod rabatowy i zwrócenie go jeśli istnieje,
    // bądź zwrócenie błedu HTTP 422 jeśli nie.
    public function checkIfDiscountCodeExist($data)
    {
        $discount = $this->discountModel
            ->where('code', $data['discountCode'])
            ->first();
        if($discount == null){
            return response()->json([
                'discountError' => "Brak podanego kodu w serwisie",
            ], 422);
        }
        else if($discount->active == false){
            return response()->json([
                'discountError' => "Podany kod wygasł",
            ], 422);
        }
        else{
            return response()->json([
                'discount' => $discount,
            ]);
        }
    }
    //pobieranie wartości amount z rabatu
    public function getDiscountAmount($idDiscount){
        $discount = $this->getDiscount($idDiscount);
        return $discount->amount;
    }


}
