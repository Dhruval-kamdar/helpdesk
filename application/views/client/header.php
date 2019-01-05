<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk - <?php echo $var_meta_title; ?> </title>


    <link rel="stylesheet" href="<?= base_url() ?>public/asset/css/vendor.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/asset/css/app.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/asset/css/plugins/toastr/toastr.min.css" />
    <?php
     if (!empty($css)){  
        foreach ($css as $value){ ?>  
        <link rel="stylesheet" href="<?= base_url() ?>public/asset/css/<?php echo $value ?>">
      <?php  }
       }
    ?>
    <script>
        var baseurl = "<?= base_url()?>index.php/";
    </script>
</head>