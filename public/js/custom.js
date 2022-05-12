var discountId = 0;
var discountAmount = 0;
var shippingPrice = 0;

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
}
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
}
function userInputDataVisability() {
    if ($('#register').is(":checked") ) {
        $("#newAccount").show();
    } else {
        $("#newAccount").hide();
        $("#diffrentAddressSection").hide();
        $('#diffrentAddress').prop('checked', false);
    }
}
function diffrentAdressInputDataVisability() {
    if ($("#diffrentAddress").is(":checked") ) {
        $("#diffrentAddressSection").show();
    } else {
        $("#diffrentAddressSection").hide();
    }
}
function showPaymentMethodsVisability() {
       $ShippingValue = ($('input[name="shipping"]:checked').val());

       if($ShippingValue == 1||$ShippingValue == 2){
            $("#payment-1").show();
            $("#payment-2").show();
            $("#payment-3").show();
       }
       else if($ShippingValue == 3) {
            $("#payment-1").hide();
            $("#payment-2").show();
            $("#payment-3").hide();
       }
       $('input[name="payment"]').prop('checked', false);

}
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
function addDiscountToSummary(response){
    discountAmount = parseFloat(response.discount.amount).toFixed(2);
    discountAmountFixed = discountAmount.replace('.',',')
    $('#discountPrice1').html("Rabat");
    $('#discountPrice2').html(discountAmountFixed+' zł');
    updateTotalPrice()
}
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
    // Inicjalizacja
    $("#newAccount").hide();
    $("#diffrentAddressSection").hide();

    $("#register").click(function () {
        //Widoczność rejetracji
        userInputDataVisability();
    });
    $("#diffrentAddress").click(function () {
        //Widoczność adresu dostawy
        diffrentAdressInputDataVisability();
    });

    $('input[name="shipping"]').click(function () {
        showPaymentMethodsVisability();
        addShippingPriceToSummary();
    });


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
        //  Radio
        let shipping = $("input[name='shipping']:checked").val()
        let payment = $("input[name='payment']:checked").val()
        $.ajax({
            type: 'POST',
            //   url: "{{ route('formRequest.post') }}",
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
                discountId: discountId
            },
            success:function(response){
                alert('succes');
            },
            error: function(response) {
                cleanValidationMessages();
                showValidationMessages(response);
            },
        });
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
                $('#discountErrorMsg').text('');
                alert('Wprowadzono poprawny kod!')
                discountId = response.discount.id;
                addDiscountToSummary(response);
            },
            error: function(response) {
                $('#discountErrorMsg').text('');
                $('#discountErrorMsg').text(response.responseJSON.discountError);
            },
        });
    });

});
