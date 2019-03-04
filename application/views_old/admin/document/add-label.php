<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">
        <form method="post" class="form-horizontal"  enctype="multipart/form-data"  action="<?= admin_url() .'document/addLabel/'.$docsId; ?>" id='invoiceAdd'>
            <div class="form-group headingmain">						
                <h2 class="title" style="margin:10px"> Add Document Label</h2>								
            </div>
            <div>
                <?php
//            print_r($rowColumnArray['column']);exit;
                for ($j = 1; $j <= $rowColumnArray['rows']; $j++) {
                    ?>
                    <div class="form-group">
                        <label class="col-sm-1 "></label>
                        <?php
                        for ($k = 1; $k <= $rowColumnArray['column']; $k++) {
                            ?>
                            <div class="col-sm-2" style="margin-bottom: 5px">
                                <input type="text" name="item[<?= $j ?>][<?= $k ?>]" placeholder="Enter Value" class="form-control">
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-white" type="button">Cancel</button>
                    <button class="btn btn-primary" type="submit">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
