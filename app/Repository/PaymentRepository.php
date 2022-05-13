<?php
namespace App\Repository;

use App\Models\Payment;

class PaymentRepository
{
    private Payment $paymentModel;

    public function __construct(Payment $paymentModel)
    {
        $this->paymentModel = $paymentModel;
    }
    //Pobieranie metod płatności
    public function getPaymentMethods()
    {
        return $this->paymentModel->get();
    }

}
