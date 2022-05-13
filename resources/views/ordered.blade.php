@extends('welcome')
@section('content')
    <div class="h-100" style="background-color: ">
        <div class="container py-5 ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card border-top">
                        <div class="card-body p-5">
                            <p class="lead fw-bold mb-5">Dziękujemy {{ app('request')->input('name') }} za złożenie
                                zamówienia!</p>
                            <div class="row">
                                <div class="col mb-3">
                                    <p class="small text-muted mb-1">Data złożenia zmówienia</p>
                                    <p>{{ app('request')->input('orderDate') }}</p>
                                </div>
                                <div class="col mb-3">
                                    <p class="small text-muted mb-1">Nr zamówienia</p>
                                    <p>{{ app('request')->input('orderNumber') }}</p>
                                </div>
                            </div>

                            <div class="row my-4">
                                <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-9">
                                    <p class="lead fw-bold mb-0">Kwota:
                                        {{ number_format(app('request')->input('total'), 2) }} zł</p>
                                </div>
                            </div>
                            <button onclick="window.location.href='/'" type="button" class="loginButton mt-2 "
                                id="discountButton">Powrót na stronę główną</button>
                            <p class="mt-4 pt-2 mb-0">Potrzebujesz pomocy? <a href="#!" style="color: #e54444;">Skontaktuj
                                    się z nami.
                                </a></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
