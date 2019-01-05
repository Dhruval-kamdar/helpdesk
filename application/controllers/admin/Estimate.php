<?php

class Estimate extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Estimate_model', 'this_model');
        $this->load->model('Client_model', 'Client_model');
    }

    function index() {
        $data['page'] = "admin/estimate/index";
        $data['sale'] = 'active';
        $data['estimate'] = 'active';
        $data['pagetitle'] = 'Estimate';
        $data['var_meta_title'] = 'Estimate';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'Estimate' => 'Estimate List',
        );
        $data['css'] = array(
            'plugins/dataTables/datatables.min.css'
        );

        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',
            'admin/estimate.js',
        );
        $data['init'] = array(
            'Estimate.estimateList()',
        );
        $data['getEstimate'] = $this->this_model->getEstimateList(null, null);
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function add() {
        $data['page'] = "admin/estimate/add";
        $data['sale'] = 'active';
        $data['estimate'] = 'active';
        $data['pagetitle'] = 'Estimate';
        $data['var_meta_title'] = 'Estimate';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Estimate Add',
        );
        $data['css'] = array(
            'plugins/datapicker/datepicker3.css',
        );

        $data['js'] = array(
            'admin/estimate.js',
            'plugins/datapicker/bootstrap-datepicker.js',
        );
        $data['init'] = array(
            'Estimate.invoiceAdd()',
        );

        if ($this->input->post()) {
            $res = $this->this_model->addEstimate($this->input->post());
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Estimate add successfully.';
                $json_response['redirect'] = admin_url() . 'estimate';
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response);
            exit();
        }
        $data['invoiceNo'] = $this->this_model->generateEstimateNos();
        $clientId = '';
        $data['client_list'] = $this->Client_model->getReporterDetail($clientId);
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function edit($id) {
        $estimateId = $this->utility->decode($id);

        if (!ctype_digit($estimateId)) {
            redirect(admin_url() . 'estimate');
        }

        $data['page'] = "admin/estimate/edit";
        $data['estimate'] = 'active';
        $data['sale'] = 'active';
        $data['pagetitle'] = 'Estimate';
        $data['var_meta_title'] = 'Estimate';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Estimate Edit',
        );
        $data['css'] = array();
        $data['js'] = array(
            'admin/estimate.js',
            'plugins/datapicker/bootstrap-datepicker.js',
        );
        $data['init'] = array(
            'Estimate.initEdit()',
        );
        $clientId = '';
        $data['client_list'] = $this->Client_model->getReporterDetail($clientId);
        $data['estimateData'] = $this->this_model->getEstimateById($estimateId);

        if ($this->input->post()) {
//            print_r($this->input->post());
//            exit;
            $res = $this->this_model->editEstimate($this->input->post(), $estimateId);
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Estimate Updated successfully.';
                $json_response['redirect'] = admin_url() . 'estimate';
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response);
            exit();
        }
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function detail($id) {
        $estimateId = $this->utility->decode($id);
        if (!ctype_digit($estimateId)) {
//            return(admin_url().'client');
        }
        $data['page'] = "admin/estimate/detail";
        $data['client'] = 'active';
        $data['pagetitle'] = 'Estimate Detail';
        $data['var_meta_title'] = 'Estimate Detail';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Estimate Detail',
        );
        $data['css'] = array('plugins/dataTables/datatables.min.css');

        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',
            'admin/client.js',
        );
        $data['init'] = array(
            'Client.clientDetail()',
        );
        $data['companyId'] = $estimateId;
        $data['companyDeatail'] = $this->this_model->companyDetail($estimateId);
        $data['companyUserDetail'] = $this->this_model->companyUserDetail($estimateId);
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function view($id, $shortBy = null) {
        $estimateId = $this->utility->decode($id);
        if (!ctype_digit($estimateId)) {
            return(admin_url() . 'estimate');
        }

        $data['page'] = "admin/estimate/view";
        $data['estimate'] = 'active';
        $data['sale'] = 'active';
        $data['pagetitle'] = 'Estimate Preview';
        $data['var_meta_title'] = 'Estimate Preview';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Estimate Preview',
        );
        $data['js'] = array(
            'admin/estimate.js',
            'plugins/datapicker/bootstrap-datepicker.js',
        );
        $data['init'] = array(
            'Estimate.initEdit()',
        );

        if ($this->input->post()) {
            $res = $this->this_model->addEstimateDetails($this->input->post());
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Estimate Details successfully.';
                $json_response['redirect'] = admin_url() . 'estimate/view/' . $id;
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response);
            exit();
        }
        $data['estimateData'] = $this->this_model->getEstimateById($estimateId);
        $data['estimatepaymentData'] = $this->this_model->getEstimatePaymentDetails($estimateId);
        
        
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function history($id) {
        $estimateId = $this->utility->decode($id);
        if (!ctype_digit($estimateId)) {
            return(admin_url() . 'estimate');
        }
        $data['page'] = "admin/estimate/history";
        $data['estimate'] = 'active';
        $data['sale'] = 'active';
        $data['pagetitle'] = 'Estimate history';
        $data['var_meta_title'] = 'Estimate history';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Estimate history',
        );
        $data['css'] = array('plugins/dataTables/datatables.min.css');

        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',
            'admin/client.js',
        );
        $data['init'] = array(
            'Client.clientDetail()',
        );
        $data['estimateId'] = $id;
        $data['historyArr'] = $this->this_model->getHistoryList($estimateId);
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function deleteEstimate() {
        if ($this->input->post()) {
            $result = $this->this_model->deleteEstimate($this->input->post());
            echo json_encode($result);
            exit();
        }
    }

    function paymentDelete() {
        if ($this->input->post()) {
            $result = $this->this_model->deletePaymentEstimate($this->input->post());
            echo json_encode($result);
            exit();
        }
    }

    function pay($id) {
        $estimateId = $this->utility->decode($id);
        if (!ctype_digit($estimateId)) {
            return(admin_url() . 'estimate');
        }
        $data['page'] = "admin/estimate/pay";
        $data['estimate'] = 'active';
        $data['sale'] = 'active';
        $data['pagetitle'] = 'Estimate Pay';
        $data['var_meta_title'] = 'Estimate Pay';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'Estimate' => 'Estimate Pay',
        );
        $data['js'] = array(
            'admin/estimate.js',
            'plugins/datapicker/bootstrap-datepicker.js',
            'plugins/switchery/switchery.js',
        );
        $data['css'] = array(
            'plugins/dataTables/datatables.min.css',
            'plugins/switchery/switchery.css',
        );

        $data['init'] = array(
            'Estimate.payInit()',
        );
        if ($this->input->post()) {
//            print_r($this->input->post());exit;
            $res = $this->this_model->addPayment($this->input->post());
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Payment Add successfully.';
                $json_response['redirect'] = admin_url() . 'estimate/view/' . $id;
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response);
            exit();
        }

        $data['estimateId'] = $id;
        $data['tranNos'] = $this->this_model->generateTransactionNos();
        $data['estimatepaymentData'] = $this->this_model->getEstimateList($estimateId, null);
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function pdf($id) {
        $estimateId = $this->utility->decode($id);
        if (!ctype_digit($estimateId)) {
            return(admin_url() . 'estimate');
        }
//        $data['page'] = "admin/estimate/pdf";
//        print_r($_SERVER['DOCUMENT_ROOT']);exit;
        $data['estimateData'] = $estimateData = $this->this_model->getEstimateById($estimateId);
        $data['estimatepaymentData'] = $this->this_model->getEstimatePaymentDetails($estimateId);
      
        $estimateNumber = trim($estimateData[0]->ref_no);
        
        //Load the library
        $this->load->library('html2pdf');

        //Set folder to save PDF to
        $this->html2pdf->folder('./public/asset/pdfs/');

        //Set the filename to save/download as
        $this->html2pdf->filename($estimateNumber.'.pdf');

        //Set the paper defaults
        $this->html2pdf->paper('a4', 'portrait');

//        $data = array(
//            'title' => 'PDF Created',
//            'message' => 'Create Expense Pdf!'
//        );

        //Load html view
       
        
        $this->html2pdf->html($this->load->view('admin/estimate/pdf', $data, true));
        unlink('public/asset/pdfs/'.$estimateNumber.'.pdf');
        if ($this->html2pdf->create('save')) {
             
            //$data ['message'] = 'Hello '.$getClientDetail[0]->first_name.' '.$getClientDetail[0]->last_name.' Created Invoice!';
            $data1['clientname'] = $estimateData[0]->companyName;
            $data['message'] = $this->load->view('email_template/Expense_pdf_mail', $data1, true);
            $data ['from_title'] = 'Helpdesk Expense';
            $data ['subject'] = 'Helpdesk Expense '.$estimateNumber;
            $data ['to'] = $estimateData[0]->companyEmail;
            $data ['attech'] = 'public/asset/pdfs/'.$estimateNumber.'.pdf';
            
            $mailSend = $this->utility->sendMailSMTP($data);
           if ($mailSend) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Payment Mail successfully send.';
                $json_response['redirect'] = admin_url() . 'estimate/view/' . $id;
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response);
            exit();
        }
    }
    
    function downloadpdf($id)
    {
       
        $estimateId = $this->utility->decode($id);
        if (!ctype_digit($estimateId)) {
            return(admin_url() . 'invoice');
        }
//        $data['page'] = "admin/estimate/pdf";
//        echo $estimateId;exit;
        $data['invoiceData'] = $invoiceData = $this->this_model->getEstimateById($estimateId);
        $data['invoicepaymentData'] = $this->this_model->getEstimatePaymentDetails($estimateId);
      
        $estimateNumber = trim($invoiceData[0]->ref_no);
        
        //Load the library
        $this->load->library('html2pdf');

        //Set folder to save PDF to
        $this->html2pdf->folder('./public/asset/pdfs/');

        //Set the filename to save/download as
        $this->html2pdf->filename($estimateNumber.'.pdf');

        //Set the paper defaults
        $this->html2pdf->paper('a4', 'portrait');

//        $data = array(
//            'title' => 'PDF Created',
//            'message' => 'Create Invoice Pdf!'
//        );

        //Load html view
      
        $this->html2pdf->html($this->load->view('admin/estimate/pdf', $data, true));
        unlink('public/asset/pdfs/'.$estimateNumber.'.pdf');
        if ($this->html2pdf->create('save')) {
           $this->load->helper('download');
            $pth    =   file_get_contents(base_url()."public/asset/pdfs/$estimateNumber.pdf");
            $nme    =   $estimateNumber.".pdf";
            force_download($nme, $pth);  
           // force_download('http://localhost/ticketsystem/public/asset/pdfs/INV0006.pdf');
            //force_download('public/asset/pdfs/'.$estimateNumber.'.pdf');
            exit;
        }
    }
    
    function expensepdf($id) {
        $estimateId = $this->utility->decode($id);
        if (!ctype_digit($estimateId)) {
            return(admin_url() . 'estimate');
        }

        $data['estimateData'] = $invoiceData = $this->this_model->getEstimateById($estimateId);
        $data['estimatePaymentData'] = $this->this_model->getEstimateExpense($estimateId);
        $estimateNumber = trim($invoiceData[0]->ref_no);
        $this->load->library('html2pdf');
        $this->html2pdf->folder('./public/asset/pdfs/');
        $this->html2pdf->filename($estimateNumber . '-expense.pdf');

        //Set the paper defaults
        $this->html2pdf->paper('a4', 'portrait');

//        $this->load->view('admin/estimate/expensepdf', $data);

        $this->html2pdf->html($this->load->view('admin/estimate/expensepdf', $data, true));
        unlink('public/asset/pdfs/'.$estimateNumber.'.pdf');
        if ($this->html2pdf->create('save')) {
           $this->load->helper('download');
            $pth    =   file_get_contents(base_url()."public/asset/pdfs/".$estimateNumber."-expense.pdf");
            $nme    =   $estimateNumber."-expense.pdf";
            force_download($nme, $pth);  
            exit;
        }
    }
    
    public function sendEstimateMail(){
//        print_r($this->input->post());exit;
            $res = $this->this_model->sendEstimateEmail($this->input->post());
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Mail Send successfully.';
//                $json_response['message'] = $this->input->post('type') .' mail Send successfully.';
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response);
            exit();
    }
    
    public function expense($id, $shortBy = null) {
         
        $estimateId = $this->utility->decode($id);
        
        if (!ctype_digit($estimateId)) {
            return(admin_url() . 'estimate');
        }

        $data['page'] = "admin/estimate/expense";
        $data['estimate'] = 'active';
        $data['sale'] = 'active';
        $data['pagetitle'] = 'estimate Expense';
        $data['var_meta_title'] = 'Estimate Expense';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Estimate Epense',
        );
        $data['js'] = array(
            'admin/estimate.js',
            'plugins/datapicker/bootstrap-datepicker.js',
        );
        $data['init'] = array(
            'Estimate.initExpense()',
        );

        if ($this->input->post()) {
            $res = $this->this_model->addExpenseDetails($this->input->post());
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Estimate Expense Add successfully.';
                $json_response['redirect'] = admin_url() . 'estimate/expense/' . $id;
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response);
            exit();
        }
        $data['expenseData'] = $this->this_model->getEstimateById($estimateId);
        $data['expensepaymentData'] = $this->this_model->getEstimateExpense($estimateId);
        $this->load->view(ADMIN_LAYOUT, $data);
    }
    
    public function expenseDelete(){
        if ($this->input->post()) {
            $result = $this->this_model->expenseDelete($this->input->post());
            echo json_encode($result);
            exit();
        }
    }
    
    public function report($id){
        $estimateId = $this->utility->decode($id);
        
        $data['estimateData'] = $expenseData = $this->this_model->getEstimateById($estimateId);
        $data['estimatepaymentData'] = $this->this_model->getEstimatePaymentDetails($estimateId);
        $data['estimateExpenceData'] = $this->this_model->getEstimateExpense($estimateId);
          
       
        $estimateNumber = trim($expenseData[0]->ref_no);
        
        //Load the library
        $this->load->library('html2pdf');

        //Set folder to save PDF to
        $this->html2pdf->folder('./public/asset/pdfs/');

        //Set the filename to save/download as
        $this->html2pdf->filename('report_'.$estimateNumber.'.pdf');

        //Set the paper defaults
        $this->html2pdf->paper('a4', 'portrait');
//        $this->load->view('admin/estimate/report', $data);
        $this->html2pdf->html($this->load->view('admin/estimate/report', $data, true));
        unlink('public/asset/pdfs/report_'.$estimateNumber.'.pdf');
        if ($this->html2pdf->create('save')) {
           $this->load->helper('download');
            $pth    =   file_get_contents(base_url()."public/asset/pdfs/report_$estimateNumber.pdf");
            $nme    =   'report_'.$estimateNumber.".pdf";
            force_download($nme, $pth);  
           // force_download('http://localhost/ticketsystem/public/asset/pdfs/INV0006.pdf');
            //force_download('public/asset/pdfs/'.$estimateNumber.'.pdf');
            exit;
        }
    }
}

?>