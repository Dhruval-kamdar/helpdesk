<?php

class Tickets extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Department_model', 'Department_model');
        $this->load->model('Tickets_model', 'this_model');
        $this->load->model('Client_model', 'Client_model');
    }

    function index() {
        $data['page'] = "admin/tickets/index";
        $data['ticket'] = 'active';
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
        $data['getTicket'] = $this->this_model->getClientTicketList($clientId,$companyId);
        
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function add() {
        $data['page'] = "admin/tickets/add";
        $data['ticket'] = 'active';
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
            'admin/ticket.js'
        );
        $data['init'] = array(
            'Tickets.ticketAdd()',
        );
        $clientId = '';
        $data['department_detail'] = $this->Department_model->getDepartmentDetail($clientId);
        $data['reporter_detail'] = $this->Client_model->getReporterDetail($clientId);
        // print_r($data['reporter_detail'] );exit;
        if ($this->input->post()) {
            $res = $this->this_model->addTicket($this->input->post());
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Ticket add successfully.';
                $json_response['redirect'] = admin_url() . 'tickets';
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response);
            exit();
        }
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function view($id) {
        $ticketId = $this->utility->decode($id);
        if (!ctype_digit($ticketId)) {
            redirect(admin_url() . 'tickets');
        }
        $data['page'] = "admin/tickets/view";
        $data['ticket'] = 'active';
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

    function edit($id) {
        $ticketId = $this->utility->decode($id);

        if (!ctype_digit($ticketId)) {
            redirect(client_url() . 'tickets');
        }


        $data['page'] = "admin/tickets/edit";
        $data['ticket'] = 'active';
        $data['pagetitle'] = 'Tickets';
        $data['var_meta_title'] = 'Tickets';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Tickets Edit',
        );
        $data['css'] = array();

        $data['js'] = array(
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'admin/ticket.js',
        );
        $data['init'] = array(
            'Tickets.ticketEdit()',
        );
        $clientId = '';
        $data['decodeId'] = $id;
        $data['department_detail'] = $this->Department_model->getDepartmentDetail();
        $data['getTicket'] = $this->this_model->getTicketDetail($ticketId);
        $data['reporter_detail'] = $this->Client_model->getReporterDetail($clientId);
        // print_r( $data['reporter_detail'] );exit;
        if ($this->input->post()) {
            // print_r($this->input->post());exit;
            $res = $this->this_model->editTicket($this->input->post(), $ticketId);
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Ticket edit successfully';
                $json_response['redirect'] = admin_url() . 'tickets/';
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong';
            }
            echo json_encode($json_response);
            exit();
        }
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function detail($id) {
        $companyId = $this->utility->decode($id);
        if (!ctype_digit($companyId)) {
            return(admin_url() . 'client');
        }
        $data['page'] = "admin/client/detail";
        $data['ticket'] = 'active';
        $data['pagetitle'] = 'Tickets Detail';
        $data['var_meta_title'] = 'Tickets Detail';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Tickets Detail',
        );
        $data['css'] = array('plugins/dataTables/datatables.min.css');

        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',
            'admin/ticket.js',
        );
        $data['init'] = array(
            'Tickets.clientDetail()',
        );
        $data['companyId'] = $companyId;
        $data['companyDeatail'] = $this->this_model->companyDetail($companyId);
        $data['companyUserDetail'] = $this->this_model->companyUserDetail($companyId);
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function deleteTicket() {
        if ($this->input->post()) {
            $result = $this->this_model->deleteTicket($this->input->post());
            echo json_encode($result);
            exit();
        }
    }

    function preview() {
        if ($this->input->post()) {
            $res = $this->this_model->updateCoversation($this->input->post(), '');
            echo json_encode($res);
            exit();
        }
    }

    function changeStatus() {
        if ($this->input->post()) {
            $res = $this->this_model->updateStatus($this->input->post());
            echo json_encode($res);
            exit();
        }
    }

    function getCompanyName() {
        if ($this->input->post()) {
            $res = $this->this_model->getCompanyName($this->input->post());
            echo json_encode($res);
            exit();
        }
    }

}

?>