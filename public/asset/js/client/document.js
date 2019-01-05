var Document = function() {

    var handelDocumenlist = function() {

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
    var newDocument = function() {
        var form = $('#addDocuments');
        var rules = {
            document_name: {required: true},
            company_id: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    }
    var rowForm = function() {
        var form = $('#addRows');
        var rules = {
            rows: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    }
    var columnForm = function() {
        var form = $('#addColumn');
        var rules = {
            column: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    }

    var editLabel = function() {
        var form = $('#editDocument');
        var rules = {
            documentName: {required: true},
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
        $('.getId').click(function() {
            var docsId = $(this).attr('data-id');
            $('.docsId').val(docsId);
        });

        $('.itemModel').click(function() {
            var docsId = $(this).attr('data-id');
            $('.docsId').val(docsId);
            var url = baseurl + 'client/document/getDocumentItemInfo';
            var data = {docsId: docsId};
            ajaxcall(url, data, function(output) {
                var output = JSON.parse(output);
                $('.appendHtml').html(output);

            });
        });
        $('.columnModel').click(function() {
            var docsId = $(this).attr('data-id');
            $('.docsId').val(docsId);
            var url = baseurl + 'client/document/getColumnData';
            var data = {docsId: docsId};
            ajaxcall(url, data, function(output) {
                var output = JSON.parse(output);
                $('.appendColumnHtml').html(output);
            });
        });

        $('body').on('click', '.deleteRow', function() {
            $('#addRowModel').modal('hide');
            var rowId = $(this).attr('data-id');
            var labelUrl = $(this).attr('data-url');
            $('#btndelete').attr('data-url', labelUrl);
            $('#btndelete').attr('data-id', rowId);
        });
        $('body').on('click', '.appendRow', function() {
            $('.appendRowData').show();
//            var html = $('.rowAppendView').html();
//            $('.rowContriller').prepend(html);
        });

        $('.rowModel').click(function() {
            var docsId = $(this).attr('data-id');
            $('.docsId').val(docsId);
            var url = baseurl + 'client/document/getColumnaddRowData';
            var data = {docsId: docsId};
            ajaxcall(url, data, function(output) {
                var output = JSON.parse(output);
                $('.appendRowHtml').html(output);
            });
        });
        
        $('.rowListModel').click(function() {
            var docsId = $(this).attr('data-id');
            $('.docsId').val(docsId);
            var url = baseurl + 'client/document/getRowList';
            var data = {docsId: docsId};
            ajaxcall(url, data, function(output) {
                var output = JSON.parse(output);
                $('.appendRowListHtml').html(output);
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
            $('#editDocument')[0].reset();
            var docsId = $(this).attr('data-label-id');
            if (typeof docsId === 'undefined') {
                $('#editLabelModel').modal('show');
            } else {
                var url = baseurl + 'client/document/getdocsInfo';
                var data = {docsId: docsId};
                ajaxcall(url, data, function(output) {
                    var output = JSON.parse(output);
                    $('.editdocumentName').val(output.document_name);
                    $('#documentId').val(output.id);
                    $('.editCompanyId').val(output.company_id);
                    $('#editLabelModel').modal('show');
                });
            }
        });

        $('.deleteLabel').click(function() {
            var docsId = $(this).attr('data-id');
            var labelUrl = $(this).attr('data-url');
            $('#btndelete').attr('data-url', labelUrl);
            $('#btndelete').attr('data-id', docsId);
        });
        $('#btndelete').click(function() {
            var docsId = $('#btndelete').attr('data-id');
            var url = $('#btndelete').attr('data-url');
            var data = {docsId: docsId};
            ajaxcall(url, data, function(output) {
                handleAjaxResponse(output);
                var output = JSON.parse(output);
                console.log(output);
            });
        });
    }

    return {
        //main function to initiate the module
        documentList: function() {
            handelDocumenlist();
            newDocument();
            rowForm();
            columnForm();
            editLabel();
            manageItem();
            gneral();
        },
    };
}();
