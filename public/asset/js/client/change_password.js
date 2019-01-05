var Change_password = function() {
    $('input[type = "password"]').bind("cut copy paste", function (e) {
        e.preventDefault();
    });
    var handleChangePassword = function(){
        var form = $('#changePassword');
        var rules = {
//            pwd: { required: true },
            newpwd: {required: true },
            confirmpwd: {required: true, equalTo: '#newpwd'},
            
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    }
    
    return {
        //main function to initiate the module
        init : function(){
            handleChangePassword();
        }
    };
}();
