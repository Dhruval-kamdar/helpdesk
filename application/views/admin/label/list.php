<style>

</style>
<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig form-horizontal">
        <div class="form-group headingmain">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="title" style="margin:10px;"> Label List</h2>
                </div>
                <div class="col-md-6">
                    <div class="ibox-tools" style="margin-top:4px;">
                        <a data-toggle="modal"  class="btn btn-primary openPopup">
                            <i class="fa fa-plus"></i>Add Label
                        </a>
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
                                    <th>Title</th>
                                    <th>Company Name</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($labelArray); $i++) { ?>
                                    <tr>
                                        <td><?php echo $labelArray[$i]->title; ?></td>
                                        <td><?php echo $labelArray[$i]->company_name; ?></td>
                                        <td><?php  echo date('d-m-Y',  strtotime($labelArray[$i]->dt_created)); ?></td>
                                        <td>
                                            <a data-toggle="modal" title="Edit" data-label-id="<?php echo $labelArray[$i]->id; ?>" class="editPopup"><i class="fa fa-edit text-navy"></i></a>
                                            <a data-toggle="modal" title="Delete" data-target="#myModal_autocomplete"  class="deleteLabel" data-url="<?php echo admin_url().'label/deleteLabel' ?>" data-id="<?php echo $labelArray[$i]->id; ?>" ><i class="fa fa-close text-navy"></i></a>        
                                            <a data-toggle="modal" title="Add Item"  data-id="<?php echo $labelArray[$i]->id; ?>"  data-target="#addItemModel"  class="itemModel" ><i class="fa fa-anchor text-navy"></i></a>        
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
                <h4 class="modal-title">Add new Label</h4>
            </div>
            <form method="post" class="form-horizontal" action="<?php echo admin_url() . 'Label/addNewLable' ?>" enctype="multipart/form-data" id="addNewLabel" novalidate="novalidate">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"> Title*</label>
                        <div class="input-group col-sm-8">
                            <input name="title" id="title" placeholder="Enter Title" class="form-control " type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Company</label>
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
                <h4 class="modal-title">Edit Label</h4>
            </div>
            <form method="post" class="form-horizontal" action="<?php echo admin_url() . 'Label/EditLable' ?>" enctype="multipart/form-data" id="editLabel" novalidate="novalidate">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"> Title*</label>
                        <div class="input-group col-sm-8">
                            <input name="title" id="title" placeholder="Enter Title" class="form-control editTitle" type="text">
                            <input name="labelId" id="labelId" class="form-control labelId" type="hidden">
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
                <h4 class="modal-title">Add Item</h4>
            </div>
            <form method="post" class="form-horizontal" action="<?php echo admin_url().'label/addItem' ?>" enctype="multipart/form-data" id="addItem" novalidate="novalidate">
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
                            <input name="item_value" id="" placeholder="Enter Value" class="form-control " type="text">
                            <input name="labelId" id="lblId" class="form-control lblId" type="hidden">
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