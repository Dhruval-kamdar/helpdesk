<!DOCTYPE html>
<html>
<?php $this->load->view('client/header');?>

<body>

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        
        <?php $this->load->view('client/navigation');?>
        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            <?php $this->load->view('client/topnavbar');?>
            <?php $this->load->view('client/breadcrumb');?>
            
            
            <!-- Main view  -->
            
            <?php $this->load->view($page);?>
            <!-- Footer -->
            
            <?php $this->load->view('client/bodyfooter');?>
        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->
<?php $this->load->view('client/footer');?>
</body>
</html>
