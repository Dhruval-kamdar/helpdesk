<?php

class Invoice_model extends My_model {

    public function __construct() {
        parent::__construct();
        $this->load->model('Client_model', 'Client_model');
    }

    public function addInvoice($postData) {
        $data['insert']['client_id'] = $postData['client_id'];
        $data['insert']['ref_no'] = $postData['ref_no'];
        $data['insert']['due_date'] = date('Y-m-d', strtotime($postData['due_date']));
        $data['insert']['default_tax'] = $postData['default_tax'];
        $data['insert']['discount'] = $postData['discount'];
        $data['insert']['currency'] = $postData['currency'];
        $data['insert']['company_id'] = $postData['companyId'];
        $data['insert']['note'] = $postData['notes'];
        $data['insert']['dt_created'] = DATE_TIME;
        $data['insert']['dt_updated'] = DATE_TIME;
        $data['table'] = TABLE_INVOICE;
        $result = $this->insertRecord($data);
        $objHistory = array(
            'description' => "created INVOICE #" . $postData['ref_no'],
            'invoiceId' => $result,
            'userId' => $this->session->userdata['valid_login']['id'],
        );
        unset($data);
        if ($result) {
            $this->addHistory($objHistory);
            return true;
        } else {
            return false;
        }
    }

    public function getInvoiceList($invoiceId = null, $clientId , $year) {
       $data['table'] = TABLE_INVOICE . ' as inv';
        $data['select'] = ['inv.*', 'SUM(invDetail.total) as totalPrice',
//            'SUM(invPayment.amount) as totalPaidAmount',
            'GROUP_CONCAT(invDetail.id) as totalPaidAmount',
//            'GROUP_CONCAT(DISTINCT invDetail.id) as totalPaidAmount',
            'usr.first_name', 'usr.last_name', 'usr.email',
            'invDetail.item_name',
            'invDetail.item_desc',
            'comp.name as companyName',
//            'invPayment.payment_date',
//            'invPayment.notes as paymentNote',
//            'invPayment.amount as paidAmount',
        ];
        $data['join'] = [
            TABLE_USER . ' as usr' => [
                'usr.id = inv.client_id',
                'LEFT',
            ],
            TABLE_INVOICE_DETAILS . ' as invDetail' => [
                'invDetail.invoice_id = inv.id',
                'LEFT',
            ],
            TABLE_COMPANY . ' as comp' => [
                'comp.id = usr.company_id',
                'LEFT',
            ],
            TABLE_INVOICE_PAYMENT . ' as invPayment' => [
                'invPayment.invoice_id = inv.id',
                'LEFT',
            ],
        ];
        if($year){
            
            $data['join'] = [
                TABLE_USER . ' as usr' => [
                    'usr.id = inv.client_id',
                    'LEFT',
                ],
                TABLE_INVOICE_DETAILS . ' as invDetail' => [
                    'invDetail.invoice_id = inv.id',
                    'LEFT',
                ],
                TABLE_COMPANY . ' as comp' => [
                    'comp.id = usr.company_id',
                    'LEFT',
                ],
                TABLE_INVOICE_PAYMENT . ' as invPayment' => [
                    'invPayment.invoice_id = inv.id',
                    'LEFT',
                ],
            ];
        }
        
        
        if ($invoiceId) {
            $data['where'] = ['inv.id' => $invoiceId];
        }
        if (!empty($clientId)) {
            $data['where'] = ['inv.client_id' => $clientId];
        }
        if($year){
            $data['where'] = ['YEAR(inv.dt_created)' => $year];
        }else{
          
           $year1 = date('Y');
            $data['where'] = ['YEAR(inv.dt_created)' => $year1];
        }
        
        $data['groupBy'] = ['inv.id'];
        
//        print_r($data); exit();
        $result = $this->selectFromJoin($data);
//       echo $this->db->last_query(); exit();
   //    print_r($result);exit;
        return $result;
    }

    public function getCompanyInvoiceList($invoiceId = null, $companyId) {
        $data['select'] = ['inv.*', 'SUM(invDetail.total) as totalPrice',
//            'SUM(invPayment.amount) as totalPaidAmount',
            'GROUP_CONCAT(invDetail.id) as totalPaidAmount',
//            'GROUP_CONCAT(DISTINCT invDetail.id) as totalPaidAmount',
            'usr.first_name', 'usr.last_name', 'usr.email',
            'invDetail.item_name',
            'invDetail.item_desc',
            'comp.name as companyName',
//            'invPayment.payment_date',
//            'invPayment.notes as paymentNote',
//            'invPayment.amount as paidAmount',
        ];
        $data['join'] = [
            TABLE_USER . ' as usr' => [
                'usr.id = inv.client_id',
                'LEFT',
            ],
            TABLE_INVOICE_DETAILS . ' as invDetail' => [
                'invDetail.invoice_id = inv.id',
                'LEFT',
            ],
            TABLE_COMPANY . ' as comp' => [
                'comp.id = usr.company_id',
                'LEFT',
            ],
//            TABLE_INVOICE_PAYMENT . ' as invPayment' => [
//                'invPayment.invoice_id = inv.id',
//                'LEFT',
//            ],
        ];
        if ($invoiceId) {
            $data['where'] = ['inv.id' => $invoiceId];
        }
        if (!empty($companyId)) {
            $data['where'] = ['inv.company_id' => $companyId];
        }
        $data['groupBy'] = ['inv.id'];
        $data['table'] = TABLE_INVOICE . ' as inv';
        $result = $this->selectFromJoin($data);
//        print_r($result);exit;
        return $result;
    }

    public function editInvoice($postData) {

        $data['update']['client_id'] = $postData['client_id'];
        $data['update']['ref_no'] = $postData['ref_no'];
        $data['update']['recur_every'] = $postData['recure_every'];
        $data['update']['company_id'] = $postData['companyId'];
        $data['update']['due_date'] = date('Y-m-d', strtotime($postData['due_date']));
        $data['update']['start_date'] = ($postData['start_date'] == '01-19-1970') ? '' : date('Y-m-d', strtotime($postData['start_date']));
        $data['update']['end_date'] = ($postData['end_date'] == '01-19-1970') ? '' : date('Y-m-d', strtotime($postData['end_date']));
        $data['update']['default_tax'] = $postData['default_tax'];
        $data['update']['discount'] = $postData['discount'];
        $data['update']['currency'] = $postData['currency'];
        $data['update']['note'] = $postData['notes'];
        $data['where'] = ['id' => $postData['id']];
        $data['table'] = TABLE_INVOICE;
        $result = $this->updateRecords($data);
        unset($data);
        if ($result) {
            $objHistory = array(
                'description' => $this->session->userdata['valid_login']['firstname'] . " edited INVOICE #" . $postData['ref_no'],
                'invoiceId' => $postData['id'],
                'userId' => $this->session->userdata['valid_login']['id'],
            );
            $this->addHistory($objHistory);
            return true;
        } else {
            return false;
        }
    }

    public function generateInvoiceNos() {
        $invoiceFix = 'INV';
        $query = $this->db->from(TABLE_INVOICE)->order_by("id", "desc")->get()->row();
        $id = $query->id + 201;
        $length = strlen($id + 201);
        $code = ($length == 1) ? '000' . $id : (($length == 2) ? '00' . $id : (($length == 3) ? '0' . $id : $id));
        return $invoiceFix . $code;

//        $newInvoice = '';
//        $query = $this->db->from(TABLE_INVOICE)->order_by("id", "desc")->get()->row();
//        $totalLength = (7 - strlen($query->id));
//
//        $newInvoiceNo = str_pad($invoiceFix, $totalLength, "0");
//        $newInvoice = $newInvoiceNo . ($query->id + 1);
//        return $newInvoice;
    }

    public function getInvoiceById($id) {
        $data['select'] = ['inv.*',
            'usr.first_name',
            'usr.last_name',
            'c.name as companyName',
            'c.email as companyEmail',
            'c.phone as companyPhone',
            'c.address as companyAddress',
            'c.city as companyCity',
            'con.name as countryName',
            'inv.*',
        ];

        if ($id) {
            $data['where'] = ['inv.id' => $id];
        }
        $data['join'] = [
            TABLE_USER . ' as usr' => [
                'usr.id = inv.client_id',
                'LEFT',
            ],
            TABLE_COMPANY . ' as c' => [
                'c.id = usr.company_id',
                'LEFT',
            ],
            TABLE_COUNTRIES . ' as con' => [
                'con.id = c.country_id',
                'LEFT',
            ],
        ];
        $data['table'] = TABLE_INVOICE . ' as inv';
        $result = $this->selectFromJoin($data);

        return $result;
    }

    public function addInvoiceDetails($postData) {
        $data['insert']['invoice_id'] = $postData['id'];
        $data['insert']['item_name'] = $postData['item_name'];
        $data['insert']['item_desc'] = $postData['item_desc'];
        $data['insert']['quentity'] = $postData['quentity'];
        $data['insert']['price'] = $postData['price'];
        $data['insert']['total'] = $postData['price'] * $postData['quentity'];
        $data['insert']['dt_created'] = DATE_TIME;
        $data['insert']['dt_updated'] = DATE_TIME;
        $data['table'] = TABLE_INVOICE_DETAILS;
        $result = $this->insertRecord($data);
        unset($data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getInvoicePaymentDetails($invoiceId) {

        $data['select'] = ['inv.*', 'invDetail.price', 'invDetail.dt_created as createddate', 'invDetail.item_name',
            'invDetail.item_desc', 'invDetail.quentity', 'invDetail.id as paymentId',
            'SUM(invPayment.amount) as totalPaidAmount',
            'SUM(invDetail.total) as total',
        ];
        $data['where'] = ['inv.id' => $invoiceId];
        $data['join'] = [
            TABLE_INVOICE_DETAILS . ' as invDetail' => [
                'invDetail.invoice_id = inv.id',
                'LEFT',
            ],
            TABLE_INVOICE_PAYMENT . ' as invPayment' => [
                'invPayment.invoice_id = invDetail.id',
                'LEFT',
            ],
        ];
        $data['groupBy'] = ['invDetail.id'];
        $data['table'] = TABLE_INVOICE . ' as inv';
        $result = $this->selectFromJoin($data);
//        echo '<pre/>';
//        print_r($result);exit;
        return $result;
    }

    public function getClientDetail($companyId, $clientId) {
        $data['select'] = ['first_name', 'last_name', 'email'];
        $data['where'] = ['id' => $clientId, 'company_id' => $companyId];
        $data['table'] = TABLE_USER;
        $result = $this->selectRecords($data);
        return $result;
    }

    public function deletePaymentInvoice($data) {
        $this->db->where('id', $data['id']);
        $result = $this->db->delete(TABLE_INVOICE_DETAILS);

        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Invoice delete successfully';
            $json_response['jscode'] = 'setTimeout(function(){location.reload();},1000)';
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

    public function expenseDelete($data) {
        $this->db->where('id', $data['id']);
        $result = $this->db->delete(TABLE_INVOICE_EXPENSE);

        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Invoice delete successfully';
            $json_response['jscode'] = 'setTimeout(function(){location.reload();},1000)';
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

    public function addHistory($postData) {
        $data['insert']['invoice_id'] = $postData['invoiceId'];
        $data['insert']['history_desc'] = $postData['description'];
        $data['insert']['user_id'] = $postData['userId'];
        $data['insert']['dt_created'] = DATE_TIME;
        $data['insert']['dt_updated'] = DATE_TIME;
        $data['table'] = TABLE_INVOICE_HISTORY;
        $result = $this->insertRecord($data);
        unset($data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getHistoryList($invoiceId) {

        $data['select'] = ['invHis.*', 'usr.first_name', 'usr.last_name',];
        $data['join'] = [
            TABLE_INVOICE . ' as inv' => [
                'inv.id = invHis.invoice_id',
                'LEFT',
            ],
            TABLE_USER . ' as usr' => [
                'usr.id = invHis.user_id',
                'LEFT',
            ],
        ];
        $data['where'] = ['invoice_id' => $invoiceId];
        $data['table'] = TABLE_INVOICE_HISTORY . ' as invHis';
        $result = $this->selectFromJoin($data);
        return $result;
    }

    public function generateTransactionNos() {
        $newInvoice = '';
        $query = $this->db->from(TABLE_INVOICE_PAYMENT)->order_by("id", "desc")->get()->row();
        $totalLength = (6 - strlen($query->id));
        $invoiceFix = 'TNP';
        $newInvoiceNo = str_pad($invoiceFix, $totalLength, "0");
        $newInvoice = $newInvoiceNo . ($query->id + 1);
        return $newInvoice;
    }

    public function addPayment($postData) {
        $data['insert']['invoice_id'] = $postData['invoiceId'];
        $data['insert']['amount'] = $postData['amount'];
        $data['insert']['trans_id'] = $postData['trans_id'];
        $data['insert']['payment_date'] = date('Y-m-d', strtotime($postData['payment_date']));
        $data['insert']['payment_method'] = $postData['payment_method'];
        $data['insert']['notes'] = $postData['notes'];
        $data['insert']['send_mail'] = (!empty($postData['send_mail'])) ? '1' : '0';
        $data['insert']['dt_created'] = DATE_TIME;
        $data['insert']['dt_updated'] = DATE_TIME;
        $data['table'] = TABLE_INVOICE_PAYMENT;
        $result = $this->insertRecord($data);
        unset($data);
        if ($result) {
            $objHistory = array(
                'description' => "Payment of " . $postData['currency'] . $postData['amount'] . " received and applied to INVOICE #" . $postData['ref_no'],
                'invoiceId' => $postData['invoiceId'],
                'userId' => $this->session->userdata['valid_login']['id'],
            );
            $this->addHistory($objHistory);
            return true;
        } else {
            return false;
        }
    }

    public function deleteInvoice($data) {
        $this->db->where('id', $data['id']);
        $this->db->delete(TABLE_INVOICE);

        $this->db->where('invoice_id', $data['id']);
        $this->db->delete(TABLE_INVOICE_DETAILS);


        $this->db->where('invoice_id', $data['id']);
        $this->db->delete(TABLE_INVOICE_PAYMENT);

        $this->db->where('invoice_id', $data['id']);
        $result = $this->db->delete(TABLE_INVOICE_HISTORY);

        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Invoice delete successfully';
            $json_response['redirect'] = admin_url('invoice');
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

    public function sendInvoiceEmail($postData) {
        $invoiceArray = $this->getInvoiceList($postData['invoiceId'], '');
//        print_r($invoiceArray);exit;
//        $data['link'] = base_url_index() . 'admin/invoice/view/';
        $data['link'] = base_url_index() . 'admin/invoice/view/' . $this->utility->encode($postData['invoiceId']);
        $data['ref_no'] = $invoiceArray[0]->ref_no;
        $data['totalPrice'] = $invoiceArray[0]->currency . ' ' . $invoiceArray[0]->totalPrice;
        $data['client_email'] = $invoiceArray[0]->email;
        $data['client_name'] = $invoiceArray[0]->first_name . ' ' . $invoiceArray[0]->last_name;
        if ($postData['type'] == 'invoice') {
            $data['message'] = $this->load->view('email_template/invoice_mail', $data, true);
            $data['from_title'] = 'Email Invoice';
            $data['subject'] = 'Invoice ' . $invoiceArray[0]->ref_no;
        } else {
            $data['message'] = $this->load->view('email_template/reminder_mail', $data, true);
            $data['from_title'] = 'Email Reminder';
            $data['subject'] = 'Invoice ' . $invoiceArray[0]->ref_no . ' Reminder';
        }

//      $data['to'] = 'shaileshvanaliya91@gmail.com';
        $data["to"] = $invoiceArray[0]->email;
        $data["replyto"] = REPLAY_EMAIL;
        $data["bcc"] = REPLAY_EMAIL;
        $mailSend = $this->utility->sendMailSMTP($data);
        return true;
//        return $mailSend;
    }

    public function addExpenseDetails($postData) {
        $data['insert']['invoice_id'] = $postData['invoiceId'];
        $data['insert']['expense_name'] = $postData['item_name'];
        $data['insert']['expense_desc'] = $postData['item_desc'];
        $data['insert']['quentity'] = $postData['quentity'];
        $data['insert']['price'] = $postData['price'];
        $data['insert']['total'] = $postData['price'] * $postData['quentity'];
        $data['insert']['dt_created'] = DATE_TIME;
        $data['insert']['dt_updated'] = DATE_TIME;
        $data['table'] = TABLE_INVOICE_EXPENSE;
        $result = $this->insertRecord($data);
        unset($data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getInvoiceExpense($invoiceId) {

        $data['select'] = ['inv.*', 'invExpense.price', 'invExpense.expense_name',
            'invExpense.expense_desc', 'invExpense.quentity', 'invExpense.id as paymentId',
            'SUM(invExpense.total) as total',
        ];
        $data['where'] = ['inv.id' => $invoiceId];
        $data['join'] = [
            TABLE_INVOICE_EXPENSE . ' as invExpense' => [
                'invExpense.invoice_id = inv.id',
                'LEFT',
            ],
        ];
        $data['groupBy'] = ['invExpense.id'];
        $data['table'] = TABLE_INVOICE . ' as inv';
        $result = $this->selectFromJoin($data);

        return $result;
    }

    public function totalAmount($year = NULL) {
        $invoiceId = [];
        if($year){
            $data['select'] = ['invPayment.invoice_id'];
            $data['table'] = TABLE_INVOICE_PAYMENT . ' as invPayment';
            $data['where'] = ['YEAR(payment_date)' => $year];
            $invoice_id = $this->selectRecords($data);
            if(!empty($invoice_id)){
                for($i=0; $i<count($invoice_id); $i++){
                    $invoiceId[] =   $invoice_id[$i]->invoice_id;
                }
            }
       
        
        unset($data);
        if(!empty($invoiceId)){
            $data['select'] = ['SUM(invDetail.total) as total'];
            $data['table'] = TABLE_INVOICE_DETAILS . ' as invDetail';
            if($year){
               $data['where_in'] = ['invDetail.invoice_id' => $invoiceId];
            }
            $result = $this->selectRecords($data);
            $result = $result[0]->total;
         }else{
             $result = 0.00;
         }
       }else{
            $data['select'] = ['SUM(invDetail.total) as total'];
            $data['table'] = TABLE_INVOICE_DETAILS . ' as invDetail';
            $result = $this->selectRecords($data);
            $result = $result[0]->total;
        }
        
        return $result;
    }

    public function totalpaidAmount($year = NULL) {
        
        $data['select'] = ['SUM(invPayment.amount) as totalPaidAmount'];
        $data['table'] = TABLE_INVOICE_PAYMENT . ' as invPayment';
        if($year){
           $data['where'] = ['YEAR(payment_date)' => $year];
        }
        $result = $this->selectRecords($data);
        return $result;
    }

    public function totalexpAmount($year = NULL) {
        $data['select'] = ['SUM(invExpense.total) as totalExpense'];
        $data['table'] = TABLE_INVOICE_EXPENSE . ' as invExpense';
        if($year){
           $data['where'] = ['YEAR(dt_created)' => $year];
        }
        $result = $this->selectRecords($data);
        return $result;
    }

    public function totalClientAmount($companyId) {
        $data['select'] = ['GROUP_CONCAT(inv.id,"") as invId'];
        $data['where'] = ['inv.company_id' => $companyId];
        $data['table'] = TABLE_INVOICE . ' as inv';
        $InvArr = $this->selectRecords($data);
        $invoiceArr = explode(',', $InvArr[0]->invId);
        $data = '';
        $data['select'] = ['SUM(invDetail.total) as total'];
        $data['where_in'] = array('invDetail.invoice_id' => $invoiceArr);
        $data['table'] = TABLE_INVOICE_DETAILS . ' as invDetail';
        $result = $this->selectRecords($data);
        return $result;
    }

    public function totalClientpaidAmount($companyId) {
        $data['select'] = ['GROUP_CONCAT(inv.id,"") as invId'];
        $data['where'] = ['inv.company_id' => $companyId];
        $data['table'] = TABLE_INVOICE . ' as inv';
        $InvArr = $this->selectRecords($data);
        $data = '';
        $invoiceArr = explode(',', $InvArr[0]->invId);
        $data['select'] = ['SUM(invPayment.amount) as totalPaidAmount'];
        $data['where_in'] = array('invPayment.invoice_id' => $invoiceArr);
        $data['table'] = TABLE_INVOICE_PAYMENT . ' as invPayment';
        $result = $this->selectRecords($data);
        // print_r($result);exit;
        return $result;
    }

    public function totalClientexpAmount($companyId) {
        $data['select'] = ['GROUP_CONCAT(inv.id,"") as invId'];
        $data['where'] = ['inv.company_id' => $companyId];
        $data['table'] = TABLE_INVOICE . ' as inv';
        $InvArr = $this->selectRecords($data);
        $data = '';
        $invoiceArr = explode(',', $InvArr[0]->invId);
        $data['select'] = ['SUM(invExpense.total) as totalExpense'];
        $data['where_in'] = array('invExpense.invoice_id', $invoiceArr);
        $data['table'] = TABLE_INVOICE_EXPENSE . ' as invExpense';
        $result = $this->selectRecords($data);
        return $result;
    }

    public function getLastInvoice($companyId) {
        $data['select'] = ['inv.ref_no'];
        $data['where'] = ['inv.company_id' => $companyId];
        $data['order'] = ["id", "desc"];
        $data['table'] = TABLE_INVOICE . ' as inv';
        $InvArr = $this->selectRecords($data);
        return $InvArr;
    }

    public function getLastUnpaidInvouce($companyId, $client_id) {

        $result = $this->db->order_by('id', 'DESC')->get_where(TABLE_INVOICE, array('company_id' => $companyId))->row_array();
        
        $data['select'] = ['SUM(invDetails.total) as total'];
        $data['where'] = ['invDetails.invoice_id' => $result['id']];
        $data['order'] = ["id", "desc"];
        $data['groupBy'] = ['invDetails.invoice_id'];
        $data['table'] = TABLE_INVOICE_DETAILS . ' as invDetails';
        $totalAmount = $this->selectRecords($data);
        
        $data['select'] = ['SUM(invPayment.amount) as paidAmount'];
        $data['where'] = ['invPayment.invoice_id' => $result['id']];
        $data['order'] = ["id", "desc"];
        $data['groupBy'] = ['invPayment.invoice_id'];
        $data['table'] = TABLE_INVOICE_PAYMENT . ' as invPayment';
        $paidAmount = $this->selectRecords($data);
        $returnArr = array();
        $returnArr['totalAmount'] = !empty($totalAmount[0]->total) ? $result['currency'] . number_format($totalAmount[0]->total,2) : $result['currency'] . '0.00';
        $returnArr['paidAMount'] = !empty($paidAmount[0]->paidAmount) ? $result['currency'] . number_format($paidAmount[0]->paidAmount,2) : $result['currency'] . '0.00';
        $returnArr['invoiceNumber'] = $result['ref_no'];
        return $returnArr;
    }

}

?>