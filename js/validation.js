$(document).ready(function () {
    $("#register-form").submit(function (e) {

        e.preventDefault(e);

        var errors = Array();

        if ($('#email').val() == "") {
            errors.push("Email is empty<br>");
        }

        // Are the passwords empty
        if (($('#password').val() == "" || $('#confirm_password').val() == "")) {
            errors.push("Password Fields can't be empty<br>");
            $('#password').val('');
            $('#confirm_password').val('');
        } else {
            // Does the passwords match
            if ($('#password').val() !== $('#confirm_password').val()) {
                errors.push("Passwords dont match<br>");
                $('#password').val('');
                $('#confirm_password').val('');
                // Password length > 8
            } else if ($('#confirm_password').val().length < 8) {
                errors.push("Password length too short (min length = 8)<br>");
                $('#password').val('');
                $('#confirm_password').val('');
            }
        }

        if ($('#firstname').val() == "") {
            errors.push("First name can't be empty<br>");
        }
        if ($('#lastname').val() == "") {
            errors.push("Last name can't be empty<br>");
        }
        if ($('#phoneNumber').val() == "") {
            errors.push("Phone Number can't be empty<br>");
        }
        if ($('#dateOfBirth').val() == "") {
            errors.push("Date Of Birth can't be empty");
        }

        if (errors.length > 0) {
            var errorString = "";
            for (let i = 0; i < errors.length; i++) {
                errorString += errors[i];
            }
            $('#error-msg').addClass('error-msg').html("<strong>There were some problems:</strong> <br>" + errorString);
        } else {
            $('#register-form').unbind('submit').submit();
        }
    });
    $("#update-form").submit(function (e) {
        e.preventDefault(e);
        var errors = Array();
        if ($('#firstname').val() == "") {
            errors.push("First name can't be empty<br>");
        }
        if ($('#lastname').val() == "") {
            errors.push("Last name can't be empty<br>");
        }
        if ($('#number').val() == "") {
            errors.push("Phone Number can't be empty<br>");
        }
        if ($('#dob').val() == "") {
            errors.push("Date Of Birth can't be empty");
        }
        if (errors.length > 0) {
            var errorString = "";
            for (let i = 0; i < errors.length; i++) {
                errorString += errors[i];
            }
            $('#error-msg').addClass('error-msg').html("<strong>There were some problems:</strong> <br>" + errorString);
        } else {
            $('#update-form').unbind('submit').submit();
        }
    });
});