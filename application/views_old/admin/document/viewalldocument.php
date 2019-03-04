<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig form-horizontal">
        <div class="form-group headingmain">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="title" style="margin:10px;"> Document List</h2>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="ibox-content">
                    <ul class="nav nav-tabs">
                         <?php for ($i = 0; $i < count($companyDocName); $i++) { ?>
                                    <li class="<?php echo ($i == 0)?'active':'';?>"><a data-id="<?php echo $companyDocName[$i]->id; ?>" data-docname="<?php echo $companyDocName[$i]->document_name; ?>" class="documentName" data-toggle="tab" href="#doc_<?php echo $companyDocName[$i]->id; ?>"><?php echo $companyDocName[$i]->document_name; ?></a></li>
                        <?php } ?>
                    </ul>
                  <div class="tab-content">
                       <?php for ($i = 0; $i < count($companyDocName); $i++) { ?>
                        <div id="doc_<?php echo $companyDocName[$i]->id; ?>" class="tab-pane fade <?php echo ($i == 0)?'in active':'';?>">
                            <h3><?php echo $companyDocName[$i]->document_name; ?></h3>
                            <p>Loading...</p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
