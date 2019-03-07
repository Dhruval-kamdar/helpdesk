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
                    <?php if(!empty($docsArray)) { ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <?php
                            $j=0;
                            for ($i = 0; $i < count($docsArray); $i++) {
                                $j++;
                                    if($i == 0){
                                        $class = 'active';
                                    }else{
                                        $class = '';
                                    }
                                ?>
                                <li class="<?= $class; ?>"><a href="#<?= $j; ?>" class="rowListModel" data-id="<?php echo $docsArray[$i]->id; ?>" data-toggle="tab"><?php echo $docsArray[$i]->document_name?></a></li>
                            <?php } ?>
                        </ul>
                        <div class="tab-content">
                            <?php
                            $j=0;
                            for ($i = 0; $i < count($docsArray); $i++) {
                                $j++;
                                    if($i == 0){
                                        $class = 'active';
                                    }else{
                                        $class = '';
                                    }
                                ?>
                                <div class="<?= $class; ?> tab-pane" id="<?= $j; ?>">
                                    
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } else{ ?>
                        <h2 style='text-align: center;'>No record found</h2>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


