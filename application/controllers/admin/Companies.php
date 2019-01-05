<?php

class Companies extends MY_Controller {
// class Company extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data['page'] = "admin/companies/list";
        $data['breadcrumb'] = 'companies';
        $data['breadcrumb_sub'] = 'companies';
        $data['breadcrumb_list'] = array(
            array('companies', '')
        );
        $data['dashboard'] = 'active open';
        $data['dashboard'] = 'active';
        $data['var_meta_title'] = 'companies';
        $data['var_meta_description'] = 'companies';
        $data['var_meta_keyword'] = 'companies';
        $data['js'] = array(
//            'admin/dashboard.js',
        );
        $data['css'] = array(
        );
        $data['css_plugin'] = array(

        );
        $data['js_plugin'] = array(

        );
        $data['init'] = array(
//            'Dashboard.init()',
        );

        $this->load->view(ADMIN_LAYOUT, $data);
    }
    

}

?>