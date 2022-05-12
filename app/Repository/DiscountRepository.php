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

    public function getDiscount($id)
    {
        return $this->discountModel->find($id);
    }

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
    public function getDiscountAmount($idDiscount){
        $discount = $this->getDiscount($idDiscount);
        return $discount->amount;
    }


}
