<?php

class Tickets extends Client_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('Department_model','Department_model');
        $this->load->model('Tickets_model','this_model');
    }

    function index() {
        
        $data['page'] = "client/tickets/index";
        $data['ticket'] = 'active';
        $data['pagetitle'] = 'Tickets';
        $data['var_meta_title'] = 'Tickets';
        $data['breadcrumb'] = array(
            'dashboard'=>'Home',
            'client'=>'Tickets List',
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
        $companyId =  $this->session->userdata['client_login']['companyId'];
        $data['getTicket'] = $this->this_model->getClientTicketList($client_id,$companyId);
        //print_r($data['getTicket']); exit();
        $this->load->view(CLIENT_LAYOUT, $data);
    }
  
    function add() {
        $data['page'] = "client/tickets/add";
        $data['ticket'] = 'active';
        $data['pagetitle'] = 'Tickets';
        $data['var_meta_title'] = 'Tickets';
        $data['breadcrumb'] = array(
            'dashboard'=>'Home',
            'client'=>'Tickets Add',
        );
        $data['css'] = array();
        
        $data['js'] = array(
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'client/ticket.js',
        );
        $data['init'] = array(
            'Tickets.ticketAdd()',
        );
        
       // $data['ticketcode'] = $this->generateRandomString();
        $data['department_detail'] = $this->Department_model->getDepartmentDetail();
//        print_r($this->session->userdata['client_login']['id']);exit;
         $data['reporter'] = $this->session->userdata['client_login']['id'];
         $data['company_details'] = $this->this_model->getCompanyName($data);
        if($this->input->post()){
            $res = $this->this_model->addTicket($this->input->post());
            
            if($res)
            {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Ticket add successfully.';
                $json_response['redirect'] = client_url() . 'tickets';
            }else{
                 $json_response['status'] = 'error';
                 $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response); exit();
        }
        $this->load->view(CLIENT_LAYOUT, $data);
    }

    function view($id) {
        $ticketId = $this->utility->decode($id);
        
         if(!ctype_digit($ticketId)){
             redirect(client_url().'tickets');
         }
         
        $data['page'] = "client/tickets/view";
        $data['ticket'] = 'active';
        $data['pagetitle'] = 'Tickets';
        $data['var_meta_title'] = 'Tickets';
        $data['decodeId'] = $id;
        $data['breadcrumb'] = array(
            'dashboard'=>'Home',
            'client'=>'Tickets Add',
        );
        $data['css'] = array();
        
        $data['js'] = array(
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'client/ticket.js',
        );
        $data['init'] = array(
            'Tickets.clientViews()',
        );
        $data['getTicket'] = $this->this_model->getTicketDetail($ticketId);
        if(empty($data['getTicket'])){
            redirect(client_url().'tickets');
        }
        $data['department_detail'] = $this->Department_model->getDepartmentDetail();
        $data['comment_replay'] = $this->this_model->getCommentReplay($ticketId, 'C');
        if($this->input->post()){
            $res = $this->this_model->updateCoversation($this->input->post(),$ticketId);
            echo json_encode($res); exit();
        }
        $this->load->view(CLIENT_LAYOUT, $data);
    }

    function edit($id) {
        $ticketId = $this->utility->decode($id);
        
         if(!ctype_digit($ticketId)){
             redirect(client_url().'tickets');
         }
        
        $data['page'] = "client/tickets/edit";
        $data['ticket'] = 'active';
        $data['pagetitle'] = 'Tickets';
        $data['var_meta_title'] = 'Tickets';
        $data['breadcrumb'] = array(
            'dashboard'=>'Home',
            'client'=>'Tickets Edit',
        );
        $data['css'] = array();
        
        $data['js'] = array(
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'client/ticket.js',
        );
        $data['init'] = array(
            'Tickets.ticketEdit()',
        );
        $data['decodeId'] = $id;

        $data['department_detail'] = $this->Department_model->getDepartmentDetail();
        $data['getTicket'] = $this->this_model->getTicketDetail($ticketId);
        $data['reporter'] = $this->session->userdata['client_login']['id'];
        $data['company_details'] = $this->this_model->getCompanyName($data);
        if($this->input->post()){
            $res = $this->this_model->editTicket($this->input->post(),$ticketId);
            if($res)
            {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Ticket edit successfully';
                $json_response['redirect'] = client_url() . 'tickets/';
            }else{
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong';
            }
            echo json_encode($json_response); exit();
        }
        $this->load->view(CLIENT_LAYOUT, $data);
    }
    
    function deleteTicket(){
        if($this->input->post()){
            $result = $this->this_model->deleteTicket($this->input->post());
            echo json_encode($result); exit();
        }
    }
    
    function preview() {
          if($this->input->post()){
            $res = $this->this_model->updateCoversation($this->input->post(),'');
            echo json_encode($res); exit();
        }
    }
    function changeStatus() {
          if($this->input->post()){
            $res = $this->this_model->updateStatus($this->input->post());
            echo json_encode($res); exit();
        }
    }

}

?>