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
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i < 50; $i++) { ?>
                                    <tr>
                                        <td><?php echo 'Title ' . $i; ?></td>
                                        <td><?php echo date('d-m-Y'); ?></td>
                                        <td><?php echo date('d-m-Y'); ?></td>
                                        <td>
                                            <a data-toggle="modal" title="Edit" class="openPopup"><i class="fa fa-edit text-navy"></i></a>
                                            <a data-toggle="modal" title="Delete" data-target="#myModal_autocomplete"  class="" href="javascript;;"><i class="fa fa-close text-navy"></i></a>        
                                            <a data-toggle="modal" title="add Item" data-target="#addItemModel"  class="" href="javascript;;"><i class="fa fa-anchor text-navy"></i></a>        
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
            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addNewLabel" novalidate="novalidate">
                <div class="modal-body">
                    <div class="form-group">
                        <label> Title*</label>
                        <input name="title" id="person_fname" placeholder="Enter Title" class="form-control " type="text">
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
            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="addNewLabel" novalidate="novalidate">
                <div class="modal-body">
                    <div class="form-group">
                        <label> Date*</label>
                        <input name="title" id="person_fname" placeholder="Enter Title" class="form-control " type="text">
                    </div>
                    <div class="form-group">
                        <label> Value*</label>
                        <input name="title" id="person_fname" placeholder="Enter Title" class="form-control " type="text">
                    </div>
                </div>
                    <table class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i < 5; $i++) { ?>
                                <tr>
                                    <td><?php echo date('d-m-Y'); ?></td>
                                    <td><?php echo 'Value ' . $i; ?></td>
                                    <td>
                                        <a data-toggle="modal" data-target="#myModal_autocomplete"  class="" href="javascript;;"><i class="fa fa-close text-navy"></i></a>        
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button  type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>