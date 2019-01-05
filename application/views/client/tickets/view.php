<style type="text/css">
    .ibox-content {
        clear: both;
        border: none;
    }
</style>
<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">

        <form method="post" class="form-horizontal"  enctype="multipart/form-data"  action="" id=''>

            <div class="form-group headingmain">                        
                <label class="col-sm-2 displaylable">
                    <a href="<?= client_url() . 'tickets/edit/' . $decodeId; ?>" style="margin:10px" class="btn btn-sm btn-primary pull-left m-t-n-xs" ><strong><i class="fa fa-tag"></i> Edit Ticket</strong></a>
                </label>
                <label class="col-sm-8 displaylable" style="margin-top:10px">
                    <div class="input-group-btn">
                        <div class="col-md-4">
                            <?php $priority = json_decode(STATUS); ?>
                            <select class="changeStatus form-control">
                                <option value="">Select Status</option>
                                <?php foreach ($priority as $key => $value) { ?>
                                    <option value="<?= $key ?>" <?php
                                    if ($getTicket[0]->status == $key) {
                                        echo "selected='selected'";
                                    }
                                    ?>><?= $value; ?></option>
<?php }
?>
                            </select>
                        </div>
                    </div>
                </label>
                <label class="col-sm-2 displaylable">
                    <a data-toggle="modal" data-target="#myModal_autocomplete" data-href="<?= client_url() . 'tickets/deleteTicket' ?>" data-id="<?php echo $getTicket[0]->id; ?>" style="margin:10px" data-toggle="tooltip" data-original-title="Delete Ticket" class="btn btn-danger btn-sm pull-right deletebutton"><strong><i class="fa fa-trash-o"></i> Delete Ticket</strong></a>
                </label>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 displaylable">Ticket Code</label>
                        <div class="col-sm-7">
                            <?= $getTicket[0]->ticket_code ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 displaylable">Reporter </label>
                        <div class="col-sm-7">
                            <?= (empty($getTicket[0]->first_name)) ? '' : $getTicket[0]->first_name . ' ' . $getTicket[0]->last_name ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 displaylable">Department</label>
                        <div class="col-sm-7">
                            <?= (empty($getTicket[0]->departmentName)) ? '' : $getTicket[0]->departmentName ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 displaylable">Status</label>
                        <div class="col-sm-7">
                            <?php
                            if (getStatus($getTicket[0]->status) == 'New') {
                                $color = 'background-color:#999999;color:white;';
                            } else if (getStatus($getTicket[0]->status) == 'Answered') {
                                $color = 'background-color:#1a7bb9;color:white;';
                            } else if (getStatus($getTicket[0]->status) == 'Closed') {
                                $color = 'background-color:#999999;color:white;';
                            } else if (getStatus($getTicket[0]->status) == 'Open') {
                                $color = 'background-color:red;color:white;';
                            } else if (getStatus($getTicket[0]->status) == 'In Progress') {
                                $color = 'background-color:green;color:white;';
                            }
                            ?>
                            <span class="btn btn-xs" style="<?php echo $color; ?>">  <?php echo getStatus($getTicket[0]->status); ?> </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 displaylable"> Priority </label>
                        <div class="col-sm-7">
                            <?= $getTicket[0]->priority ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 displaylable"> Created</label>
                        <div class="col-sm-7">
                            <?= date('Y-m-d h:i:s', strtotime($getTicket[0]->dt_created)) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group headingmain">                        
                <h2 class="title" style="margin:10px">Subject: <?php echo $getTicket[0]->subject; ?></h2>
            </div>
            <div class=" headingmain" style="padding: 10px;font-size: 18px;">                     
<?php echo 'Description : ' . $getTicket[0]->ticket_message; ?>
            </div>
        </form>
    </div>
    <div class="row m-t-lg">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <div class="row">

                        <div class="" style="border: 1px solid #e7eaec;padding:10px;">
                            <form method="post" class="form-horizontal" action="<?= client_url(); ?>tickets/preview" id='addCommentForm'>
                                <div class="form-group">
                                    <textarea class="form-control" name="message_reply" placeholder="Ticket #<?= $getTicket[0]->ticket_code ?> Reply"></textarea>
                                </div>
                                <input type="hidden" id="ticket_id" name="ticket_id" value="<?php echo $getTicket[0]->id; ?>">
                                <input type="hidden" name="replay_by" value="C">
                                <input type="hidden" name="replay_id" value="0">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-sm btn-primary m-t-n-xs"><strong>Reply Ticket</strong></button>
                                </div>
                            </form>
                        </div>

                        <?php
                        if (count($comment_replay) == 0) {
                            echo '<h3 style="text-align:center;color:red;"> Sorry, No Comment Found.<h3>';
                        }
                        ?>
<?php foreach ($comment_replay as $key => $value) {
    ?>
                            <div class="col-lg-12" style="border: 1px solid #e7eaec;padding:10px;margin-top:10px; ">
                                <div class="ibox float-e-margins">
                                    <div class="feed-activity-list">
                                        <div class="">
                                            <div class="media-body">
                                                <small class="pull-right"> <i class="fa fa-clock-o"></i> 
                                                    <?= time_ago_new($value->dt_created) ?> ago</small>
                                                <strong><?php echo $value->first_name . ' ' . $value->last_name; ?></strong> <strong class="btn btn-primary btn-xs btn-danger"><?= ($value->replay_by == 'A' ? 'Admin' : 'Client'); ?></strong> 
                                                <div class="" style="border-top: 1px solid #e7eaec;margin: 15px; padding-top: 15px; ">
    <?php echo $value->description; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php } ?>
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
</div>
