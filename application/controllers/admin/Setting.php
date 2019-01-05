<?php

class Setting extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Department_model','this_model');
    }

    function index() {
        $data['page'] = "admin/setting/department/index";
        $data['setting'] = 'active';
        $data['department'] = 'active';
        $data['pagetitle'] = 'Department';
        $data['var_meta_title'] = 'Department';
        $data['breadcrumb'] = array(
            'dashboard'=>'Home',
            'client'=>'Department List',
        );
        $data['css'] = array(
            'plugins/dataTables/datatables.min.css'
        );
        
        $data['js'] = array(
             'plugins/dataTables/datatables.min.js',
             'admin/setting.js',
        );
        $data['init'] = array(
            'Setting.list()',
        );
        $data['department_detail'] = $this->this_model->getDepartmentDetail();
        $this->load->view(ADMIN_LAYOUT, $data);
    }
    function department_add() {
        $data['page'] = "admin/setting/department/add";
        $data['setting'] = 'active';
        $data['department'] = 'active';
        $data['pagetitle'] = 'Department Add';
        $data['var_meta_title'] = 'Department Add';
        $data['breadcrumb'] = array(
            'dashboard'=>'Home',
            'department'=>'Department Add',
        );
        $data['css'] = array();
        
        $data['js'] = array(
            'admin/setting.js',
        );
        $data['init'] = array(
            'Setting.add_edit()',
        );
        
        if($this->input->post()){
            $res = $this->this_model->addDepartment($this->input->post());
            echo json_encode($res); exit();
        }
        $this->load->view(ADMIN_LAYOUT, $data);
    }
    function department_edit($id) {
        $ids = $this->utility->decode($id);
        
        if(!ctype_digit($ids)){
            redirect(admin_url().'setting');
        }
        
        $data['page'] = "admin/setting/department/add";
        $data['setting'] = 'active';
        $data['department'] = 'active';
        $data['pagetitle'] = 'Department Edit';
        $data['var_meta_title'] = 'Department Edit';
        $data['breadcrumb'] = array(
            'dashboard'=>'Home',
            'department'=>'Department Edit',
        );
        $data['css'] = array();
        
        $data['js'] = array(
            'admin/setting.js',
        );
        $data['init'] = array(
            'Setting.add_edit()',
        );
        
        $data['department_detail'] = $this->this_model->getDepartmentDetail($ids);
        
        if($this->input->post()){
            $res = $this->this_model->editDepartment($this->input->post(),$ids);
            echo json_encode($res); exit();
        }
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function deleteDepartment(){
        if($this->input->post()){
            $result = $this->this_model->deleteDepartment($this->input->post());
            echo json_encode($result); exit();
        }
    }

      function general() {
        $data['page'] = "admin/setting/general/index";
        $data['setting'] = 'active';
        $data['general'] = 'active';
        $data['pagetitle'] = 'General';
        $data['var_meta_title'] = 'General';
        $data['breadcrumb'] = array(
            'dashboard'=>'Home',
            'general'=>'General',
        );
        $data['css'] = array();
        
        $data['js'] = array(
            'admin/setting.js',
        );
        $data['init'] = array(
            'Setting.general_init()',
        );
        
        // $data['department_detail'] = $this->this_model->getDepartmentDetail($ids);
        // if($this->input->post()){
        //     $res = $this->this_model->editDepartment($this->input->post(),$ids);
        //     echo json_encode($res); exit();
        // }
        $this->load->view(ADMIN_LAYOUT, $data);
    }
    

      function email_setting() {
        $data['page'] = "admin/setting/email_setting/index";
        $data['setting'] = 'active';
        $data['email_setting'] = 'active';
        $data['pagetitle'] = 'Email Settings';
        $data['var_meta_title'] = 'Email Settings';
        $data['breadcrumb'] = array(
            'dashboard'=>'Home',
            'email_setting'=>'Email Settings',
        );
        $data['css'] = array();
        
        $data['js'] = array(
            'admin/setting.js',
        );
        $data['init'] = array(
            'Setting.email_init()',
        );
        
        // $data['department_detail'] = $this->this_model->getDepartmentDetail($ids);
        // if($this->input->post()){
        //     $res = $this->this_model->editDepartment($this->input->post(),$ids);
        //     echo json_encode($res); exit();
        // }
        $this->load->view(ADMIN_LAYOUT, $data);
    }
}
?>