<!DOCTYPE html>
<html>
<?php $this->load->view('admin/header');?>

<body>

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        
        <?php $this->load->view('admin/navigation');?>
        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            <?php $this->load->view('admin/topnavbar');?>
            <?php $this->load->view('admin/breadcrumb');?>
            
            
            <!-- Main view  -->
            
            <?php $this->load->view($page);?>
            <!-- Footer -->
            
            <?php $this->load->view('admin/bodyfooter');?>
        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->
<?php $this->load->view('admin/footer');?>
</body>
</html>