<?php

class Department_model extends My_model {

    public function __construct() {
        parent::__construct();
    }

    function addDepartment($postData) {
        $data['insert']['name'] = $postData['department_name'];
        $data['insert']['dt_created'] = DATE_TIME;
        $data['insert']['dt_updated'] = DATE_TIME;
        $data['table'] = TABLE_MASTER_DEPARTMENT;
        $deparmentId = $this->insertRecord($data);

        unset($data);
        if ($deparmentId) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Department add successfully';
                $json_response['redirect'] = admin_url() . 'setting';
            
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

    function getDepartmentDetail($id = NULL) {
        $data['select'] = ['name','id','dt_created'];
        if($id){
            $data['where'] = ['id' => $id];
        }
        $data['table'] = TABLE_MASTER_DEPARTMENT;
        $result = $this->selectRecords($data);

        return $result;
    }

    function editDepartment($postData, $departmentId) {
        $data['update']['name'] = $postData['department_name'];
        $data['update']['dt_updated'] = DATE_TIME;
        $data['where'] = ['id' => $departmentId];
        $data['table'] = TABLE_MASTER_DEPARTMENT;
        $result = $this->updateRecords($data);

        unset($data);
        if ($result) {

            if ($result) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Department edit successfully';
                $json_response['redirect'] = admin_url() . 'setting';
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong';
            }
        }

        return $json_response;
    }

    function deleteDepartment($data){
        $this->db->where('id',$data['id']);
        $result =  $this->db->delete(TABLE_MASTER_DEPARTMENT);
        if($result){
            $json_response['status'] = 'success';
            $json_response['message'] = 'Department delete successfully';
            $json_response['jscode'] = 'setTimeout(function(){location.reload();},1000)';
            
        }else{
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }
    
}

?>