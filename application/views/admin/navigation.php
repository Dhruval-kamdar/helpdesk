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
                                <strong class="font-bold"><?= $this->session->userdata['valid_login']['firstname'] ?> </strong>
                            </span> <span class="text-muted text-xs block"><?= $this->session->userdata['valid_login']['lastname'] ?> <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?php echo base_url(); ?>account/logout/A">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="<?= $dashboard; ?>">
                <a href="<?= admin_url(); ?>dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="<?= $client; ?>">
                <a href="<?= admin_url(); ?>client"><i class="fa fa-users"></i> <span class="nav-label">Client</span></a>
            </li>
            <li class="<?= $ticket; ?>">
                <a href="<?= admin_url() . 'tickets'; ?>"><i class="fa fa-ticket"></i> <span class="nav-label">Tickets</span></a>
            </li>
            <li class="<?= $sale; ?>">
                <a href=""><i class="fa fa-gear"></i> <span class="nav-label">Sales</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?= $invoice,$add,$pay; ?>"><a href="<?php echo admin_url('invoice'); ?>">Invoices</a></li>
                </ul>
                <ul class="nav nav-second-level">
                    <li class="<?= $estimate,$pay; ?>"><a href="<?php echo admin_url('estimate'); ?>">Estimates</a></li>
                </ul>
            </li>
            <li class="<?= $label; ?>">
                <a href="<?= admin_url() . 'label'; ?>"><i class="fa fa-ticket"></i> <span class="nav-label">Labels</span></a>
            </li>
            <li class="<?= $document; ?>">
                <a href=""><i class="fa fa-file-code-o"></i> <span class="nav-label">Documents</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?= $addDoc; ?>"><a href="<?php echo admin_url('document'); ?>">Add Document</a></li>
                </ul>
                <ul class="nav nav-second-level">
                    <li class="<?= $downloaddoc; ?>"><a href="<?php echo admin_url('document/documentdownload'); ?>">View & Download</a></li>
                </ul>
            </li>
            
            <li class="<?= $setting; ?>">
                <a href=""><i class="fa fa-gear"></i> <span class="nav-label">Setting</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?= $department; ?>"><a href="<?= admin_url() . "setting"; ?>">Department</a></li>
                </ul>
                <!-- <ul class="nav nav-second-level">
                    <li class="<?= $general; ?>"><a href="<?= admin_url() . "setting/general"; ?>">General Settings</a></li>
                </ul>
                   <ul class="nav nav-second-level">
                    <li class="<?= $email_setting; ?>"><a href="<?= admin_url() . "setting/email_setting"; ?>">Email Settings</a></li>
                </ul> -->
            </li>
            <li class="<?= $resetPassword; ?>">
                <a href="<?= admin_url() . 'reset_password'; ?>"><i class="fa fa-ticket"></i> <span class="nav-label">Reset Password</span></a>
            </li>
        </ul>

    </div>
</nav>
