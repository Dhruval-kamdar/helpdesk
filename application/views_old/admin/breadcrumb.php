<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= $pagetitle ?></h2>
        <ol class="breadcrumb">
            <?php
            if(!empty($breadcrumb)){
                foreach ($breadcrumb as $key => $value){ ?>
                    <li>
                        <a href="<?= $key; ?>"><?= $value;?></a>
                    </li>
                <?php }
            }
            ?>
            
        </ol>
    </div>
</div>