<?php

class Invoice extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Invoice_model', 'this_model');
        $this->load->model('Client_model', 'Client_model');
    }

    function index($year = NULL) {
        
        $data['page'] = "admin/invoice/index";
        $data['sale'] = 'active';
        $data['invoice'] = 'active';
        $data['pagetitle'] = 'Invoice';
        $data['var_meta_title'] = 'Invoice';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'invoice' => 'Invoice List',
        );
        $data['css'] = array(
            'plugins/dataTables/datatables.min.css'
        );

        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',
            'admin/invoice.js',
        );
        $data['init'] = array(
            'Invoice.invoiceList()',
        );
        $data['year'] = $year;
        $data['getInvoice'] = $this->this_model->getInvoiceList(null, null,$year);
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function addInvoice() {
        $data['page'] = "admin/invoice/add";
        $data['sale'] = 'active';
        $data['invoice'] = 'active';
        $data['pagetitle'] = 'Invoice';
        $data['var_meta_title'] = 'Invoice';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Invoice Add',
        );
        $data['css'] = array(
            'plugins/datapicker/datepicker3.css',
        );

        $data['js'] = array(
            'admin/invoice.js',
            'plugins/datapicker/bootstrap-datepicker.js',
        );
        $data['init'] = array(
            'Invoice.invoiceAdd()',
        );

        if ($this->input->post()) {
            
            $res = $this->this_model->addInvoice($this->input->post());
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Invoice add successfully.';
                $json_response['redirect'] = admin_url() . 'invoice';
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response);
            exit();
        }
        $data['invoiceNo'] = $this->this_model->generateInvoiceNos();
        $clientId = '';
        $data['client_list'] = $this->Client_model->getReporterDetail2($clientId);
        
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function edit($id) {
        $invoiceId = $this->utility->decode($id);

        if (!ctype_digit($invoiceId)) {
            redirect(admin_url() . 'invoice');
        }

        $data['page'] = "admin/invoice/edit";
        $data['invoice'] = 'active';
        $data['sale'] = 'active';
        $data['pagetitle'] = 'Invoice';
        $data['var_meta_title'] = 'Invoice';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Invoice Edit',
        );
        $data['css'] = array();
        $data['js'] = array(
            'admin/invoice.js',
            'plugins/datapicker/bootstrap-datepicker.js',
        );
        $data['init'] = array(
            'Invoice.initEdit()',
        );
        $clientId = '';
        $data['client_list'] = $this->Client_model->getReporterDetail($clientId);
        $data['invoiceData'] = $this->this_model->getInvoiceById($invoiceId);

        if ($this->input->post()) {
//            print_r($this->input->post());
//            exit;
            $res = $this->this_model->editInvoice($this->input->post(), $invoiceId);
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Invoice Updated successfully.';
                $json_response['redirect'] = admin_url() . 'invoice';
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
        $invoiceId = $this->utility->decode($id);
        if (!ctype_digit($invoiceId)) {
            return(admin_url().'client');
        }
        $data['page'] = "admin/invoice/detail";
        $data['client'] = 'active';
        $data['pagetitle'] = 'Invoice Detail';
        $data['var_meta_title'] = 'Invoice Detail';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Invoice Detail',
        );
        $data['css'] = array('plugins/dataTables/datatables.min.css');

        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',
            'admin/client.js',
        );
        $data['init'] = array(
            'Client.clientDetail()',
        );
        $data['companyId'] = $invoiceId;
        $data['companyDeatail'] = $this->this_model->companyDetail($invoiceId);
        $data['companyUserDetail'] = $this->this_model->companyUserDetail($invoiceId);
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function view($id, $shortBy = null) {
        $invoiceId = $this->utility->decode($id);
        if (!ctype_digit($invoiceId)) {
            return(admin_url() . 'invoice');
        }

        $data['page'] = "admin/invoice/view";
        $data['invoice'] = 'active';
        $data['sale'] = 'active';
        $data['pagetitle'] = 'Invoice Preview';
        $data['var_meta_title'] = 'Invoice Preview';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Invoice Preview',
        );
        $data['js'] = array(
            'admin/invoice.js',
            'plugins/datapicker/bootstrap-datepicker.js',
        );
        $data['init'] = array(
            'Invoice.initEdit()',
        );

        if ($this->input->post()) {
            $res = $this->this_model->addInvoiceDetails($this->input->post());
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Invoice Details successfully.';
                $json_response['redirect'] = admin_url() . 'invoice/view/' . $id;
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response);
            exit();
        }
        $data['invoiceData'] = $this->this_model->getInvoiceById($invoiceId);
        $data['invoicepaymentData'] = $this->this_model->getInvoicePaymentDetails($invoiceId);
        
        
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function history($id) {
        $invoiceId = $this->utility->decode($id);
        if (!ctype_digit($invoiceId)) {
            return(admin_url() . 'invoice');
        }
        $data['page'] = "admin/invoice/history";
        $data['invoice'] = 'active';
        $data['sale'] = 'active';
        $data['pagetitle'] = 'Invoice history';
        $data['var_meta_title'] = 'Invoice history';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Invoice history',
        );
        $data['css'] = array('plugins/dataTables/datatables.min.css');

        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',
            'admin/client.js',
        );
        $data['init'] = array(
            'Client.clientDetail()',
        );
        $data['invoiceId'] = $id;
        $data['historyArr'] = $this->this_model->getHistoryList($invoiceId);
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function deleteInvoice() {
        if ($this->input->post()) {
            $result = $this->this_model->deleteInvoice($this->input->post());
            echo json_encode($result);
            exit();
        }
    }

    function paymentDelete() {
        if ($this->input->post()) {
            $result = $this->this_model->deletePaymentInvoice($this->input->post());
            echo json_encode($result);
            exit();
        }
    }

    function pay($id) {
        $invoiceId = $this->utility->decode($id);
        if (!ctype_digit($invoiceId)) {
            return(admin_url() . 'invoice');
        }
        $data['page'] = "admin/invoice/pay";
        $data['invoice'] = 'active';
        $data['sale'] = 'active';
        $data['pagetitle'] = 'Invoice Pay';
        $data['var_meta_title'] = 'Invoice Pay';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'Invoice' => 'Invoice Pay',
        );
        $data['js'] = array(
            'admin/invoice.js',
            'plugins/datapicker/bootstrap-datepicker.js',
            'plugins/switchery/switchery.js',
        );
        $data['css'] = array(
            'plugins/dataTables/datatables.min.css',
            'plugins/switchery/switchery.css',
        );

        $data['init'] = array(
            'Invoice.payInit()',
        );
        if ($this->input->post()) {
//            print_r($this->input->post());exit;
            $res = $this->this_model->addPayment($this->input->post());
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Payment Add successfully.';
                $json_response['redirect'] = admin_url() . 'invoice/view/' . $id;
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response);
            exit();
        }

        $data['invoiceId'] = $id;
        $data['tranNos'] = $this->this_model->generateTransactionNos();
        $data['invoicepaymentData'] = $this->this_model->getInvoiceListV2($invoiceId, null);
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function pdf($id) {
        $invoiceId = $this->utility->decode($id);
        if (!ctype_digit($invoiceId)) {
            return(admin_url() . 'invoice');
        }
//        $data['page'] = "admin/invoice/pdf";
//        print_r($_SERVER['DOCUMENT_ROOT']);exit;
        $data['invoiceData'] = $invoiceData = $this->this_model->getInvoiceById($invoiceId);
        $data['invoicepaymentData'] = $this->this_model->getInvoicePaymentDetails($invoiceId);
      
        $invoiceNumber = trim($invoiceData[0]->ref_no);
        
        //Load the library
        $this->load->library('html2pdf');

        //Set folder to save PDF to
        $this->html2pdf->folder('./public/asset/pdfs/');

        //Set the filename to save/download as
        $this->html2pdf->filename($invoiceNumber.'.pdf');

        //Set the paper defaults
        $this->html2pdf->paper('a4', 'portrait');

//        $data = array(
//            'title' => 'PDF Created',
//            'message' => 'Create Invoice Pdf!'
//        );

        //Load html view
       
        
        $this->html2pdf->html($this->load->view('admin/invoice/pdf', $data, true));
        unlink('public/asset/pdfs/'.$invoiceNumber.'.pdf');
        if ($this->html2pdf->create('save')) {
             
            //$data ['message'] = 'Hello '.$getClientDetail[0]->first_name.' '.$getClientDetail[0]->last_name.' Created Invoice!';
            $data1['clientname'] = $invoiceData[0]->companyName;
            $data['message'] = $this->load->view('email_template/invoice_pdf_mail', $data1, true);
            $data ['from_title'] = 'Helpdesk Invoice';
            $data ['subject'] = 'Helpdesk Invoice '.$invoiceNumber;
            $data ['to'] = $invoiceData[0]->companyEmail;
//            $data ['to'] = 'kartikdesai123@gmail.com';
//            $data ['replyto'] = REPLAY_EMAIL;
//            $data ['attech'] = 'public/asset/pdfs/test_' . $invoiceId . '.pdf';
            $data ['attech'] = 'public/asset/pdfs/'.$invoiceNumber.'.pdf';
            
            $mailSend = $this->utility->sendMailSMTP($data);
           if ($mailSend) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Payment Mail successfully send.';
                $json_response['redirect'] = admin_url() . 'invoice/view/' . $id;
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
       
        $invoiceId = $this->utility->decode($id);
        if (!ctype_digit($invoiceId)) {
            return(admin_url() . 'invoice');
        }
//        $data['page'] = "admin/invoice/pdf";
        
        $data['invoiceData'] = $invoiceData = $this->this_model->getInvoiceById($invoiceId);
        $data['invoicepaymentData'] = $this->this_model->getInvoicePaymentDetails($invoiceId);
     
        $invoiceNumber = trim($invoiceData[0]->ref_no);
         
        //Load the library
        $this->load->library('html2pdf');

        //Set folder to save PDF to
        $this->html2pdf->folder('./public/asset/pdfs/');

        //Set the filename to save/download as
        $this->html2pdf->filename($invoiceNumber.'.pdf');

        //Set the paper defaults
        $this->html2pdf->paper('a4', 'portrait');

//        $data = array(
//            'title' => 'PDF Created',
//            'message' => 'Create Invoice Pdf!'
//        );

        //Load html view
        
        $this->html2pdf->html($this->load->view('admin/invoice/pdf', $data, true));
        unlink('public/asset/pdfs/'.$invoiceNumber.'.pdf');
        if ($this->html2pdf->create('save')) {
           $this->load->helper('download');
            $pth    =   file_get_contents(base_url()."public/asset/pdfs/$invoiceNumber.pdf");
            $nme    =   $invoiceNumber.".pdf";
            force_download($nme, $pth);  
           // force_download('http://localhost/ticketsystem/public/asset/pdfs/INV0006.pdf');
            //force_download('public/asset/pdfs/'.$invoiceNumber.'.pdf');
            exit;
        }
    }
    
    function expensepdf($id) {
        $invoiceId = $this->utility->decode($id);
        if (!ctype_digit($invoiceId)) {
            return(admin_url() . 'invoice');
        }

        $data['invoiceData'] = $invoiceData = $this->this_model->getInvoiceById($invoiceId);
        $data['invoicepaymentData'] = $this->this_model->getInvoiceExpense($invoiceId);

        $invoiceNumber = trim($invoiceData[0]->ref_no);
        $this->load->library('html2pdf');
        $this->html2pdf->folder('./public/asset/pdfs/');
        $this->html2pdf->filename($invoiceNumber . '-expense.pdf');

        //Set the paper defaults
        $this->html2pdf->paper('a4', 'portrait');

//        $this->load->view('admin/invoice/expensepdf', $data);

        $this->html2pdf->html($this->load->view('admin/invoice/expensepdf', $data, true));
        unlink('public/asset/pdfs/'.$invoiceNumber.'.pdf');
        if ($this->html2pdf->create('save')) {
           $this->load->helper('download');
            $pth    =   file_get_contents(base_url()."public/asset/pdfs/".$invoiceNumber."-expense.pdf");
            $nme    =   $invoiceNumber."-expense.pdf";
            force_download($nme, $pth);  
            exit;
        }
    }
    
    public function sendInvoiceMail(){
//        print_r($this->input->post());exit;
            $res = $this->this_model->sendInvoiceEmail($this->input->post());
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = $this->input->post('type') .' mail Send successfully.';
//                $json_response['redirect'] = admin_url() . 'invoice/view/' . $id;
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response);
            exit();
    }
    
     function expense($id, $shortBy = null) {
         
        $invoiceId = $this->utility->decode($id);
        
        if (!ctype_digit($invoiceId)) {
            return(admin_url() . 'invoice');
        }

        $data['page'] = "admin/invoice/expense";
        $data['invoice'] = 'active';
        $data['sale'] = 'active';
        $data['pagetitle'] = 'Invoice Epense';
        $data['var_meta_title'] = 'Invoice Epense';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Invoice Epense',
        );
        $data['js'] = array(
            'admin/invoice.js',
            'plugins/datapicker/bootstrap-datepicker.js',
        );
        $data['init'] = array(
            'Invoice.initExpense()',
        );

        if ($this->input->post()) {
            $res = $this->this_model->addExpenseDetails($this->input->post());
            if ($res) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Invoice Expense Add successfully.';
                $json_response['redirect'] = admin_url() . 'invoice/expense/' . $id;
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong.';
            }
            echo json_encode($json_response);
            exit();
        }
        $data['invoiceData'] = $this->this_model->getInvoiceById($invoiceId);
        $data['invoicepaymentData'] = $this->this_model->getInvoiceExpense($invoiceId);
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
        $invoiceId = $this->utility->decode($id);
        
        $data['invoiceData'] = $invoiceData = $this->this_model->getInvoiceById($invoiceId);
        $data['invoicepaymentData'] = $this->this_model->getInvoicePaymentDetails($invoiceId);
        $data['invoiceExpenceData'] = $this->this_model->getInvoiceExpense($invoiceId);
        
        
       
        $invoiceNumber = trim($invoiceData[0]->ref_no);
        
        //Load the library
        $this->load->library('html2pdf');

        //Set folder to save PDF to
        $this->html2pdf->folder('./public/asset/pdfs/');

        //Set the filename to save/download as
        $this->html2pdf->filename('report_'.$invoiceNumber.'.pdf');

        //Set the paper defaults
        $this->html2pdf->paper('a4', 'portrait');
        
        $this->html2pdf->html($this->load->view('admin/invoice/report', $data, true));
        unlink('public/asset/pdfs/report_'.$invoiceNumber.'.pdf');
        if ($this->html2pdf->create('save')) {
           $this->load->helper('download');
            $pth    =   file_get_contents(base_url()."public/asset/pdfs/report_$invoiceNumber.pdf");
            $nme    =   'report_'.$invoiceNumber.".pdf";
            force_download($nme, $pth);  
           // force_download('http://localhost/ticketsystem/public/asset/pdfs/INV0006.pdf');
            //force_download('public/asset/pdfs/'.$invoiceNumber.'.pdf');
            exit;
        }
    }
}

?>