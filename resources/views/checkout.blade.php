@extends('welcome')
@section('content')
    <div>
        <h1>Zadanie rekrutacyjne</h1>
        <form method="POST" enctype="multipart/form-data" id="checkoutForm">
            <div class="row m-3">
                <div class="col-4">
                    <div class="card-header">
                        1. Twoje dane
                    </div>
                    <button type="button" class="btn btn-primary mt-2">Logowanie</button>
                    <div class="mt-1">
                        Masz już konto? Kliknij żeby się zalogować.
                    </div>
                    <input class="form-check-input" name="register" type="checkbox" id="register"> Stwórz nowe
                    konto</>
                    <span class="text-danger" id="registerErrorMsg"></span>
                    <div class="newAccount" id="newAccount">
                        @csrf
                        <input id="idCart" name="idCart" value="{{ Route::input('id') }}" type="hidden" />
                        </>
                        {{-- Rejestracja --}}
                        <div class="form-group">
                            <input type="text" name="login" class="form-control" id="login" placeholder="Login">
                            <span class="text-danger" id="loginErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Hasło">
                            <span class="text-danger" id="passwordErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" name="password_confirmation" class="form-control"
                                id="password_confirmation" placeholder="Powtwierdź hasło">
                            <span class="text-danger" id="password_confirmationErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Imię *">
                            <span class="text-danger" id="nameErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="surname" class="form-control" id="surname" placeholder="Nazwisko *">
                            <span class="text-danger" id="surnameErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <select class="form-select" name="country" id="country">
                                <option selected value="Poland">Polska</option>
                                <option value="Germany">Niemcy</option>
                                <option value="Spain">Hiszpania</option>
                            </select>
                            <span class="text-danger" id="countryErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="address" class="form-control" id="address" placeholder="Adres *">
                            <span class="text-danger" id="addressErrorMsg"></span>
                        </div>
                        <div class="row mt-3">
                            <div class=" col-6 form-group">
                                <input type="text" name="zipcode" class="form-control" id="zipcode"
                                    placeholder="Kod pocztowy *">
                                <span class="text-danger" id="zipcodeErrorMsg"></span>
                            </div>
                            <div class=" col-6 form-group">
                                <input type="text" name="city" class="form-control" id="city" placeholder="Miasto">
                                <span class="text-danger" id="cityErrorMsg"></span>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Telefon *">
                            <span class="text-danger" id="phoneErrorMsg"></span>
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" name="diffrentAddress" type="checkbox" id="diffrentAddress">
                            Dostawa
                            pod inny adres </>
                        </div>
                        <div class="form-group mt-3">
                            <select class="form-select" name="countrySecond" id="countrySecond">
                                <option selected value="Poland">Polska</option>
                                <option value="Germany">Niemcy</option>
                                <option value="Spain">Hiszpania</option>
                            </select>
                            <span class="text-danger" id="countrySecondErrorMsg"></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" name="addressSecond" class="form-control" id="addressSecond"
                                placeholder="Adres *">
                            <span class="text-danger" id="addressSecondErrorMsg"></span>
                        </div>
                        <div class="row mt-3">
                            <div class=" col-6 form-group">
                                <input type="text" name="zipcodeSecond" class="form-control" id="zipcodeSecond"
                                    placeholder="Kod pocztowy *">
                                <span class="text-danger" id="zipcodeSecondErrorMsg"></span>
                            </div>
                            <div class=" col-6 form-group">
                                <input type="text" name="citySecond" class="form-control" id="citySecond"
                                    placeholder="Miasto">
                                <span class="text-danger" id="citySecondErrorMsg"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card-header">
                        2. Metoda dostawy
                    </div>
                    @foreach ($shippingMethods as $shippingMethod)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shipping" value="{{ $shippingMethod->id }}"
                                id="shippingId-{{ $shippingMethod->id }}">
                            <label class="form-check-label" for="shipping">
                                <img src="{{ asset('storage/shipping/' . $shippingMethod->img . '.png') }}" alt="brak"
                                    title="" width="100" height="50"></a>
                                {{ $shippingMethod->name }}
                            </label>

                        </div>
                    @endforeach
                    <span class="text-danger" id="shippingErrorMsg"></span>
                    <div class="card-header mt-2">
                        3. Metoda płatności
                    </div>
                    @foreach ($paymentMethods as $paymentMethod)
                        <div class="form-check" id="payment-{{ $paymentMethod->id }}">
                            <input class="form-check-input" type="radio" value="{{ $paymentMethod->id }}" name="payment">
                            <label class="form-check-label" for="payment">
                                <img src="{{ asset('storage/payment/' . $paymentMethod->img . '.png') }}" alt="brak"
                                    title="" width="100" height="50"></a>
                                {{ $paymentMethod->name }}
                            </label>
                        </div>
                    @endforeach
                    <span class="text-danger" id="paymentErrorMsg"></span>
                    <button type="button" class="btn btn-primary mt-2">Dodaj kod rabatowy</button>
                </div>

                <div class="col-4">
                    <div class="card-header">
                        4. Podsumowanie
                    </div>
                    @foreach ($cartItems as $cartItem)
                        <div class="card">
                            <div class="card-body">
                                <div class="row border-bottom pb-2">
                                    <div class="col-2">
                                        <img src="https://picsum.photos/200" alt="brak" title="" width="100"
                                            height="60"></a>
                                    </div>
                                    <div class="col-10">
                                        <div>
                                            {{ $cartItem->product->name }}
                                        </div>
                                        <div>
                                            Ilość: {{ $cartItem->quantity }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Komentarz"></textarea>
                    </div>
                    <div class="form-group">
                        <input class="form-check-input" name="newsletter" type="checkbox" value="" id="newsletter"> Zapisz
                        się,
                        aby
                        otrzymywać newsletter</>
                    </div>
                    <div class="form-group">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="terms"> Zapoznałam/em
                        się z Regulaminem zakupów</>
                        <span class="text-danger" id="termsErrorMsg"></span>
                    </div>
                    <button type="button" class="btn btn-primary btn-submit mt-2">Powtwierdź zakup</button>
                </div>

            </div>
        </form>
        <div class="alert alert-success" role="alert" id="successMsg" style="display: none">
        </div>
    </div>
@endsection
