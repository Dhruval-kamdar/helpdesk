<?php

class Label extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Label_model', 'this_model');
        $this->load->model('Client_model', 'Client_model');
    }

    function index() {
        $data['page'] = "admin/label/list";
        $data['label'] = 'active';
        $data['pagetitle'] = 'Label';
        $data['var_meta_title'] = 'Label';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'label' => 'Label List',
        );
        $data['css'] = array(
            'plugins/dataTables/datatables.min.css'
        );

        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',
            'plugins/datapicker/bootstrap-datepicker.js',
            'admin/label.js',
        );
        $data['init'] = array(
            'Label.labelList()',
        );
        $data['companyName'] = $this->Client_model->getcompanyDetail();
        $data['labelArray'] = $this->this_model->getLabelDetail();
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    public function addNewLable() {
        $res = $this->this_model->addLabel($this->input->post());
        echo json_encode($res);
        exit();
    }

    public function editLable() {
        $res = $this->this_model->editLable($this->input->post());
        echo json_encode($res);
        exit();
    }

    public function deleteLabel() {
        if ($this->input->post()) {
            $result = $this->this_model->deleteLabel($this->input->post());
            echo json_encode($result);
            exit();
        }
    }
    public function deleteLabelInfo() {
        if ($this->input->post()) {
            $result = $this->this_model->deleteLabelInfo($this->input->post());
            echo json_encode($result);
            exit();
        }
    }

    function getLabelInfo() {
        if ($this->input->post()) {
            $result = $this->db->get_where(TABLE_LABEL, array('id' => $this->input->post('labelId')))->row_array();
            echo json_encode($result);
            exit();
        }
    }

    function getLabelItemInfo() {
        if ($this->input->post()) {
            $data['lableInfo'] = $this->db->get_where(TABLE_LABEL_ITEM, array('label_id' => $this->input->post('labelId')))->result_array();
//           print_r($data['lableInfo']);exit;
            $html = $this->load->view('admin/label/append', $data,TRUE);
//            echo $html;
//            exit;
            echo json_encode($html);
            exit();
        }
    }

    public function addItem() {
        $res = $this->this_model->addItem($this->input->post());
        echo json_encode($res);
        exit();
    }

}

?>