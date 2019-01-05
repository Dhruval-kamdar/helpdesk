<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig form-horizontal">
        <div class="form-group headingmain">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="title" style="margin:10px;"> Document List</h2>
                </div>
                <div class="col-md-6">
                    <div class="ibox-tools" style="margin-top:4px;">
                      
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover label-dataTables" >
                            <thead>
                                <tr>
                                    <th>Document Name</th>
                                    <th>Company Name</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($docsArray); $i++) { ?>
                                    <tr>
                                        <td><?php echo $docsArray[$i]->document_name; ?></td>
                                        <td><?php echo $docsArray[$i]->company_name; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($docsArray[$i]->dt_created)); ?></td>
                                        <td>
                                           <a data-toggle="modal" title="List Rows"  data-id="<?php echo $docsArray[$i]->id; ?>"  data-target="#listRowModel"  class="rowListModel" ><i class="fa fa-laptop text-navy"></i></a>        
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="myModal_autocomplete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-close modal-icon"></i>
                <h4 class="modal-title">Delete</h4>
            </div>
            <div class="modal-body">
                <h4>Are you sure?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button  id='btndelete' data-url="" data-id="" type="button" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="myModal_addnewperson" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add Document</h4>
            </div>
            <form method="post" class="form-horizontal" action="<?php echo admin_url() . 'Document/addDoument' ?>" enctype="multipart/form-data" id="addDocuments" novalidate="novalidate">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="document_name" class="col-sm-3 control-label"> Document Name*</label>
                        <div class="input-group col-sm-8">
                            <input name="document_name" id="document_name" placeholder="Enter Document Name" class="form-control " type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_id" class="col-sm-3 control-label">Company</label>
                        <div class="input-group col-sm-8">
                            <select class="form-control m-b" name="company_id">
                                <option value="">- Select Client -</option>
                                <?php for ($i = 0; $i < count($companyName); $i++) { ?>
                                    <option value="<?= $companyName[$i]->companyId;?>"><?= $companyName[$i]->comapnyName;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button  type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="editLabelModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Edit Document</h4>
            </div>
            <form method="post" class="form-horizontal" action="<?php echo admin_url() . 'Document/editDocument' ?>" enctype="multipart/form-data" id="editDocument" novalidate="novalidate">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"> Document Name*</label>
                        <div class="input-group col-sm-8">
                            <input name="documentName" id="documentName" placeholder="Enter Document Name" class="form-control editdocumentName" type="text">
                            <input name="documentId" id="documentId" class="form-control documentId" type="hidden">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Company</label>
                        <div class="input-group col-sm-8">
                            <select class="form-control m-b editCompanyId" name="company_id">
                                <option value="">- Select Country -</option>
                                <?php for ($i = 0; $i < count($companyName); $i++) { ?>
                                    <option value="<?= $companyName[$i]->companyId;?>"><?= $companyName[$i]->comapnyName;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button  type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="addItemModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add Document Item</h4>
            </div>
            <form method="post" class="form-horizontal" action="<?php echo admin_url() . 'document/addDocsItem' ?>" enctype="multipart/form-data" id="addItem" novalidate="novalidate">
                <div class="modal-body">
                    <div class="form-group" id="data_1">
                        <label class="col-sm-3 control-label">Date</label>
                        <div class="input-group date col-sm-7" style="">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="item_date" value="<?php echo date("d-m-Y", strtotime("+1 month")); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"> Value*</label>
                        <div class="input-group col-sm-7">
                            <input name="item_value" id="" placeholder="Enter Value" class="form-control" type="text">
                            <input name="docsId" id="docsId" class="form-control docsId" type="hidden">
                        </div>
                    </div>
                </div>
                <div class="appendHtml"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button  type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="addRowModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add Rows</h4>
            </div>
            <form method="post" class="form-horizontal" action="<?php echo admin_url() . 'document/addRowData' ?>" enctype="multipart/form-data" id="addRows" novalidate="novalidate">
                <div class="modal-body">
                    <input name="docsId" id="docsId" class="form-control docsId" type="hidden">
                    <div class="appendRowHtml"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button  type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="addColumnModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add Column</h4>
            </div>
            <form method="post" class="form-horizontal" action="<?php echo admin_url() . 'document/addColumn' ?>" enctype="multipart/form-data" id="addColumn" novalidate="novalidate">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"> label Name*</label>
                        <div class="input-group col-sm-7">
                            <input name="column" id="column" placeholder="Enter Column" class="column form-control" type="text">
                            <input name="docsId" id="docsId" class="form-control docsId" type="hidden">
                        </div>
                    </div>
                    <div class="appendColumnHtml"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button  type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="listRowModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">List Rows</h4>
            </div>
                <div class="modal-body">
                    <input name="docsId" id="docsId" class="form-control docsId" type="hidden">
                    <div class="appendRowListHtml"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>