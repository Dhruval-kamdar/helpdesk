<?php

class Reset_password_model extends My_model {

    public function __construct() {
        parent::__construct();
    }
    
    function changePassword($postData,$redirect = NULL){
       $data['update']['password'] = md5($postData['newpwd']);
       $data['update']['dt_updated'] = DATE_TIME;
       $data['where'] = ['id' => $this->user_id];
       $data['table'] = TABLE_USER;
       $result = $this->updateRecords($data);
       if($result){
           $json_response['status'] = 'success';
           $json_response['message'] = 'Passwrod Reset SuccessFully';
           if($redirect){
               $url = client_url();
           }else{
               $url = admin_url();
           }
           $json_response['redirect'] = $url . 'reset_password';
        }else {
           $json_response['status'] = 'error';
           $json_response['message'] = 'Something went wrong';
       }
       return $json_response;
    }
}

?>