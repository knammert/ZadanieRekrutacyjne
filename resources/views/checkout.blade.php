@extends('welcome')
@section('content')
    <div>
        <h1>Zadanie rekrutacyjne</h1>
        <div class="row m-3">
            <div class="col-4">
                <div class="card-header">
                    1. Twoje dane
                </div>
                <button type="button" class="btn btn-primary mt-2">Logowanie</button>
                <div class="mt-1">
                    Masz już konto? Kliknij żeby się zalogować.
                </div>
                <form method="POST" action={{ route('formRequest.post') }} enctype="multipart/form-data">
                    @csrf
                    <input class="form-check-input" name="register" type="checkbox" value="" id="register"> Stwórz nowe konto</>
                    {{-- Rejestracja --}}
                    <div class="form-group">
                        <input type="text" name="login" class="form-control" id="login" placeholder="Login">
                        @error('login')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Hasło">
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <input type="password" name="password2" class="form-control" id="password2"
                            placeholder="Powtwierdź hasło">
                        @error('password2')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Imię *">
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" name="surname" class="form-control" id="surname" placeholder="Nazwisko *">
                        @error('surname')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <select class="form-select" name="country" id="country">
                            <option selected value="Poland">Polska</option>
                            <option value="Germany">Niemcy</option>
                            <option value="Spain">Hiszpania</option>
                        </select>
                        @error('country')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" name="address" class="form-control" id="address" placeholder="Adres *">
                        @error('surname')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <div class=" col-6 form-group">
                            <input type="text" name="zipcode" class="form-control" id="zipcode"
                                placeholder="Kod pocztowy *">
                            @error('zipcode')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class=" col-6 form-group">
                            <input type="text" name="city" class="form-control" id="city" placeholder="Miasto">
                            @error('city')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Telefon *">
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
            <div class="col-4">
                <div class="card-header">
                    2. Metoda dostawy
                </div>
                @foreach ($shippingMethods as $shippingMethod)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="shipping" id="shipping">
                        <label class="form-check-label" for="shipping">
                            <img src="{{ asset('storage/shipping/' . $shippingMethod->img . '.png') }}" alt="brak"
                                title="" width="100" height="50"></a>
                            {{ $shippingMethod->name }}
                        </label>
                    </div>
                @endforeach
                <div class="card-header mt-2">
                    3. Metoda płatności
                </div>
                @foreach ($paymentMethods as $paymentMethod)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="payment">
                        <label class="form-check-label" for="payment">
                            <img src="{{ asset('storage/payment/' . $paymentMethod->img . '.png') }}" alt="brak" title=""
                                width="100" height="50"></a>
                            {{ $paymentMethod->name }}
                        </label>
                    </div>
                @endforeach
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
                                    <img src="https://picsum.photos/200" alt="brak" title="" width="100" height="60"></a>
                                </div>
                                <div class="col-10">
                                    <div>
                                       {{$cartItem->product->name}}
                                    </div>
                                    <div>
                                       Ilość:  {{$cartItem->quantity}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
                <div class="form-group">
                    <textarea class="form-control" id="comment"  name="comment" rows="3" placeholder="Komentarz"></textarea>
                </div>
                <div class="form-group">
                    <input class="form-check-input" name="register" type="checkbox" value="" id="register"> Zapisz się, aby otrzymywać newsletter</>
                </div>
                <div class="form-group">
                    <input class="form-check-input" name="register" type="checkbox" value="" id="register"> Zapoznałam/em się z Regulaminem zakupów</>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Złóż zamówienie</button>
            </div>
        </div>
        </form>
    </div>
    {{-- <script type="text/javascript">
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $(".btn-submit").click(function(e){

    e.preventDefault();

    var name = $("input[name=name]").val();

    $.ajax({
    type:'POST',
    url:"{{ route('formRequest.post') }}",
    data:{name:name},
    success:function(data){
        alert(data.success);
    }
    });

    });
    </script> --}}
@endsection
