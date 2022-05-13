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
            'login' => 'required_if:register,1|unique:users|min:3|max:16',
            'password' => 'required_if:register,1|confirmed|min:3',
            'name' => 'required_if:register,1',
            'surname' => 'required_if:register,1',
            'country' => 'required',
            'address' => 'required_if:register,1',
            'zipcode' => 'required_if:register,1',
            'city' => 'required_if:register,1',
            'phone' => 'required_if:register,1|numeric',
            'addressSecond' => 'required_if:diffrentAddress,1',
            'zipcodeSecond' => 'required_if:diffrentAddress,1',
            'citySecond' => 'required_if:diffrentAddress,1',
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
