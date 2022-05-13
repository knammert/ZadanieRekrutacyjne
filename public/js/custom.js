// Zmienne do wyświetlania kwoty podsumowania
var discountId = 0;
var discountAmount = 0;
var shippingPrice = 0;

//Usunięcie klas walidacji
function cleanValidationMessages() {
    $('#loginErrorMsg').text('');
    $('#passwordErrorMsg').text('');
    $('#nameErrorMsg').text('');
    $('#surnameErrorMsg').text('');
    $('#countryErrorMsg').text('');
    $('#addressErrorMsg').text('');
    $('#zipcodeErrorMsg').text('');
    $('#cityErrorMsg').text('');
    $('#phoneErrorMsg').text('');
    $('#countrySecondErrorMsg').text('');
    $('#addressSecondErrorMsg').text('');
    $('#zipcodeSecondErrorMsg').text('');
    $('#citySecondErrorMsg').text('');
    $('#shippingErrorMsg').text('');
    $('#paymentErrorMsg').text('');
    $('#termsErrorMsg').text('');
    $('#discountErrorMsg').text('');
    $('#registerErrorMsg').text('');
}
//Wyświetlnie klas walidacji
function showValidationMessages(response) {
$('#loginErrorMsg').text(response.responseJSON.errors.login);
$('#passwordErrorMsg').text(response.responseJSON.errors.password);
$('#nameErrorMsg').text(response.responseJSON.errors.name);
$('#surnameErrorMsg').text(response.responseJSON.errors.surname);
$('#countryErrorMsg').text(response.responseJSON.errors.country);
$('#addressErrorMsg').text(response.responseJSON.errors.address);
$('#zipcodeErrorMsg').text(response.responseJSON.errors.zipcode);
$('#cityErrorMsg').text(response.responseJSON.errors.city);
$('#phoneErrorMsg').text(response.responseJSON.errors.phone);
$('#countrySecondErrorMsg').text(response.responseJSON.errors.countrySecond);
$('#addressSecondErrorMsg').text(response.responseJSON.errors.addressSecond);
$('#zipcodeSecondErrorMsg').text(response.responseJSON.errors.zipcodeSecond);
$('#citySecondErrorMsg').text(response.responseJSON.errors.citySecond);
$('#shippingErrorMsg').text(response.responseJSON.errors.shipping);
$('#paymentErrorMsg').text(response.responseJSON.errors.payment);
$('#termsErrorMsg').text(response.responseJSON.errors.terms);
$('#registerErrorMsg').text(response.responseJSON.errors.register);
$('#captchaErrorMsg').text(response.responseJSON.errors['g-recaptcha-response']);
}
//Wyświetlenie formularza rejestracji
function userInputDataVisability() {
    if ($('#register').is(":checked") ) {
        $("#newAccount").show();
    } else {
        $("#newAccount").hide();
        $("#diffrentAddressSection").hide();
        $('#diffrentAddress').prop('checked', false);
    }
}
//Wyświetlenie dodatkowego adresu dostawy
function diffrentAdressInputDataVisability() {
    if ($("#diffrentAddress").is(":checked") ) {
        $("#diffrentAddressSection").show();
    } else {
        $("#diffrentAddressSection").hide();
    }
}
//Wyświetlenie metod płatności w zależności od wybranej metody dostawy
function showPaymentMethodsVisability() {
       $ShippingValue = ($('input[name="shipping"]:checked').val());

       if($ShippingValue == 1||$ShippingValue == 2){
            $("#payment-1").addClass("d-flex").removeClass("d-none");
            $("#payment-1").show();
            $("#payment-2").show();
            $("#payment-3").addClass("d-flex").removeClass("d-none");
            $("#payment-3").show();
       }
       else if($ShippingValue == 3) {
            $("#payment-1").removeClass("d-flex").addClass("d-none");
            $("#payment-1").hide();
            $("#payment-2").show();
            $("#payment-3").removeClass("d-flex").addClass("d-none");
            $("#payment-3").hide();
       }
       $('input[name="payment"]').prop('checked', false);

}
//Dodanie tekstu kosztu dostawy po wybraniu metody płatności
function addShippingPriceToSummary(){

        switch (($('input[name="shipping"]:checked').val())) {
        case '1':
            $('#shippingPrice1').html("Koszt Dostawy");
            $('#shippingPrice2').html("+10,99 zł");
            shippingPrice = '10.99';
            break;
        case '2':
            $('#shippingPrice1').html("Koszt Dostawy");
            $('#shippingPrice2').html("+18,00 zł");
            shippingPrice = '18.00';
            break;
        case '3':
            $('#shippingPrice1').html("Koszt Dostawy");
            $('#shippingPrice2').html("+22,00 zł");
            shippingPrice = '22.00';
            break;
        }
        updateTotalPrice();
}
//Dodanie tekstu rabatu po wprowadzeniu dobrego kodu
function addDiscountToSummary(response){
    discountAmount = parseFloat(response.discount.amount).toFixed(2);
    discountAmountFixed = discountAmount.replace('.',',')
    $('#discountPrice1').html("Rabat");
    $('#discountPrice2').html(discountAmountFixed+' zł');
    updateTotalPrice()
}
//Aktualizacja kosztu zamówienia w podsumowaniu
function updateTotalPrice(){
    let summaryPrice;
    shippingPrice = parseFloat(shippingPrice);
    discountAmount = parseFloat(discountAmount);
    totalPrice = parseFloat(totalPrice);

    summaryPrice = shippingPrice +  discountAmount + totalPrice;
    summaryPrice = parseFloat(summaryPrice).toFixed(2);
    summaryPrice = summaryPrice.replace('.',',')
    $('#summaryPrice').html(summaryPrice +' zł');

}


$(document).ready(function () {
    //Tłumaczenie wiadomości walidacji
    jQuery.extend(jQuery.validator.messages, {
        required: "Pole jest wymagane",
        maxlength: jQuery.validator.format("Wprowadź nie więcej niż {0} znaków."),
        minlength: jQuery.validator.format("Wprowadź więcej niż {0} znaków."),
        equalTo: jQuery.validator.format("Podane hasła nie zgadzają się."),
        digits: jQuery.validator.format("Proszę wprowadzić wyłącznie liczby."),
    });
    //Walidacja z użyciem jquery validator
    $("#checkoutForm").validate({
        errorElement: 'span',
        errorClass: 'desc',
        rules: {
            login: {
                required: true,
                minlength: 3,
                maxlength: 16
            },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                minlength: 6,
                equalTo : "#password"
            },
            name : "required",
            surname: "required",
            country: "required",
            address: "required",
            zipcode: "required",
            city: "required",
            phone: {
                required: true,
                digits: true,
            },
            countrySecond: "required",
            addressSecond: "required",
            zipcodeSecond: "required",
            citySecond: "required",
            shipping: "required",
            payment: "required",
            terms: "required"
        },

        errorPlacement: function(error, element) {
            if (element.attr("name") == "shipping") {
                $("#shippingErrorMsg").html( error );

            }
            else if (element.attr("name") == "payment") {
                $("#paymentErrorMsg").html( error );
            }
            else if (element.attr("name") == "terms") {
                $("#termsErrorMsg").html( error );
            }
            else{
                error.insertAfter(element);
            }
        }
    });

    $("#newAccount").hide();
    $("#diffrentAddressSection").hide();
    //Wyświetlanie/chowanie hasła
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-solid fa-eye-slash" );
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    //Checkbox rejestracji
    $("#register").click(function () {
        userInputDataVisability();
    });
    //Checkbox innego adresu dostawy
    $("#diffrentAddress").click(function () {
        diffrentAdressInputDataVisability();
    });
    //Checkbox metody dostawy
    $('input[name="shipping"]').click(function () {
        showPaymentMethodsVisability();
        addShippingPriceToSummary();
    });
    //Deklaracja tokensu CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //Obsługa formularza nowego zamówienia
    $(".btn-submit").click(function(e) {
        e.preventDefault();
        //  Checkboxes
        let register =  document.getElementById('register').checked ? 1 : 0;
        let diffrentAddress =  document.getElementById('diffrentAddress').checked ? 1 : 0;
        let newsletter =  document.getElementById('newsletter').checked ? 1 : 0;
        let terms =  document.getElementById('terms').checked ? 1 : 0;
        //  Data
        let login = $('#login').val();
        let idCart = $('#idCart').val();
        let password = $('#password').val();
        let password_confirmation = $('#password_confirmation').val();
        let name = $('#name').val();
        let surname = $('#surname').val();
        let country = $('#country').val();
        let address = $('#address').val();
        let zipcode = $('#zipcode').val();
        let city = $('#city').val();
        let phone = $('#phone').val();
        let addressSecond = $('#addressSecond').val();
        let zipcodeSecond = $('#zipcodeSecond').val();
        let citySecond = $('#citySecond').val();
        let comment = $('#comment').val();
        let gRecaptchaResponse = $('#g-recaptcha-response').val();
        //  Radio
        let shipping = $("input[name='shipping']:checked").val();
        let payment = $("input[name='payment']:checked").val();

        //Wywołanie walidacji
        if($("#checkoutForm").valid()==true){
            $('#checkoutForm').validate().resetForm();
            $.ajax({
                type: 'POST',
                url:'/formRequest',
                data: {
                    idCart : idCart,
                    login: login,
                    password: password,
                    password_confirmation: password_confirmation,
                    name: name,
                    surname: surname,
                    country: country,
                    address: address,
                    zipcode: zipcode,
                    city: city,
                    phone: phone,
                    addressSecond: addressSecond,
                    zipcodeSecond: zipcodeSecond,
                    citySecond: citySecond,
                    shipping: shipping,
                    payment: payment,
                    comment: comment,
                    register: register,
                    diffrentAddress:diffrentAddress,
                    newsletter: newsletter,
                    terms: terms,
                    discountId: discountId,
                    'g-recaptcha-response':gRecaptchaResponse
                },
                success:function(response){
                    console.log(response);
                    window.location=response.url;
                },
                error: function(response) {
                    console.log(response);
                    cleanValidationMessages();
                    showValidationMessages(response);
                },
            });
        }

    });
    //Obsułga formularza kodu rabatowego
    $(".discountButton").click(function(e) {
        e.preventDefault();
        let discountCode = $('#discountCode').val();
        $.ajax({
            type: 'POST',
            url:'/checkDiscount',
            data: {
                discountCode:discountCode
            },
            success:function(response){
                $('#discountErrorMsg').removeClass('text-danger').addClass('text-success');
                $('#discountErrorMsg').text('Pomyślnie dodano kod rabatowy');

                discountId = response.discount.id;
                addDiscountToSummary(response);
            },
            error: function(response) {
                console.log(response);
                $('#discountErrorMsg').removeClass('text-success').addClass('text-danger');
                $('#discountErrorMsg').text('');
                $('#discountErrorMsg').text(response.responseJSON.errors.discountCode);
            },
        });
    });

});
