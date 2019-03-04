<?php

class Account extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'this_model');
        $this->load->helper('cookie');
    }

    function index() {
        if (isset($this->session->userdata['valid_login'])) {
            redirect(base_url_index() . 'admin/dashboard');
        } else {
            $this->login();
        }
    }
    
    function login() {
        $data['page'] = "admin/account/login";
        $data['var_meta_title'] = 'Login';
        $data['var_meta_description'] = 'Login';
        $data['var_meta_keyword'] = 'Login';
        $data['js'] = array(
            'admin/login.js'
        );
        $data['js_plugin'] = array(
        );
        $data['css'] = array(
        );
        $data['css_plugin'] = array(
        );
        $data['init'] = array(
            'Login.init()'
        );

        if ($this->input->post()) {

            $loginCheck = $this->this_model->loginCheck($this->input->post());
            echo json_encode($loginCheck);
            exit();
        }

        $this->load->view(ADMIN_LAYOUT_LOGIN, $data);
    }

    function register() {
        $data['page'] = "admin/account/register";
        $data['var_meta_title'] = 'Register';
        $data['var_meta_description'] = 'Register';
        $data['var_meta_keyword'] = 'Register';
        $data['js'] = array(
            'admin/signup.js'
        );
        $data['js_plugin'] = array(
        );
        $data['css'] = array(
        );
        $data['css_plugin'] = array(
        );
        $data['init'] = array(
            'Login.init()'
        );



        $this->load->view(ADMIN_LAYOUT_LOGIN, $data);
    }

    function forgot_password() {

        $data['page'] = "admin/account/forgot_password";
        $data['var_meta_title'] = 'Register';
        $data['var_meta_description'] = 'Register';
        $data['var_meta_keyword'] = 'Register';
        $data['js'] = array(
            'admin/login.js'
        );
        $data['js_plugin'] = array(
        );
        $data['css'] = array(
        );
        $data['css_plugin'] = array(
        );
        $data['init'] = array(
            'Login.init()'
        );
        if ($this->input->post()) {
            $loginCheck = $this->this_model->sendForgotEmail($this->input->post());
            echo json_encode($loginCheck);
            exit();
        }
        $this->load->view(ADMIN_LAYOUT_LOGIN, $data);
    }

    function verifyEmail($dataToken) {
        $result = $this->this_model->verifyUserByToken($dataToken);
        redirect(base_url_index());
    }

    function logout($type) {
        if ($type == 'A') {
            // $this->session->sess_destroy();
            $this->session->unset_userdata('valid_login');
        } else if ($type == 'C') {
            $this->session->unset_userdata('client_login');
        } else {
            $this->session->sess_destroy();
        }
        // $this->session->sess_destroy();
        redirect(base_url_index());
    }

}

?>