var Profile = function () {

    var profileInt = function () {
        
        var form = $('#editProfile');
        var rules = {
            first_name: {required: true},
            last_name: {required: true},
            mobile: {required: true,number:true},
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
    var changePassword = function () {
        
        var form = $('#changePassword');
        var rules = {
            old_password: {required: true},
            new_password: {required: true},
            c_password: {required: true,equalTo: "#password"},
            
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });
    };
    var changePicture = function () {
        
        var form = $('#changeProfile');
        var rules = {
            profilepic: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form,true);
        });
    };

 

    return {
        //main function to initiate the module
        init: function () {
            profileInt();
            changePassword();
            changePicture();
        }
    };
}();
