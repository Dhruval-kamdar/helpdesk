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
            var url = baseurl + 'admin/document/getDocumentItemInfo';
            var data = {docsId: docsId};
            ajaxcall(url, data, function(output) {
                var output = JSON.parse(output);
                $('.appendHtml').html(output);

            });
        });
        $('.columnModel').click(function() {
            var docsId = $(this).attr('data-id');
            $('.docsId').val(docsId);
            var url = baseurl + 'admin/document/getColumnData';
            var data = {docsId: docsId};
            ajaxcall(url, data, function(output) {
                var output = JSON.parse(output);
                $('.appendColumnHtml').html(output);
            });
        });
        $('#btndeleteColumn').click(function() {
            var docsId = $(this).attr('data-id');
            var url = baseurl + 'admin/document/deleteColumn';
            var data = {docsId: docsId};
            ajaxcall(url, data, function(output) {
                handleAjaxResponse(output);
                var output = JSON.parse(output);
                $('#addColumnModel').modal('show');
                $('#deleteColumnModel').modal('hide');
                $('.hide_' + docsId).hide();
            });
        });
        $('#btndeleteRow').click(function() {
            var docsId = $(this).attr('data-id');
            var rowCount = $(this).attr('data-count');
            var url = baseurl + 'admin/document/deleteRow';
            var data = {docsId: docsId, 'rowCount': rowCount};
            ajaxcall(url, data, function(output) {
                handleAjaxResponse(output);
                var output = JSON.parse(output);
                $('#listRowModel').modal('show');
                $('#deleteRowModel').modal('hide');
                $('.hide_' + rowCount).hide();
            });
        });

        $(document).on('click', '.deleteRow', function(e) {
            $('#listRowModel').modal('hide');
            $('#deleteRowModel').modal('show');
            var rowId = $(this).attr('data-id');
            var labelUrl = $(this).attr('data-url');
            var labelCount = $(this).attr('data-count');
            $('#btndeleteRow').attr('data-url', labelUrl);
            $('#btndeleteRow').attr('data-id', rowId);
            $('#btndeleteRow').attr('data-count', labelCount);
        });

//         $('.deleteColumn').click(function() {
        $(document).on('click', '.deleteColumn', function(e) {
            var rowId = $(this).attr('data-id');
            var labelUrl = $(this).attr('data-url');
            $('#btndeleteColumn').attr('data-url', labelUrl);
            $('#btndeleteColumn').attr('data-id', rowId);
            $('#addColumnModel').modal('hide');
            $('#deleteColumnModel').modal('show');

        });
        $('body').on('click', '.appendRow', function() {
            $('.appendRowData').show();
//            var html = $('.rowAppendView').html();
//            $('.rowContriller').prepend(html);
        });

        $('.rowModel').click(function() {
            var docsId = $(this).attr('data-id');
            $('.docsId').val(docsId);
            var url = baseurl + 'admin/document/getColumnaddRowData';
            var data = {docsId: docsId};
            ajaxcall(url, data, function(output) {
                var output = JSON.parse(output);
                $('.appendRowHtml').html(output);
            });
        });

        $('.rowListModel').click(function() {
            $('.appendRowListHtml').empty();
            var docsId = $(this).attr('data-id');
            var docname = $(this).attr('data-docname');
            
            $('.docname').html(docname);
            $('.docsId').val(docsId);
            var url = baseurl + 'admin/document/getRowList';
            var data = {docsId: docsId};
            ajaxcall(url, data, function(output) {
                var output = JSON.parse(output);
                $('.appendRowListHtml').html(output);
            });
        });
//        alert();
        setTimeout(function(){
            $('.active .documentName').trigger('click');
        },3000);
//        $('.documentName').trigger('click');
        $('.documentName').click(function() {
            $('.appendRowListHtml').empty();
            var docsId = $(this).attr('data-id');
            var docname = $(this).attr('data-docname');
//            alert(docsId);
            $('.docname').html(docname);
            $('.docsId').val(docsId);
            var url = baseurl + 'admin/document/getTabWiseRowList';
            var data = {docsId: docsId,docname:docname};
            ajaxcall(url, data, function(output) {
                var output = JSON.parse(output);
                $('#doc_'+docsId).html(output);
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
                var url = baseurl + 'admin/document/getdocsInfo';
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
