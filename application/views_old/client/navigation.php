<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                       <!--<img class="img-rounded"  src="" width='50' height="50">-->
                       
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear" style='width: 50%'>
                            <span class="block m-t-xs">
                                <strong class="font-bold"><?= $this->session->userdata['client_login']['firstname'] ?> </strong>
                            </span> <span class="text-muted text-xs block"><?= $this->session->userdata['client_login']['lastname'] ?> <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?php echo base_url();?>account/logout/C">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="<?= $dashboard; ?>">
                <a href="<?= client_url(); ?>dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="<?= $ticket; ?>">
                <a href="<?= client_url(); ?>tickets"><i class="fa fa-ticket"></i> <span class="nav-label">Tickets</span></a>
            </li>
            <li class="<?= $document; ?>">
                <a href="<?= client_url() . 'document'; ?>"><i class="fa fa-file-code-o"></i> <span class="nav-label">Documents</span></a>
            </li>
              <li class="<?= $sale; ?>"  class="<?= $invoice,$add,$pay; ?>">
                <a href="<?php echo client_url('invoice'); ?>"><i class="fa fa-gear"></i><span class="nav-label">Invoice</span></a>
                <!--<a href=""><i class="fa fa-gear"></i> <span class="nav-label">Sale</span> <span class="fa arrow"></span></a>-->
<!--                <ul class="nav nav-second-level">
                    <li class="<?= $invoice,$add,$pay; ?>"></li>
                </ul>-->
            </li>
            <li class="<?= $resetPassword; ?>">
                <a href="<?= client_url() . 'reset_password'; ?>"><i class="fa fa-ticket"></i> <span class="nav-label">Reset Password</span></a>
            </li>
        </ul>

    </div>
</nav>
