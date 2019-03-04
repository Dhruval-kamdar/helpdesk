<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig form-horizontal">
        <div class="form-group headingmain">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="title" style="margin:10px;"> Client List</h2>
                </div>
                <div class="col-md-6">
                    <div class="ibox-tools" style="margin-top:4px;">
<!--                        <a data-toggle="modal"  class="btn btn-primary openPopup">
                            <i class="fa fa-plus"></i> Add Document
                        </a>-->
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
                                    <th>Company Name</th>
                                    <th>Company Email</th>
                                    <th>Company Phone</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($companyName); $i++) { ?>
                                    <tr>
                                        <td><?php echo $companyName[$i]->comapnyName; ?></td>
                                        <td><?php echo $companyName[$i]->companyEmail; ?></td>
                                        <td><?php echo $companyName[$i]->companyPhone; ?></td>
                                        <td><?php echo $companyName[$i]->countryName; ?></td>
                                        <td>
                                            <a  href="<?php echo admin_url('document/viewalldocument/'.$companyName[$i]->companyId); ?>" title="View" class="editPopup"><i class="fa  fa-bars  text-navy"></i></a>
                                            <a  href="<?php echo admin_url('document/downloadalldocument/'.  $this->utility->encode($companyName[$i]->companyId)); ?>" title="Download" ><i class="fa  fa-file-pdf-o  text-navy"></i></a>        
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
