<?php

class Reset_password extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Reset_password_model', 'this_model');
    }

    function index() {
        $data['page'] = "admin/reset_password/index";
        $data['resetPassword'] = 'active';
        $data['pagetitle'] = 'Reset Password';
        $data['var_meta_title'] = 'Reset Password';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'client' => 'Reset Password',
        );
        
        $data['js'] = array(
            'admin/change_password.js',
        );
        $data['init'] = array(
            'Change_password.init()',
        );
        
        if($this->input->post()){
            $res = $this->this_model->changePassword($this->input->post());
            echo json_encode($res); exit();
        }
        $this->load->view(ADMIN_LAYOUT, $data);
    }

}

?>