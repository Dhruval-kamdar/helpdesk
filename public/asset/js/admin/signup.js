var Singup = function () {

    var signupInt = function () {
        
        var form = $('#signUp');
        var rules = {
            first_name: {required: true},
            last_name: {required: true},
            email: {required: true,email:true},
            mobile: {required: true,number:true},
            password: {required: true},
            cpassword: { required: true,equalTo: "#password"},
            company_name: {required: true},
            address_line_1: {required: true},
            address_line_2: {required: true},
            city: {required: true},
            agree: {required: true},
            postcode: {required: true,number:true},
            country: {required: true},
            
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });
    };
    return {
        //main function to initiate the module
        init: function () {
            signupInt();
        }
    };
}();
