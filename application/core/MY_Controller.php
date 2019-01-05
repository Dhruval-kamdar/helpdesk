<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public $json_response = null;
    public $user_id = null;
    function __construct()
    {
        parent::__construct();
        require_once APPPATH . 'config/tablenames_constants.php';
        
        date_default_timezone_set('UTC');
        $this->json_response = array('status' => 'error', 'message' => 'something went wrong!');
    }

}


class Admin_Controller extends MY_Controller
{

    public $user_data = null;
    public $user_type = null;
    public $user_id = null;

    function __construct()
    {
       
        parent::__construct();
         
        if ($this->router->fetch_class() != "account" && $this->router->fetch_method() != "login") {
            
            if (!isset($this->session->userdata['valid_login'])) {
                redirect(base_url());
            }
        }
        $this->user_id = $this->session->userdata['valid_login']['id'];
    }
    


}

class Client_Controller extends MY_Controller
{

    public $user_data = null;
    public $user_type = null;
    public $user_id = null;

    function __construct()
    {
        parent::__construct();

        if ($this->router->fetch_class() != "account" && $this->router->fetch_method() != "login") {

            if (!isset($this->session->userdata['client_login'])) {
                redirect(base_url());
            }
        }
        
        $this->user_id = $this->session->userdata['client_login']['id'];
        
    }
    


}
