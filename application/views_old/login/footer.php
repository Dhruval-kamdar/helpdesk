<script src="<?php echo base_url(); ?>public/asset/js/app.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/asset/js/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/asset/js/plugins/toastr/toastr.min.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>public/asset/js/comman_function.js" type="text/javascript"></script>
<?php
if (!empty($js)){ 
foreach ($js as $value){
?>
 
<script src="<?php echo base_url()?>public/asset/js/<?php echo $value; ?>" type="text/javascript"></script>
<?php
}

}
?>
<script>
    jQuery(document).ready(function() {
        <?php
            if(!empty($init)){
            foreach ($init as $value){
                echo $value . ';';
                }
            }
        ?>
    });
</script>