<?php

class Estimate_model extends My_model {

    public function __construct() {
        parent::__construct();
        $this->load->model('Client_model', 'Client_model');
    }

    public function addEstimate($postData) {
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
        $data['table'] = TABLE_ESTIMATE;
        $result = $this->insertRecord($data);
        $objHistory = array(
            'description' => "created Estimate #" . $postData['ref_no'],
            'estimateId' => $result,
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

    public function getEstimateList($estimateId = null, $clientId) {
        $data['select'] = ['inv.*', 'SUM(estmtDetail.total) as totalPrice',
//            'SUM(invPayment.amount) as totalPaidAmount',
            'GROUP_CONCAT(estmtDetail.id) as totalPaidAmount',
//            'GROUP_CONCAT(DISTINCT estmtDetail.id) as totalPaidAmount',
            'usr.first_name', 'usr.last_name', 'usr.email',
            'estmtDetail.item_name',
            'estmtDetail.item_desc',
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
            TABLE_ESTIMATE_DETAILS . ' as estmtDetail' => [
                'estmtDetail.estimate_id = inv.id',
                'LEFT',
            ],
            TABLE_COMPANY . ' as comp' => [
                'comp.id = usr.company_id',
                'LEFT',
            ],
//            TABLE_ESTIMATE_PAYMENT . ' as invPayment' => [
//                'invPayment.invoice_id = inv.id',
//                'LEFT',
//            ],
        ];
        if ($estimateId) {
            $data['where'] = ['inv.id' => $estimateId];
        }
        if (!empty($clientId)) {
            $data['where'] = ['inv.client_id' => $clientId];
        }
        $data['groupBy'] = ['inv.id'];
        $data['table'] = TABLE_ESTIMATE . ' as inv';
        $result = $this->selectFromJoin($data);
//        print_r($result);exit;
        return $result;
    }
    
    public function getCompanyInvoiceList($estimateId = null, $companyId) {
        $data['select'] = ['inv.*', 'SUM(estmtDetail.total) as totalPrice',
//            'SUM(invPayment.amount) as totalPaidAmount',
            'GROUP_CONCAT(estmtDetail.id) as totalPaidAmount',
//            'GROUP_CONCAT(DISTINCT estmtDetail.id) as totalPaidAmount',
            'usr.first_name', 'usr.last_name', 'usr.email',
            'estmtDetail.item_name',
            'estmtDetail.item_desc',
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
            TABLE_ESTIMATE_DETAILS . ' as estmtDetail' => [
                'estmtDetail.estimate_id = inv.id',
                'LEFT',
            ],
            TABLE_COMPANY . ' as comp' => [
                'comp.id = usr.company_id',
                'LEFT',
            ],
//            TABLE_ESTIMATE_PAYMENT . ' as invPayment' => [
//                'invPayment.invoice_id = inv.id',
//                'LEFT',
//            ],
        ];
        if ($estimateId) {
            $data['where'] = ['inv.id' => $estimateId];
        }
        if (!empty($companyId)) {
            $data['where'] = ['inv.company_id' => $companyId];
        }
        $data['groupBy'] = ['inv.id'];
        $data['table'] = TABLE_ESTIMATE . ' as inv';
        $result = $this->selectFromJoin($data);
//        print_r($result);exit;
        return $result;
    }

    public function editEstimate($postData) {

        $data['update']['client_id'] = $postData['client_id'];
        $data['update']['ref_no'] = $postData['ref_no'];
        $data['update']['recur_every'] = $postData['recure_every'];
        $data['update']['company_id'] = $postData['companyId'];
        $data['update']['due_date'] = date('Y-m-d', strtotime($postData['due_date']));
        $data['update']['start_date'] = ($postData['start_date'] == '01-01-1970') ? '' : date('Y-m-d', strtotime($postData['start_date']));
        $data['update']['end_date'] = ($postData['end_date'] == '01-01-1970') ? '' : date('Y-m-d', strtotime($postData['end_date']));
        $data['update']['default_tax'] = $postData['default_tax'];
        $data['update']['discount'] = $postData['discount'];
        $data['update']['currency'] = $postData['currency'];
        $data['update']['note'] = $postData['notes'];
        $data['where'] = ['id' => $postData['id']];
        $data['table'] = TABLE_ESTIMATE;
        $result = $this->updateRecords($data);
        unset($data);
        if ($result) {
            $objHistory = array(
                'description' => $this->session->userdata['valid_login']['firstname'] . " edited INVOICE #" . $postData['ref_no'],
                'estimateId' => $postData['id'],
                'userId' => $this->session->userdata['valid_login']['id'],
            );
            $this->addHistory($objHistory);
            return true;
        } else {
            return false;
        }
    }

    public function generateEstimateNos() {
        $invoiceFix = 'EST';
        $query = $this->db->from(TABLE_ESTIMATE)->order_by("id", "desc")->get()->row();
        $id = $query->id + 201;
        $length = strlen($id + 201);
        $code = ($length == 1) ? '000' . $id : (($length == 2) ? '00' . $id : (($length == 3) ? '0' . $id : $id));
        return $invoiceFix.$code;

//        $newInvoice = '';
//        $query = $this->db->from(TABLE_ESTIMATE)->order_by("id", "desc")->get()->row();
//        $totalLength = (7 - strlen($query->id));
//
//        $newInvoiceNo = str_pad($invoiceFix, $totalLength, "0");
//        $newInvoice = $newInvoiceNo . ($query->id + 1);
//        return $newInvoice;
    }

    public function getEstimateById($id) {
        $data['select'] = ['estmt.*',
            'usr.first_name',
            'usr.last_name',
            'c.name as companyName',
            'c.email as companyEmail',
            'c.phone as companyPhone',
            'c.address as companyAddress',
            'c.city as companyCity',
            'con.name as countryName',
            'estmt.*',
        ];

        if ($id) {
            $data['where'] = ['estmt.id' => $id];
        }
        $data['join'] = [
            TABLE_USER . ' as usr' => [
                'usr.id = estmt.client_id',
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
        $data['table'] = TABLE_ESTIMATE . ' as estmt';
        $result = $this->selectFromJoin($data);
//        echo '<pre/>';print_r($result);exit;
        return $result;
    }

    public function addEstimateDetails($postData) {
//        print_r($postData);exit;
        $data['insert']['estimate_id'] = $postData['id'];
        $data['insert']['item_name'] = $postData['item_name'];
        $data['insert']['item_desc'] = $postData['item_desc'];
        $data['insert']['quentity'] = $postData['quentity'];
        $data['insert']['price'] = $postData['price'];
        $data['insert']['total'] = $postData['price'] * $postData['quentity'];
        $data['insert']['dt_created'] = DATE_TIME;
        $data['insert']['dt_updated'] = DATE_TIME;
        $data['table'] = TABLE_ESTIMATE_DETAILS;
        $result = $this->insertRecord($data);
        unset($data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getEstimatePaymentDetails($estimateId) {
        $data['select'] = ['estmt.*', 'estmtDetail.price', 'estmtDetail.item_name',
            'estmtDetail.item_desc', 'estmtDetail.quentity', 'estmtDetail.id as paymentId',
            'SUM(invPayment.amount) as totalPaidAmount',
            'SUM(estmtDetail.total) as total',
        ];
        $data['where'] = ['estmt.id' => $estimateId];
        $data['join'] = [
            TABLE_ESTIMATE_DETAILS . ' as estmtDetail' => [
                'estmtDetail.estimate_id = estmt.id',
                'LEFT',
            ],
            TABLE_ESTIMATE_PAYMENT . ' as invPayment' => [
                'invPayment.estimate_id = estmtDetail.id',
                'LEFT',
            ],
        ];
        $data['groupBy'] = ['estmtDetail.id'];
        $data['table'] = TABLE_ESTIMATE . ' as estmt';
        $result = $this->selectFromJoin($data);
        return $result;
    }

    public function getClientDetail($companyId, $clientId) {
        $data['select'] = ['first_name', 'last_name', 'email'];
        $data['where'] = ['id' => $clientId, 'company_id' => $companyId];
        $data['table'] = TABLE_USER;
        $result = $this->selectRecords($data);
        return $result;
    }

    public function deletePaymentEstimate($data) {
        $this->db->where('id', $data['id']);
        $result = $this->db->delete(TABLE_ESTIMATE_DETAILS);

        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Estimate delete successfully';
            $json_response['jscode'] = 'setTimeout(function(){location.reload();},1000)';
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }
    
    public function expenseDelete($data) {
        $this->db->where('id', $data['id']);
        $result = $this->db->delete(TABLE_ESTIMATE_EXPENSE);

        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Expense delete successfully';
            $json_response['jscode'] = 'setTimeout(function(){location.reload();},1000)';
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

    public function addHistory($postData) {
        $data['insert']['estimate_id'] = $postData['estimateId'];
        $data['insert']['history_desc'] = $postData['description'];
        $data['insert']['user_id'] = $postData['userId'];
        $data['insert']['dt_created'] = DATE_TIME;
        $data['insert']['dt_updated'] = DATE_TIME;
        $data['table'] = TABLE_ESTIMATE_HISTORY;
        $result = $this->insertRecord($data);
        unset($data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getHistoryList($estimateId) {

        $data['select'] = ['invHis.*', 'usr.first_name', 'usr.last_name',];
        $data['join'] = [
            TABLE_ESTIMATE . ' as estmt' => [
                'estmt.id = invHis.estimate_id',
                'LEFT',
            ],
            TABLE_USER . ' as usr' => [
                'usr.id = invHis.user_id',
                'LEFT',
            ],
        ];
        $data['where'] = ['estimate_id' => $estimateId];
        $data['table'] = TABLE_ESTIMATE_HISTORY . ' as invHis';
        $result = $this->selectFromJoin($data);
        return $result;
    }

    public function generateTransactionNos() {
        $newInvoice = '';
        $query = $this->db->from(TABLE_ESTIMATE_PAYMENT)->order_by("id", "desc")->get()->row();
        $totalLength = (6 - strlen($query->id));
        $invoiceFix = 'TNP';
        $newInvoiceNo = str_pad($invoiceFix, $totalLength, "0");
        $newInvoice = $newInvoiceNo . ($query->id + 1);
        return $newInvoice;
    }

    public function addPayment($postData) {
        $data['insert']['estimate_id'] = $postData['estimate_id'];
        $data['insert']['amount'] = $postData['amount'];
        $data['insert']['trans_id'] = $postData['trans_id'];
        $data['insert']['payment_date'] = date('Y-m-d', strtotime($postData['payment_date']));
        $data['insert']['payment_method'] = $postData['payment_method'];
        $data['insert']['notes'] = $postData['notes'];
        $data['insert']['send_mail'] = (!empty($postData['send_mail'])) ? '1' : '0';
        $data['insert']['dt_created'] = DATE_TIME;
        $data['insert']['dt_updated'] = DATE_TIME;
        $data['table'] = TABLE_ESTIMATE_PAYMENT;
        $result = $this->insertRecord($data);
        unset($data);
        if ($result) {
            $objHistory = array(
                'description' => "Payment of " . $postData['currency'] . $postData['amount'] . " received and applied to INVOICE #" . $postData['ref_no'],
                'estimateId' => $postData['estimate_id'],
                'userId' => $this->session->userdata['valid_login']['id'],
            );
            $this->addHistory($objHistory);
            return true;
        } else {
            return false;
        }
    }

    public function deleteEstimate($data) {
        $this->db->where('id', $data['id']);
        $this->db->delete(TABLE_ESTIMATE);

        $this->db->where('estimate_id', $data['id']);
        $this->db->delete(TABLE_ESTIMATE_DETAILS);


        $this->db->where('estimate_id', $data['id']);
        $this->db->delete(TABLE_ESTIMATE_PAYMENT);

        $this->db->where('estimate_id', $data['id']);
        $result = $this->db->delete(TABLE_ESTIMATE_HISTORY);

        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Estimate delete successfully';
            $json_response['redirect'] = admin_url('estimate');
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

    public function sendEstimateEmail($postData) {
        $estimateArray = $this->getEstimateList($postData['invoiceId'], '');
        $data['link'] = base_url_index() . 'admin/estimate/view/' . $this->utility->encode($postData['invoiceId']);
        $data['ref_no'] = $estimateArray[0]->ref_no;
        $data['totalPrice'] = $estimateArray[0]->currency . ' ' . (empty($estimateArray[0]->totalPrice)) ? '0.00.' : $estimateArray[0]->totalPrice;
        $data['client_email'] = $estimateArray[0]->email;
        $data['client_name'] = $estimateArray[0]->first_name . ' ' . $estimateArray[0]->last_name;
        if ($postData['type'] == 'invoice') {
            $data['message'] = $this->load->view('email_template/estimate_mail', $data, true);
            $data['from_title'] = 'Email Estimate';
            $data['subject'] = 'Estimate ' . $estimateArray[0]->ref_no;
        } else {
            $data['message'] = $this->load->view('email_template/reminder_estimate_mail', $data, true);
            $data['from_title'] = 'Email Estimate';
            $data['subject'] = 'Estimate ' . $estimateArray[0]->ref_no . ' Reminder';
        }

        $data['to'] = 'shaileshvanaliya91@gmail.com';
//        $data["to"] = $estimateArray[0]->email;
        $data["replyto"] = REPLAY_EMAIL;
        $data["bcc"] = REPLAY_EMAIL;
        $mailSend = $this->utility->sendMailSMTP($data);
        return true;
//        return $mailSend;
    }
    
    public function addExpenseDetails($postData) {
        $data['insert']['estimate_id'] = $postData['invoiceId'];
        $data['insert']['expense_name'] = $postData['item_name'];
        $data['insert']['expense_desc'] = $postData['item_desc'];
        $data['insert']['quentity'] = $postData['quentity'];
        $data['insert']['price'] = $postData['price'];
        $data['insert']['total'] = $postData['price'] * $postData['quentity'];
        $data['insert']['dt_created'] = DATE_TIME;
        $data['insert']['dt_updated'] = DATE_TIME;
        $data['table'] = TABLE_ESTIMATE_EXPENSE;
        $result = $this->insertRecord($data);
        unset($data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getEstimateExpense($estimateId) {

        $data['select'] = ['esmt.*', 'invExpense.price', 'invExpense.expense_name',
            'invExpense.expense_desc', 'invExpense.quentity', 'invExpense.id as paymentId',
            'SUM(invExpense.total) as total',
        ];
        $data['where'] = ['esmt.id' => $estimateId];
        $data['join'] = [
            TABLE_ESTIMATE_EXPENSE . ' as invExpense' => [
                'invExpense.estimate_id = esmt.id',
                'LEFT',
            ],
        ];
        $data['groupBy'] = ['invExpense.id'];
        $data['table'] = TABLE_ESTIMATE . ' as esmt';
        $result = $this->selectFromJoin($data);
        
        return $result;
    }
    
    public function totalAmount() {
        $data['select'] = ['SUM(estmtDetail.total) as total'];
        $data['table'] = TABLE_ESTIMATE_DETAILS. ' as estmtDetail';
        $result = $this->selectRecords($data);
        return $result;
    }
    
    public function totalpaidAmount() {
        $data['select'] = ['SUM(invPayment.amount) as totalPaidAmount'];
        $data['table'] =  TABLE_ESTIMATE_PAYMENT . ' as invPayment';
        $result = $this->selectRecords($data);
        return $result;
    }
    
    public function totalexpAmount(){
        $data['select'] = ['SUM(invExpense.total) as totalExpense'];
        $data['table'] =  TABLE_ESTIMATE_EXPENSE . ' as invExpense';
        $result = $this->selectRecords($data);
        return $result;
    }
    
    public function totalClientAmount($companyId){
        $data['select'] = ['GROUP_CONCAT(inv.id,"") as invId'];
        $data['where'] = ['inv.company_id' => $companyId];
        $data['table'] =  TABLE_ESTIMATE . ' as inv';
        $InvArr = $this->selectRecords($data);
        $data = '';
        $data['select'] = ['SUM(estmtDetail.total) as total'];
        $data['where_in'] = array('estmtDetail.estimate_id'=>$InvArr[0]->invId);
        $data['table'] = TABLE_ESTIMATE_DETAILS. ' as estmtDetail';
        $result = $this->selectRecords($data);
        return $result;
        
        
    }
    
    public function totalClientpaidAmount($companyId){
        $data['select'] = ['GROUP_CONCAT(inv.id,"") as invId'];
        $data['where'] = ['inv.company_id' => $companyId];
        $data['table'] =  TABLE_ESTIMATE . ' as inv';
        $InvArr = $this->selectRecords($data);
        $data = '';
        
        $data['select'] = ['SUM(invPayment.amount) as totalPaidAmount'];
        $data['where_in'] = array('invPayment.estimate_id'=>$InvArr[0]->invId);
        $data['table'] =  TABLE_ESTIMATE_PAYMENT . ' as invPayment';
        $result = $this->selectRecords($data);
       // print_r($result);exit;
        return $result;
    }
    
    public function totalClientexpAmount($companyId) {
        $data['select'] = ['GROUP_CONCAT(inv.id,"") as invId'];
        $data['where'] = ['inv.company_id' => $companyId];
        $data['table'] =  TABLE_ESTIMATE . ' as inv';
        $InvArr = $this->selectRecords($data);
        $data = '';
        
        $data['select'] = ['SUM(invExpense.total) as totalExpense'];
        $data['where_in'] = array('invExpense.invoice_id',$InvArr[0]->invId);
        $data['table'] =  TABLE_ESTIMATE_EXPENSE . ' as invExpense';
        $result = $this->selectRecords($data);
        return $result;
    }
    
    public function getLastInvoice($companyId)
    {
        $data['select'] = ['inv.ref_no'];
        $data['where'] = ['inv.company_id' => $companyId];
        $data['order'] = ["id", "desc"];
        $data['table'] =  TABLE_ESTIMATE . ' as inv';
        $InvArr = $this->selectRecords($data);
        return $InvArr;
    }

}

?>