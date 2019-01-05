var Label = function() {

    var landleLablelist = function() {

        $('.label-dataTables').DataTable({
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

        $('body').on('click', '.complete', function() {
            var userInterestId = $(this).attr('data-id');
            var muckId = $(this).attr('data-muckid');
            var data = '';
            if (muckId != "")
            {
                data = {'muckId': muckId, 'userInterestId': userInterestId, '_token': $("input[name=_token]").val()};
                ajaxcall(baseurl + 'company/update-interest-status-to-complete', data, function(output) {
                    handleAjaxResponse(output);
                    setTimeout(function() {
                        $('#myModal_interested').modal('hide');
                    }, 2000);
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
                    setTimeout(function() {
                        $('#myModal_interested').modal('hide');
                    }, 2000);
                });
            }
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
    var newLabel = function() {
        var form = $('#addNewLabel');
        var rules = {
            title: {required: true},
            company_id: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    }
    var editLabel = function() {
        var form = $('#editLabel');
        var rules = {
            title: {required: true},
            company_id: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    }
    var manageItem = function() {
        var form = $('#addItem');
        var rules = {
            item_date: {required: true},
            item_value: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    }

    var gneral = function() {
        $('.openPopup').click(function() {
            $('#myModal_addnewperson').modal('show');
        });
        $('body').on('click', '.deleteItem', function() {
            $('#addItemModel').modal('hide');
            var labelInfoId = $(this).attr('data-id');
            var labelUrl = $(this).attr('data-url');
            $('#btndelete').attr('data-url', labelUrl);
            $('#btndelete').attr('data-id', labelInfoId);
        });
        $('.itemModel').click(function() {
            var labelId = $(this).attr('data-id');
            $('.lblId').val(labelId);
            var url = baseurl + 'admin/label/getLabelItemInfo';
            var data = {labelId: labelId};
            ajaxcall(url, data, function(output) {
                var output = JSON.parse(output);
                $('.appendHtml').html(output);

            });
        });
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            autoclose: true
        });

        $('.editPopup').click(function() {
            $('#editLabel')[0].reset();
            var labelId = $(this).attr('data-label-id');
            if (typeof labelId === 'undefined') {
                $('#editLabelModel').modal('show');
            } else {
                var url = baseurl + 'admin/label/getLabelInfo';
                var data = {labelId: labelId};
                ajaxcall(url, data, function(output) {
                    var output = JSON.parse(output);
                    $('.editTitle').val(output.title);
                    $('#labelId').val(output.id);
                    $('.editCompanyId').val(output.company_id);
                    $('#editLabelModel').modal('show');
                });
            }
        });

        $('.deleteLabel').click(function() {
            var labelId = $(this).attr('data-id');
            var labelUrl = $(this).attr('data-url');
            $('#btndelete').attr('data-url', labelUrl);
            $('#btndelete').attr('data-id', labelId);
        });
        $('#btndelete').click(function() {
            var labelId = $('#btndelete').attr('data-id');
            var url = $('#btndelete').attr('data-url');
            var data = {labelId: labelId};
            ajaxcall(url, data, function(output) {
                handleAjaxResponse(output);
                var output = JSON.parse(output);
                console.log(output);
            });
        });
    }

    return {
        //main function to initiate the module
        labelList: function() {
            landleLablelist();
            newLabel();
            editLabel();
            manageItem();
            gneral();
        },
    };
}();
