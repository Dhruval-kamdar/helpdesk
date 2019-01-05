<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tickets List</h5>
                        <div class="ibox-tools">
                            <a href="<?= client_url(); ?>tickets/add" class="btn btn-primary">
                                <i class="fa fa-plus"></i>Add New
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Ticket Code</th>
                                        <th>Subject</th>
                                        <th>Department</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($getTicket); $i++) { ?>
                                        <tr>
                                            <td><?= $getTicket[$i]->companyName; ?></td>
                                            <td><?= $getTicket[$i]->ticket_code; ?></td>
                                            <td><?= $getTicket[$i]->subject; ?></td>
                                            <td><?= $getTicket[$i]->name; ?></td>
                                            <td><?= $getTicket[$i]->priority; ?></td>
                                            <td>
                                                <?php
                                                if (getStatus($getTicket[$i]->status) == 'New') {
                                                    $color = 'background-color:#999999;color:white;';
                                                } else if (getStatus($getTicket[$i]->status) == 'Answered') {
                                                    $color = 'background-color:#1a7bb9;color:white;';
                                                } else if (getStatus($getTicket[$i]->status) == 'Closed') {
                                                    $color = 'background-color:#999999;color:white;';
                                                } else if (getStatus($getTicket[$i]->status) == 'Open') {
                                                    $color = 'background-color:red;color:white;';
                                                } else if (getStatus($getTicket[$i]->status) == 'In Progress') {
                                                    $color = 'background-color:green;color:white;';
                                                }
                                                ?>
                                                <span class="btn btn-xs" style="<?php echo $color; ?>">  <?php echo getStatus($getTicket[$i]->status); ?> </span>
                                            </td>
                                            <td class="tooltip-demo">   
                                                <a title="Preview Ticket" data-toggle="tooltip" data-placement="top" href="<?= client_url().'tickets/edit/' .  $this->utility->encode($getTicket[$i]->id); ?>"> <i class="fa fa-edit text-navy"></i> </a>
                                                <a title="Edit Ticket" data-toggle="tooltip" data-placement="top" href="<?= client_url().'tickets/view/'.  $this->utility->encode($getTicket[$i]->id); ?>"> <i class="fa fa-eye text-navy"></i> </a>
                                                <a title="delete" data-toggle="modal" data-toggle="tooltip" data-placement="top" data-target="#myModal_autocomplete" data-href="<?= client_url().'tickets/deleteTicket'?>" data-id="<?php echo $getTicket[$i]->id; ?>" class="deletebutton"> <i class="fa fa-close text-navy"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal inmodal" id="myModal_autocomplete" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <i class="fa fa-close modal-icon"></i>
                                    <h4 class="modal-title">Delete</h4>
                                    <!--<small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>-->
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
                    <div class="modal inmodal" id="myModal_interested" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <i class="fa fa-user modal-icon"></i>
                                    <h4 class="modal-title">Interested User List</h4>
                                    <!--<small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>-->
                                </div>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <!--<button  id='btndelete' data-url="{{ route('muck-delete')}}" data-id="" type="button" class="btn btn-primary">Delete</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
