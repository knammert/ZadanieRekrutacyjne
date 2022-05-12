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

function userInputData() {
    $("#register").click(function () {

        if ($(this).is(":checked") ) {
            $("#newAccount").show();
        } else {
            $("#newAccount").hide();
            $("#diffrentAddressSection").hide();
            $('#diffrentAddress').prop('checked', false);
        }
    });
}

function diffrentAdressInputData() {
    $("#diffrentAddress").click(function () {

        if ($(this).is(":checked") ) {
            $("#diffrentAddressSection").show();
        } else {
            $("#diffrentAddressSection").hide();
        }
    });
}

function showPaymentMethods() {


    $('input[name="shipping"]').click(function () {
       $ShippingValue = $('input[name="shipping"]:checked').val();
       if($ShippingValue == 1||$ShippingValue == 2){
            $("#payment-1").show();
            $("#payment-2").hide();
            $("#payment-3").show();

       }
       else if($ShippingValue == 3) {
        $("#payment-1").hide();
        $("#payment-2").show();
        $("#payment-3").hide();
       }

       $('input[name="payment"]').prop('checked', false);
    });
}

function showHidePassword(){
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
}


$(document).ready(function () {

    $("#newAccount").hide();
    $("#diffrentAddressSection").hide();
    userInputData();
    diffrentAdressInputData();
    showPaymentMethods();
    showHidePassword();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-submit").click(function(e) {
        e.preventDefault();
        //  Checkboxes
        let register =  document.getElementById('register').checked ? true : false;
        let diffrentAddress =  document.getElementById('diffrentAddress').checked ? true : false;
        let newsletter =  document.getElementById('newsletter').checked ? true : false;
        let terms =  document.getElementById('terms').checked ? true : false;
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
                terms: terms
            },
            success:function(response){
                $('#successMsg').show();
            },
            error: function(response) {
                console.log(response);
                cleanValidationMessages();
                showValidationMessages(response);
            },
        });
    });
});
