var Client = function() {

    var clientList = function() {

        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},
                {extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                    }
                }
            ]

        });
        
        
         $('body').on('click', '.interestedlist', function() {
            var muckId = $(this).attr('data-id');
            var data = '';
            if (muckId != "")
            {
                data = {'muckId': muckId, '_token': $("input[name=_token]").val()};
                ajaxcall(baseurl + 'company/get-intersted-userlist', data, function(output) {
                    $('#myModal_interested .modal-body').html(output);
                });
            }
        });
         $('body').on('click', '.acceptinterest', function() {
            var userInterestId = $(this).attr('data-id');
            var muckId = $(this).attr('data-muckid');
            var data = '';
            if (muckId != "")
            {
                data = {'muckId': muckId,'userInterestId':userInterestId, '_token': $("input[name=_token]").val()};
                ajaxcall(baseurl + 'company/update-interest-status', data, function(output) {
                    handleAjaxResponse(output);
                    setTimeout(function(){
                        $('#myModal_interested').modal('hide');
                    },2000);
                });
            }
        });
         $('body').on('click', '.complete', function() {
            var userInterestId = $(this).attr('data-id');
            var muckId = $(this).attr('data-muckid');
            var data = '';
            if (muckId != "")
            {
                data = {'muckId': muckId,'userInterestId':userInterestId, '_token': $("input[name=_token]").val()};
                ajaxcall(baseurl + 'company/update-interest-status-to-complete', data, function(output) {
                    handleAjaxResponse(output);
                    setTimeout(function(){
                        $('#myModal_interested').modal('hide');
                    },2000);
                });
            }
        });
         $('body').on('click', '.resetall', function() {
           
            var muckId = $(this).attr('data-muckid');
            var data = '';
            if (muckId != "")
            {
                data = {'muckId': muckId, '_token': $("input[name=_token]").val()};
                ajaxcall(baseurl + 'company/reset-interest-status', data, function(output) {
                    handleAjaxResponse(output);
                    setTimeout(function(){
                        $('#myModal_interested').modal('hide');
                    },2000);
                });
            }
        });
    };
    var clientAdd = function() {
       
        
        var form = $('#clientAdd');
        var rules = {
            company_name: {required: true},
            company_email: {required: true,email:true},
            company_phone: {required: true,number:true},
            additional_information: {required: true},
            person_fname: {required: true},
            person_lname: {required: true},
            person_email: {required: true,email:true},
            company_password: {required: true},
            company_confirm_password: {required: true,equalTo:'#password'},
            company_user_phone: {required: true},
            address: {required: true},
            
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
       
    };
    var clientEdit = function() {
       
        var form = $('#clientEdit');
        var rules = {
            company_name: {required: true},
            company_phone: {required: true,number:true},
            company_email: {required: true,email:true},
            additional_information: {required: true},
//            person_fname: {required: true},
//            person_lname: {required: true},
//            person_email: {required: true,email:true},
//            company_user_phone: {required: true,number:true},
//            address: {required: true},
            
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    };
    
    
    var clientDetail = function() {
       
        
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},
                {extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                    }
                }
            ]

        });
    };
    
    var addNewPerson = function(){
        var form = $('#addNewPerson');
        var rules = {
            person_fname: {required: true},
            person_lname: {required: true},
            person_email: {required: true,email:true},
            company_password: {required: true},
            company_confirm_password: {required: true,equalTo:'#password'},
            company_user_phone: {required: true},
            address: {required: true},
            
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    }
    
    var gneral = function(){
        $('.openPopup').click(function(){
            $('#addNewPerson')[0].reset();
            var companyId = $(this).attr('data-company-id');
            var personId = $(this).attr('data-id');
            if(typeof personId === 'undefined'){
                $('#myModal_addnewperson').modal('show');
                $('#company_id').val(companyId);
            }else{
               var url = baseurl + 'admin/client/getPersonInfo';
               var data = { companyId : companyId , personId : personId};
                ajaxcall(url,data,function(output){
                    var output = JSON.parse(output);
                    $('.modal-title').text('Edit Person')
                    $('.password').hide();
                    $('.company_confirm_password').hide();
                    $('#person_email').attr('readonly',true);
                    $('#person_email').val(output[0].email);
                    $('#company_id').val(companyId);
                    $('#person_fname').val(output[0].first_name);
                    $('#person_lname').val(output[0].last_name);
                    $('#company_user_phone').val(output[0].phone_no);
                    $('#address').val(output[0].address);
                    $('#person_id').val(personId);
                    
                    $('#myModal_addnewperson').modal('show');
                });
            }
            
        });
        
        $('body').on('click','.deletebutton',function(){
            var personId = $(this).attr('data-id');
            var dataUrl = $(this).attr('data-href');
          
            $('#btndelete').attr('data-url',dataUrl);
            $('#btndelete').attr('data-id',personId);
            
        });
        handleDelete();
    }
    
    return {
        //main function to initiate the module
        clientList: function() {
            clientList();
            gneral();
        },
        clientAdd: function() {
            clientAdd();
        },
        clientEdit: function() {
            clientEdit();
        },
        clientDetail: function() {
            clientDetail();
            addNewPerson();
            gneral();
        }
    };
}();
