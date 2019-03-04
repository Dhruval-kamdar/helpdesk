<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><a title="Invoice Details" href="<?= admin_url().'invoice/view/'.$invoiceId; ?>" class="btn btn-info btn-block m-t"><i class="fa fa-info-circle"> </i> Invoice Details</a></h5>
                        <div class="ibox-tools">
                            <a href="javascript:;" title="PDF" class="btn btn-outline btn-info pull-right"><i class="fa fa-file-pdf-o"> Pdf</i> </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div>
                            <div class="feed-activity-list">
                                <?php for($i=0 ;$i < count($historyArr);$i++) { ?>
                                <div class="feed-element">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="<?= IMAGES . 'logo.png'; ?>">
                                    </a>
                                    <div class="media-body ">
                                        <big class="pull-right"><?= date('M d, Y h:i:s', strtotime($historyArr[$i]->dt_created)); ?></big>
                                        <strong><?= $historyArr[$i]->first_name .' ' .$historyArr[$i]->last_name; ?></strong><br>
                                        <big class="text-muted"><?= $historyArr[$i]->history_desc; ?></big>
                                    </div>
                                </div>
                                <?php } 
                                if(count($historyArr) == 0){
                                    echo '<h3 style="text-align: center;color: red;"> No invoice History Found</h3>';
                                }
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
