<?php

class Client_model extends My_model {

    public function __construct() {
        parent::__construct();
    }

    function countryList() {
        $data['select'] = ['id', 'sortname', 'name', 'phonecode'];
        $data['table'] = TABLE_COUNTRIES;
        $result = $this->selectRecords($data);
        return $result;
    }

    function addCompany($postData) {
        $data['insert']['name'] = $postData['company_name'];
        $data['insert']['email'] = $postData['company_email'];
        $data['insert']['phone'] = $postData['company_phone'];
        $data['insert']['address'] = $postData['additional_information'];
        $data['insert']['city'] = $postData['company_city'];
        $data['insert']['country_id'] = $postData['country_name'];
        $data['insert']['dt_created'] = DATE_TIME;
        $data['insert']['dt_updated'] = DATE_TIME;
        $data['table'] = TABLE_COMPANY;
        $companyId = $this->insertRecord($data);

        unset($data);
        if ($companyId) {
            $result = $this->addCompanyUsers($postData, $companyId);
            if ($result) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Company add successfully';
                $json_response['redirect'] = admin_url() . 'client';
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong';
            }
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

    function addCompanyUsers($postData, $companyId) {

        $checkAlready = $this->checkAlready($postData['person_email'], $companyId);

        if ($checkAlready) {

            $data['insert']['first_name'] = $postData['person_fname'];
            $data['insert']['last_name'] = $postData['person_lname'];
            $data['insert']['email'] = $postData['person_email'];
            $data['insert']['password'] = md5($postData['company_password']);
            $data['insert']['type'] = 'C';
            $data['insert']['is_verify'] = '0';
            $data['insert']['veryfication_token'] = md5($postData['person_email'] . time());
            $data['insert']['status'] = '1';
            $data['insert']['phone_no'] = $postData['company_user_phone'];
            $data['insert']['address'] = $postData['address'];
            $data['insert']['company_id'] = $companyId;
            $data['insert']['dt_created'] = DATE_TIME;
            $data['table'] = TABLE_USER;
            $result = $this->insertRecord($data);

            unset($data);
            if ($result) {
                /* Send Email to company user for verify account */
//                $dataToeken = md5($postData['person_email'] . time() . $postData['company_password']);
                $dataToeken = md5($postData['person_email'] . time());
                $data ['username'] = $postData['person_fname'] . ' ' . $postData['person_lname'];
                $data ['link'] = base_url_index() . 'account/verifyEmail/' . $dataToeken;
                $data ['message'] = $this->load->view('email_template/registration_mail', $data, TRUE);
                $data ['from_title'] = 'Verify user email address';
                $data ['subject'] = 'Verify user email address';
                $data ["to"] = $postData['person_email'];
                $mailSend = $this->utility->sendMailSMTP($data);

                unset($data);

                $data_array = array(
                    'company_name' => $postData['company_name'],
                    'fname' => $postData['person_fname'],
                    'lname' => $postData['person_fname'],
                    'email' => $postData['person_email'],
                    'password' => $postData['company_password'],
                );

                $data ['message'] = $this->load->view('email_template/user_info', $data_array, true);
                $data ['from_title'] = 'Userinfo';
                $data ['subject'] = 'Userinfo';
                $data ["to"] = $postData['company_email'];
                $result = $this->utility->sendMailSMTP($data);
                $json_response['status'] = 'success';
                $json_response['message'] = 'Person add successfully';
                $json_response['redirect'] = admin_url() . 'client/detail/' . $this->utility->encode($this->input->post('company_id'));
                return $json_response;
            }
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'This user already register';
            return $json_response;
        }
    }

    function checkAlready($email, $id) {
        $this->db->where('company_id', $id);
        $this->db->where('email', $email);
        $result = $this->db->get(TABLE_USER)->result_array();
        if (empty($result)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getcompanyDetail() {
        $data['select'] = ['c.name as comapnyName', 'c.email as companyEmail', 'c.phone as companyPhone', 'c.id as companyId', 'ct.name as countryName'];
        $data['join'] = [
            TABLE_COUNTRIES . ' as ct' => [
                'c.country_id = ct.id',
                'LEFT',
            ],
        ];
        $data['table'] = TABLE_COMPANY . '  c';
        $result = $this->selectFromJoin($data);

        return $result;
    }

    function getdocCompanyDetail() {
        $data['select'] = ['c.name as comapnyName', 'c.email as companyEmail', 'c.phone as companyPhone', 'c.id as companyId', 'ct.name as countryName'];
        $data['join'] = [
            TABLE_COUNTRIES . ' as ct' => [
                'c.country_id = ct.id',
                'LEFT',
            ],
            TABLE_DOCUMENT . ' as docs' => [
                'c.id = docs.company_id',
                'LEFT',
            ],
        ];
        $data['groupBy'] = ['c.id'];
        $data['table'] = TABLE_COMPANY . '  c';
        $result = $this->selectFromJoin($data);

        return $result;
    }

    function companyDetail($companyId) {
        $data['select'] = [
            'c.name as companyName', 'c.email as companyEmail',
            'c.phone as companyPhone', 'c.address as companyAddress', 'c.city', 'c.id as companyId',
            'c.country_id', 'ct.name as countyName'];
        $data['table'] = TABLE_COMPANY . ' c';
        $data['join'] = [
            TABLE_COUNTRIES . ' as ct' => [
                'c.country_id = ct.id',
                'LEFT',
            ],
        ];
        $data['where'] = ['c.id' => $companyId];
        $result = $this->selectFromJoin($data);
        return $result;
    }

    function editCompany($postData, $companyId) {
        $data['update']['name'] = $postData['company_name'];
        $data['update']['phone'] = $postData['company_phone'];
        $data['update']['address'] = $postData['additional_information'];
        $data['update']['city'] = $postData['company_city'];
        $data['update']['country_id'] = $postData['country_id'];
        $data['update']['dt_updated'] = DATE_TIME;
        $data['where'] = ['id' => $companyId];
        $data['table'] = TABLE_COMPANY;
        $result = $this->updateRecords($data);

        unset($data);
        if ($result) {

            if ($result) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Company edit successfully';
                $json_response['redirect'] = admin_url() . 'client';
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong';
            }
        }

        return $json_response;
    }

    function companyUserDetail($companyId) {
        $data['select'] = ['u.id', 'u.first_name', 'u.last_name', 'u.email', 'u.phone_no'];
        $data['where'] = ['u.company_id' => $companyId];
        $data['table'] = TABLE_USER . ' u';
        $result = $this->selectRecords($data);

        return $result;
    }

    function editCompanyUsers($postData) {

        $data['update']['first_name'] = $postData['person_fname'];
        $data['update']['last_name'] = $postData['person_lname'];
        $data['update']['phone_no'] = $postData['company_user_phone'];
        $data['update']['address'] = $postData['address'];
        $data['update']['dt_updated'] = DATE_TIME;
        $data['where'] = ['id' => $postData['person_id'], 'company_id' => $postData['company_id']];
        $data['table'] = TABLE_USER;
        $result = $this->updateRecords($data);

        unset($data);

        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Company edit successfully';
            $json_response['redirect'] = admin_url() . 'client/detail/' . $this->utility->encode($postData['company_id']);
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

    function deletePerson($data) {
        $this->db->where('id', $data['id']);
        $result = $this->db->delete(TABLE_USER);
        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Person delete successfully';
            $json_response['jscode'] = 'setTimeout(function(){location.reload();},1000)';
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

    function deleteClient($data) {
        $this->db->where('company_id', $data['id']);
        $this->db->delete(TABLE_USER);

        $this->db->where('id', $data['id']);
        $result = $this->db->delete(TABLE_COMPANY);

        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Client delete successfully';
            $json_response['jscode'] = 'setTimeout(function(){location.reload();},1000)';
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

    function getReporterDetail($id = NULL) {
        $data['select'] = ['last_name', 'id', 'first_name', 'email'];
        $data['where'] = ['type' => 'C'];
        // $data['where'] = ['is_verify' => '1'];
        $data['table'] = TABLE_USER;
        $result = $this->selectRecords($data);

        return $result;
    }
    function getReporterDetail2($id = NULL) {
        $data['select'] = [
            'c.name as companyName', 'u.last_name', 'u.id', 'u.first_name', 'u.email'];
        $data['table'] = TABLE_USER . ' u';
        $data['join'] = [
            TABLE_COMPANY . ' as c' => [
                'c.id = u.company_id',
                'LEFT',
            ],
        ];
        $data['where'] = ['u.type' => 'C'];
       // $data['where'] = ['c.id' => $companyId];
        $result = $this->selectFromJoin($data);
        return $result;

        return $result;
    }

    public function resetPassword($postData) {
        $this->db->where('id', $postData['clientId']);
        $clientArray = $this->db->get(TABLE_USER)->row_array();

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $auto_pass = '';
        for ($i = 0; $i < 7; $i++) {
            $auto_pass .= $characters[mt_rand(0, 61)];
        }
        $content = array(
            'password' => md5($auto_pass),
        );
        $this->db->where('id', $clientArray['id']);
        $this->db->update(TABLE_USER, $content);

        $data_array = array(
            'fname' => $clientArray['first_name'],
            'lname' => $clientArray['last_name'],
            'email' => $clientArray['email'],
            'password' => $auto_pass,
        );

        $data ['message'] = $this->load->view('email_template/reset_password', $data_array, true);
        $data ['from_title'] = 'Reset Password';
        $data ['subject'] = 'Reset Password';
        $data ["to"] = $clientArray['email'];
//        $data ["to"] = $postData['company_email'];
        $result = $this->utility->sendMailSMTP($data);
//        $json_response['status'] = 'success';
//        $json_response['message'] = 'Reset Password Mail Sent successfully';
//        $json_response['redirect'] = admin_url() . 'client/detail/' . $this->utility->encode($this->input->post('company_id'));
//        return $json_response;
        return $result;
    }

    public function varifyEmail($postData) {
        $this->db->where('id', $postData['clientId']);
        $clientArray = $this->db->get(TABLE_USER)->row_array();
        $dataToeken = md5($clientArray['email'] . time());
        $data ['username'] = $clientArray['first_name'] . ' ' . $clientArray['last_name'];
        $data ['link'] = base_url_index() . 'account/verifyEmail/' . $dataToeken;
        $data ['message'] = $this->load->view('email_template/registration_mail', $data, TRUE);
        $data ['from_title'] = 'Verify user email address';
        $data ['subject'] = 'Verify user email address';
        $data ["to"] = $clientArray['email'];
        $mailSend = $this->utility->sendMailSMTP($data);
        if ($mailSend) {

            $dataUpdate['update']['veryfication_token'] = $dataToeken;
            $dataUpdate['update']['is_verify'] = '0';
            $dataUpdate['where'] = ['id' => $clientArray['id']];
            $dataUpdate['table'] = TABLE_USER;
            $this->updateRecords($dataUpdate);
            unset($data);
        }
        return $mailSend;
    }

}

?>