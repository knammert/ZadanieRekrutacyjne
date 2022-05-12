@extends('welcome')
@section('content')
    <div>
        <form method="POST" enctype="multipart/form-data" id="checkoutForm">
            @csrf
            <div class="row m-3">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="myCard d-flex align-items-center">
                        <i class="fas fa-user mr-2"></i> 1. TWOJE DANE
                    </div>
                    <button type="button" class="loginButton mt-2">Logowanie</button>
                    <div class="mt-1">
                        <center><small> Masz już konto? Kliknij żeby się zalogować. </small></center>
                    </div>
                    <div class="mt-3 mb-3">
                        <input class="inputCheckbox" name="register" type="checkbox" id="register">
                        <label class="checkboxLabel">Stwórz nowe konto</label>
                    </div>
                    <span class="text-danger" id="registerErrorMsg"></span>
                    <div class="newAccount" id="newAccount">
                        <input id="idCart" name="idCart" value="{{ Route::input('id') }}" type="hidden" />
                        {{-- Rejestracja --}}
                        <div class="form-group">
                            <input type="text" name="login" id="login" placeholder="Login">
                            <span class="text-danger" id="loginErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" name="password" id="password" placeholder="Hasło">
                            <span class="text-danger" id="passwordErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Potwierdź hasło">
                            <span class="text-danger" id="password_confirmationErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="name" id="name" placeholder="Imię *">
                            <span class="text-danger" id="nameErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="surname" id="surname" placeholder="Nazwisko *">
                            <span class="text-danger" id="surnameErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <select name="country" id="country">
                                <option selected value="Poland">Polska</option>
                                <option value="Germany">Niemcy</option>
                                <option value="Spain">Hiszpania</option>
                            </select>
                            <span class="text-danger" id="countryErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="address" id="address" placeholder="Adres *">
                            <span class="text-danger" id="addressErrorMsg"></span>
                        </div>
                        <div class="row mt-3">
                            <div class=" col-6 form-group">
                                <input type="text" name="zipcode" id="zipcode" placeholder="Kod pocztowy *">
                                <span class="text-danger" id="zipcodeErrorMsg"></span>
                            </div>
                            <div class=" col-6 form-group">
                                <input type="text" name="city" id="city" placeholder="Miasto">
                                <span class="text-danger" id="cityErrorMsg"></span>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="phone" id="phone" placeholder="Telefon *">
                            <span class="text-danger" id="phoneErrorMsg"></span>
                        </div>

                        <div class="form-group mt-3">
                            <input class="inputCheckbox" name="diffrentAddress" type="checkbox" id="diffrentAddress">
                            <label class="checkboxLabel">Dostawa pod inny adres</label>
                        </div>
                    </div>
                    <div id="diffrentAddressSection">
                        <div class="form-group mt-3">
                            <select name="countrySecond" id="countrySecond">
                                <option selected value="Poland">Polska</option>
                                <option value="Germany">Niemcy</option>
                                <option value="Spain">Hiszpania</option>
                            </select>
                            <span class="text-danger" id="countrySecondErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="addressSecond" id="addressSecond" placeholder="Adres *">
                            <span class="text-danger" id="addressSecondErrorMsg"></span>
                        </div>
                        <div class="row mt-3">
                            <div class=" col-6 form-group">
                                <input type="text" name="zipcodeSecond" id="zipcodeSecond" placeholder="Kod pocztowy *">
                                <span class="text-danger" id="zipcodeSecondErrorMsg"></span>
                            </div>
                            <div class=" col-6 form-group">
                                <input type="text" name="citySecond" id="citySecond" placeholder="Miasto">
                                <span class="text-danger" id="citySecondErrorMsg"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="myCard d-flex align-items-center">
                        <i class="fa-solid fa-truck-fast mr-2"></i> 2. METODA DOSTAWY
                    </div>
                    @foreach ($shippingMethods as $shippingMethod)
                        <div class=" p-2 mb-3 row mb-2 ">
                            <div class="col-1  d-flex align-items-center justify-content-center ">
                                <input class="" type="radio" name="shipping"
                                    value="{{ $shippingMethod->id }}" id="shippingId-{{ $shippingMethod->id }}">
                            </div>
                            <div class="col-2  d-flex align-items-center justify-content-center ">
                                <img class=""
                                    src="{{ asset('storage/shipping/' . $shippingMethod->img . '.png') }}" alt="brak"
                                    title="" height="40px" />
                            </div>
                            <div class="col-7   d-flex align-items-center">
                                {{ $shippingMethod->name }}
                            </div>
                            <div class="col-2   d-flex align-items-center justify-content-end">
                                <b>{{ number_format($shippingMethod->price, 2, ',', '.') }} zł</b>
                            </div>
                        </div>
                    @endforeach
                    <span class="text-danger" id="shippingErrorMsg"></span>
                    <div class="myCard d-flex align-items-center">
                        <i class="fa-solid fa-credit-card mr-2"></i> 3. METODA PŁATNOŚCI
                    </div>
                    @foreach ($paymentMethods as $paymentMethod)
                        <div class="form-check p-2 mb-3" id="payment-{{ $paymentMethod->id }}">
                            <input type="radio" value="{{ $paymentMethod->id }}" name="payment">
                            <img class=""
                                src="{{ asset('storage/payment/' . $paymentMethod->img . '.png') }}" alt="brak" title=""
                                width="70" height="auto"></a>
                            <label class="" for="payment">
                                {{ $paymentMethod->name }}
                            </label>
                        </div>
                    @endforeach
                    <span class="text-danger" id="paymentErrorMsg"></span>
                    <div class="form-group mt-3">
                        <input type="text" name="discountCode" id="discountCode" placeholder="Kod rabatowy">
                        <span class="text-danger" id="discountErrorMsg"></span>
                    </div>
                    <button type="button" class="discountButton mt-2">Dodaj kod rabatowy</button>

                </div>

                <div class="col-md-4 col-sm-4 col-xs-4 ">
                    <div class="myCard d-flex align-items-center">
                        <i class="fa-solid fa-calendar mr-2"></i> 4. PODSUMOWANIE
                    </div>
                    @foreach ($cartItems as $cartItem)
                        <div class="row mt-2 p-2 ">
                            <div class="col-2 ">
                                <img class="" src="https://picsum.photos/100" alt="brak" title="" height="50"
                                    width="90"></a>
                            </div>
                            <div class="col-8 ">
                                <div class="col">
                                    <b>{{ $cartItem->product->name }}</b>
                                </div>
                                <div class="col ">
                                    Ilość: {{ $cartItem->quantity }}
                                </div>
                            </div>
                            <div class="col-2  d-flex justify-content-end">
                                <b>{{ number_format($cartItem->product->price, 2, ',', '.') }} zł </b>
                            </div>
                        </div>
                    @endforeach
                    <div class="row m-2 borderCheckout">
                        <div class="col-10 mt-2">
                            Suma częściowa
                        </div>
                        <div class="col-2 mt-2 d-flex justify-content-end">
                            <b> {{ number_format($cart->total, 2, ',', '.') }} zł </b>
                        </div>
                        <div class="col-10 " id="shippingPrice1">
                        </div>
                        <div class="col-2  d-flex justify-content-end" id="shippingPrice2">
                        </div>
                        <div class="col-10 " id="discountPrice1">
                        </div>
                        <div class="col-2  d-flex justify-content-end" id="discountPrice2">
                        </div>
                        <div class="col-8 ">
                            <p class="fs-2 fw-bolder ">Łącznie</p>
                        </div>
                        <div class="col-4 fs-2 fw-bolder d-flex justify-content-end" id="summaryPrice">
                             <b> {{ number_format($cart->total, 2, ',', '.') }} zł </b>
                        </div>
                    </div>

                    <div class="form-group mt-3 ">
                        <textarea class="" id="comment" name="comment" rows="3" placeholder="Komentarz"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <input class="inputCheckbox" name="newsletter" type="checkbox" id="newsletter"> Zapisz
                        się,
                        aby
                        otrzymywać newsletter</>
                    </div>
                    <div class="form-group mt-3">
                        <input class="inputCheckbox" name="terms" type="checkbox" id="terms"> Zapoznałam/em
                        się z <a class="text-primary" href="">Regulaminem</a> zakupów</>
                        <span class="text-danger" id="termsErrorMsg"></span>
                    </div>
                    <button type="button" class="submitButton btn-submit mt-4">Potwierdź zakup</button>
                </div>

            </div>
        </form>
        <div class="alert alert-success" role="alert" id="successMsg" style="display: none">
        </div>
    </div>
    <script type="text/javascript">
        let totalPrice = parseFloat({{$cart->total}}).toFixed(2) ;
    </script>
@endsection
