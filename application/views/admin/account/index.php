
<div class="wrapper wrapper-content  m-t">
    <div class=" animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-5">
                <div class="ibox float-e-margins">
                    <select class="form-control m-b selectYear">
                        <option value="">Select Year</option>
                        <?php
                            for($i=2017; $i<=date('Y'); $i++){ ?>
                                <option value="<?php echo $i;?>"
                                        <?php if($i == $year) {echo 'selected="selected"'; }?>><?php echo $i;?></option>
                           <?php }
                        ?>
                    </select>

                </div>
            </div>
        </div>
        
        <div class="row">
            
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <!--<span class="label label-success pull-right">Monthly</span>-->
                        <h5>Income</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?=  number_format($getAmount, 2, '.', '');  ?></h1>
                        <!--<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>-->
                        <small>Total income</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <!--<span class="label label-info pull-right">Annual</span>-->
                        <h5>Paid</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?=  number_format($getPaidAmount[0]->totalPaidAmount, 2, '.', '');  ?></h1>
                        <!--<div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>-->
                        <small>Total paid</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <!--<span class="label label-info pull-right">Annual</span>-->
                        <h5>Profit</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?=  number_format(($getAmount - $getExpAmount[0]->totalExpense), 2, '.', '');  ?></h1>
                        <!--<div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>-->
                        <small>Total profit</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <!--<span class="label label-primary pull-right">Today</span>-->
                        <h5>Expenses</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?=  number_format($getExpAmount[0]->totalExpense, 2, '.', '');  ?></h1>
                        <!--<div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>-->
                        <small>Total expenses</small>
                    </div>
                </div>
            </div>

        </div>
        <div class="row white-bg">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tickets List</h5>
                        <div class="ibox-tools">
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
                                        <th>Reporter</th>
                                        <th>Department</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($getTicket); $i++) { ?>
                                        <tr>
                                            <td><?= $getTicket[$i]->companyName; ?></td>
                                            <td><?= $getTicket[$i]->ticket_code; ?></td>
                                            <td><?= $getTicket[$i]->subject; ?></td>
                                            <td><?= $getTicket[$i]->first_name .' ' . $getTicket[$i]->last_name; ?> </td>
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
</div>
