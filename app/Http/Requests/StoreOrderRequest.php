<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
    return [
            'login' => 'required_if:register,true|unique:users',
            'password' => 'required_if:register,true|confirmed',
            'name' => 'required_if:register,true',
            'surname' => 'required_if:register,true',
            'country' => 'required',
            'address' => 'required_if:register,true',
            'zipcode' => 'required_if:register,true',
            'city' => 'required_if:register,true',
            'phone' => 'required_if:register,true',
            'addressSecond' => 'required_if:diffrentAddress,true',
            'zipcodeSecond' => 'required_if:diffrentAddress,true',
            'citySecond' => 'required_if:diffrentAddress,true',
            'shipping' => 'required',
            'payment' => 'required',
            'terms' => 'in:1',
            'register' => 'in:1',
            'newsletter'=> '',
            'comment'=> 'nullable',
            'idCart'=> 'required',
            'discountId' =>''
        ];
    }
    public function messages()
    {
        return [
            'shipping.required' => 'Wybierz metodę dostawy',
            'payment.required' => 'Wybierz metodę płatności',
            'terms.in' => 'Zaakceptuj regulamin serwisu',
            'register.in' => 'Nie jesteś zalogowany. Załóż konto lub zaloguj się'
        ];
    }
}
