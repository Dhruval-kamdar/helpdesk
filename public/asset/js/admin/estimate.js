var Estimate = function() {

    var estimateList = function() {

        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
//                {extend: 'copy'},
//                {extend: 'csv'},
//                {extend: 'excel', title: 'ExampleFile'},
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


//         $('body').on('click', '.interestedlist', function() {
//            var muckId = $(this).attr('data-id');
//            var data = '';
//            if (muckId != "")
//            {
//                data = {'muckId': muckId, '_token': $("input[name=_token]").val()};
//                ajaxcall(baseurl + 'company/get-intersted-userlist', data, function(output) {
//                    $('#myModal_interested .modal-body').html(output);
//                });
//            }
//        });

    };

    var handleMail = function() {
        $('body').on('click', '.sendInvoice', function() {
            var invoiceId = $(this).attr('data-id');
            $('.invoiceId').val(invoiceId);
            $('.email_invoice').val($(this).attr('data-invoice'));
        });
        $('body').on('click', '.sendReminder', function() {
            var invoiceId = $(this).attr('data-id');
            $('.reminderInvoiceId').val(invoiceId);
            $('.reminser_invoice').val($(this).attr('data-invoice'));
        });

        $('body').on('click', '.send_estimate', function() {
            var invoiceId = $('.invoiceId').val();
            if (invoiceId != '') {
                var url = baseurl + 'admin/estimate/sendEstimateMail';
                var data = {invoiceId: invoiceId, 'type': 'invoice'};
                ajaxcall(url, data, function(output) {
                    var output = JSON.parse(output);
                    $('#myModal_Invoice_email').modal('hide');
                    showToster(output.status, output.message);
                });
            }
        });

        $('body').on('click', '.send_reminder', function() {
            var invoiceId = $('.reminderInvoiceId').val();
            if (invoiceId != '') {
                var url = baseurl + 'admin/estimate/sendEstimateMail';
                var data = {invoiceId: invoiceId, 'type': 'reminder'};
                ajaxcall(url, data, function(output) {
                    var output = JSON.parse(output);
                    $('#myModal_reminder').modal('hide');
                    showToster(output.status, output.message);
                });
            }
        });
    }
//    
//    var ticketAdd = function() {
//       
//        var form = $('#ticketsAddForm');
//        var rules = {
//            department_id: {required: true},
//            ticket_code: {required: true},
//            subject: {required: true},
//            client_id: {required: true},
//            priority: {required: true},
//            ticket_message: {required: true},
//            
//        };
//        handleFormValidate(form, rules, function(form) {
//            handleAjaxFormSubmit(form,true);
//        });
//       
//    };
//    
    var general = function() {
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            autoclose: true
        });
        $(".showDicount").click(function() {
            $(".discountDiv").toggle();
        });
        $(".recurring").click(function() {
            $(".showRecurring").toggle();
        });
        $('body').on('click', '.invoicePrint', function() {
            window.print();
        });
        $('.moreAction  li a').click(function(e) {
            e.stopPropagation();
            var encodeUrl = $('.encodeUrl').val();
            var invoiceId = $('#invoiceId').val();
            if ($(this).attr('data-value') == 'EDIT_ESTIMATE') {
                window.location.href = baseurl + 'admin/estimate/edit/' + encodeUrl;
            } else if ($(this).attr('data-value') == 'ESTIMATE_HISTORY') {
                window.location.href = baseurl + 'admin/estimate/history/' + encodeUrl;
            } else if ($(this).attr('data-value') == 'DELETE_ESTIMATE') {
                $('#myModal_autocomplete').modal('show');
                $('#btndelete').attr('data-url', baseurl + 'admin/estimate/deleteEstimate');
                $('#btndelete').attr('data-id', invoiceId);
            } else if ($(this).attr('data-value') == 'SEND_REMAINDER') {
                $('#myModal_reminder').modal('show');
                $('#btndelete').attr('data-id', invoiceId);
            } else if ($(this).attr('data-value') == 'EMAIL_ESTIMATE') {
                $('#myModal_Invoice_email').modal('show');
                $('#btndelete').attr('data-id', invoiceId);
            }
        });

        $('body').on('change', '#client_id', function() {
            var reporter = $('#client_id option:selected').val();
            if (reporter != '') {
                var url = baseurl + 'admin/tickets/getCompanyName';
                var data = {reporter: reporter};
                ajaxcall(url, data, function(output) {
                    var output = JSON.parse(output);
                    $('.compnayName').text(output[0]['name']);
                    $('.compnayId').val(output[0]['id']);
                });
            }
        });


    }

    var invoiceAdd = function() {


        var form = $('#invoiceAdd');
        var rules = {
            ref_no: {required: true},
            due_date: {required: true, },
            client_id: {required: true},
            default_tax: {required: true},
            discount: {required: true, number: true},
            currency: {required: true},
            notes: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });



    };

    var invoiceEdit = function() {
        var form = $('#invoiceEdit');
        var rules = {
            ref_no: {required: true},
            due_date: {required: true, },
            client_id: {required: true},
            default_tax: {required: true},
            discount: {required: true, number: true},
            currency: {required: true},
            notes: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
        
         $('body').on('click', '.pdfmail', function() {
             var url = $(this).attr('data-href');
            
                var data = {reporter: '1'};
                ajaxcall(url, data, function(output) {
                    var output = JSON.parse(output);
                    showToster(output.status, output.message);
                });
        });
    };
    var invoiceDetail = function() {

        var form = $('#invoiceDetail');
        var rules = {
            item_name: {required: true},
            item_desc: {required: true},
            price: {required: true, number: true},
            quentiry: {required: true, number: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    };

    var invoicePay = function() {
        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, {color: '#CB080D'});

        $('body').on('blur', '.amount', function() {
            var amount = parseInt($(".amount").val());
            var totalAmount = parseInt($(".totalAmount").val());
            if (amount > totalAmount) {
                showToster('error', 'Amount no more then total amount');
                $('.submitBtn').attr('disabled', true);
            } else {
                $('.submitBtn').attr('disabled', false);
            }
        });
    };
    var invoicePayment = function() {

        var form = $('#invoicePayment');
        var rules = {
            item_name: {required: true},
            item_desc: {required: true},
            price: {required: true, number: true},
            quentiry: {required: true, number: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    };
    var estimatePayment = function() {
        var form = $('#estimatePayment');
        var rules = {
            payment_date: {required: true},
            payment_method: {required: true},
            amount: {required: true, number: true},
            notes: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    };
    var invoiceExpense = function() {
        var form = $('#expenseForm');
        var rules = {
            expense_name: {required: true},
            expense_desc: {required: true},
            price: {required: true, number: true},
            quentiry: {required: true, number: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    };


    var deleteInvoicePayment = function() {
        $('body').on('click', '.deletePayment', function() {
            var personId = $(this).attr('data-id');
            var dataUrl = $(this).attr('data-href');
            $('#btndelete').attr('data-url', dataUrl);
            $('#btndelete').attr('data-id', personId);
        });
        handleDelete();
    }


    return {
        //main function to initiate the module
        estimateList: function() {
            estimateList();
            handleMail();
        },
        invoiceAdd: function() {
            general();
            invoiceAdd();
        },
        payInit: function() {
            invoicePay();
            general();
            invoicePayment();
            estimatePayment();
        },
        initExpense: function() {
            invoiceExpense();
            deleteInvoicePayment();
        },
        initEdit: function() {
            invoiceEdit();
            invoiceDetail();
            deleteInvoicePayment();
            general();
            handleMail();
            setTimeout(function() {
                $('#client_id').trigger('change');
            }, 2000);
        },
    };
}();
