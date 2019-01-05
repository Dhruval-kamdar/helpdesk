<?php

class Archive extends Admin_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('Department_model', 'Department_model');
        $this->load->model('Tickets_model', 'this_model');
        $this->load->model('Client_model', 'Client_model');
    }
    
    function index() {
        $data['page'] = "admin/archive/index";
        $data['archive'] = 'active';
        $data['pagetitle'] = 'Tickets';
        $data['var_meta_title'] = 'Tickets';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Tickets List',
        );
        $data['css'] = array(
            'plugins/dataTables/datatables.min.css'
        );

        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',
            'admin/ticket.js',
        );
        $data['init'] = array(
            'Tickets.clientList()',
        );
        $clientId = '';
        $companyId = '';
        $data['getTicket'] = $this->this_model->getClientTicketList_archive($clientId,$companyId);
        
        $this->load->view(ADMIN_LAYOUT, $data);
    }
    
    function view($id) {
        $ticketId = $this->utility->decode($id);
        if (!ctype_digit($ticketId)) {
            redirect(admin_url() . 'tickets');
        }
        $data['page'] = "admin/tickets/view";
        $data['archive'] = 'active';
        $data['pagetitle'] = 'Tickets';
        $data['var_meta_title'] = 'Tickets';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Tickets Add',
        );
        $data['css'] = array();

        $data['js'] = array(
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'admin/ticket.js',
        );
        $data['init'] = array(
            'Tickets.clientViews()',
        );

        $data['getTicket'] = $this->this_model->getTicketDetail($ticketId);
        // echo '<pre/>'; print_r($data['getTicket'] );exit;
        if (empty($data['getTicket'])) {
            redirect(admin_url() . 'tickets');
        }
        $data['decodeId'] = $id;
        $data['department_detail'] = $this->Department_model->getDepartmentDetail();
        $data['comment_replay'] = $this->this_model->getCommentReplay($ticketId, '');
        // print_r( $data['comment_replay'] );exit;
        if ($this->input->post()) {
            // $res = $this->this_model->updateCoversation($this->input->post(),$ticketId);
            // echo json_encode($res); exit();
        }
        $this->load->view(ADMIN_LAYOUT, $data);
    }
}?>