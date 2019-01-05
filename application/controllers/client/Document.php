<?php

class Document extends Client_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('Document_model', 'this_model');
        $this->load->model('Client_model', 'Client_model');
    }

    function index() {
        $data['page'] = "client/document/list";
        $data['document'] = 'active';
        $data['pagetitle'] = 'Document';
        $data['var_meta_title'] = 'Document';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'document' => 'Document List',
        );
        $data['css'] = array(
            'plugins/dataTables/datatables.min.css'
        );

        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',
            'plugins/datapicker/bootstrap-datepicker.js',
            'client/document.js',
        );
        $data['init'] = array(
            'Document.documentList()',
        );
        $companyId = $this->session->userdata['client_login']['companyId'];
        $data['companyName'] = $this->Client_model->getcompanyDetail();
        $data['docsArray'] = $this->this_model->getCompanyDocumentDetail($companyId);
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    public function addDoument() {
//        print_r($this->input->post());exit;
        $res = $this->this_model->addDocument($this->input->post());
        echo json_encode($res);
        exit();
    }

    public function editDocument() {
        $res = $this->this_model->editDocument($this->input->post());
        echo json_encode($res);
        exit();
    }

    public function deleteDocument() {
        if ($this->input->post()) {
            $result = $this->this_model->deleteDocs($this->input->post());
            echo json_encode($result);
            exit();
        }
    }

    public function deleteDocumentInfo() {
        if ($this->input->post()) {
            $result = $this->this_model->deleteDocumentInfo($this->input->post());
            echo json_encode($result);
            exit();
        }
    }

    function getdocsInfo() {
        if ($this->input->post()) {
            $result = $this->db->get_where(TABLE_DOCUMENT, array('id' => $this->input->post('docsId')))->row_array();
            echo json_encode($result);
            exit();
        }
    }

    function getDocumentItemInfo() {
        if ($this->input->post()) {
            $data['lableInfo'] = $this->db->get_where(TABLE_DOCUMENT_ITEM, array('document_id' => $this->input->post('docsId')))->result_array();
//           print_r($data['lableInfo']);exit;
            $html = $this->load->view('client/document/append', $data, TRUE);
//            echo $html;
//            exit;
            echo json_encode($html);
            exit();
        }
    }

    public function addDocsItem() {
        $res = $this->this_model->addDocsItem($this->input->post());
        echo json_encode($res);
        exit();
    }

    public function addRowData() {
        $res = $this->this_model->addRowData($this->input->post());
        if ($res) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Column add successfully.';
            $json_response['redirect'] = admin_url() . 'document';
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong.';
        }
        echo json_encode($json_response);
        exit();
    }

    public function addColumn() {
        $res = $this->this_model->addColumn($this->input->post());
        echo json_encode($res);
        exit();
    }

    public function addLabel($id) {
        $data['page'] = "client/document/add-label";
        $data['document'] = 'active';
        $data['pagetitle'] = 'Document';
        $data['var_meta_title'] = 'Document';
        $data['breadcrumb'] = array(
            'dashboard' => 'Home',
            'document' => 'Document List',
        );
        $data['css'] = array(
            'plugins/dataTables/datatables.min.css'
        );

        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',
            'plugins/datapicker/bootstrap-datepicker.js',
            'client/document.js',
        );
        $data['init'] = array(
            'Document.documentList()',
        );
        $data['docsId'] = $id;
        if ($this->input->post()) {
            echo '<pre/>';
            print_r($this->input->post());
            exit;
            $result = $this->this_model->deleteDocs($this->input->post());
        }

        $data['rowColumnArray'] = $this->db->get_where(TABLE_DOCUMENT, array('id' => $id))->row_array();
//        print_r($data['rowColumnArray']);exit;
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    public function getColumnData() {
//        print_r($this->input->post());exit;
        $data['columnArray'] = $this->db->get_where(TABLE_DOCUMENT_COLUMN, array('docs_id' => $this->input->post('docsId')))->result_array();
        $html = $this->load->view('client/document/column_list', $data, TRUE);
        echo json_encode($html);
        exit();
    }

    public function getColumnaddRowData() {
//        $data['columnArray'] = $this->this_model->getRowData($this->input->post());
//        print_r($this->input->post());exit;
        $data['columnArray'] = $this->db->get_where(TABLE_DOCUMENT_COLUMN, array('docs_id' => $this->input->post('docsId')))->result_array();
//        print_r($data['columnArray']);exit;
        $html = $this->load->view('client/document/row_add', $data, TRUE);
        echo json_encode($html);
        exit();
    }

    public function getRowList() {
        $data['rowArray'] = $this->this_model->getRowData1($this->input->post(),$this->session->userdata['client_login']['companyId']);
        $data['columnArray'] = $this->db->get_where(TABLE_DOCUMENT_COLUMN, array('docs_id' => $this->input->post('docsId')))->result_array();
        $html = $this->load->view('client/document/row_list', $data, TRUE);
        echo json_encode($html);
        exit();
    }
    
    public function deleterow() {
        if ($this->input->post()) {
            $result = $this->this_model->deleterow($this->input->post());
            echo json_encode($result);
            exit();
        }
    }

}

?>