<?php

class Dashboard extends Client_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Department_model', 'Department_model');
        $this->load->model('Tickets_model', 'this_model');
        $this->load->model('Invoice_model', 'Invoice_model');
        $this->load->model('Label_model', 'Label_model');
    }

    function index() {
//        $data['page'] = "client/account/dashboard";
        $data['page'] = "client/account/index";
        $data['dashboard'] = 'active';
        $data['pagetitle'] = 'Dashboard';
        $data['var_meta_title'] = 'Dashboard';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'dashboard1' => 'Dashboard',
        );
        $data['css'] = array(
            'plugins/dataTables/datatables.min.css'
        );

        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',
            'client/ticket.js',
        );
        $data['init'] = array(
            'Tickets.clientList()',
        );

        $client_id = $this->session->userdata['client_login']['id'];
        $companyId = $this->session->userdata['client_login']['companyId'];
        $data['getTicket'] = $this->this_model->getClientTicketList($client_id, $companyId);
        
        $data['getAmount'] = $this->Invoice_model->totalClientAmount($companyId);
        $data['getPaidAmount'] = $this->Invoice_model->totalClientpaidAmount($companyId);
        $data['getExpAmount'] = $this->Invoice_model->totalClientexpAmount($companyId);
        $data['getLastInvoice'] = $this->Invoice_model->getLastInvoice($companyId);
        $data['getLabelinfo'] = $this->Label_model->getLabelinfo($companyId);
        $data['lastInvoiceData'] = $this->Invoice_model->getLastUnpaidInvouce( $this->session->userdata['client_login']['companyId'],$client_id);
        
        $this->load->view(CLIENT_LAYOUT, $data);
    }

}

?>