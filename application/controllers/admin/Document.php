<?php

class Document extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Document_model', 'this_model');
        $this->load->model('Client_model', 'Client_model');
    }

    function index() {
        $data['page'] = "admin/document/list";
        $data['document'] = 'active';
        $data['addDoc'] = 'active';
        $data['pagetitle'] = 'Add Document';
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
            'admin/document.js',
        );
        $data['init'] = array(
            'Document.documentList()',
        );
        $data['companyName'] = $this->Client_model->getcompanyDetail();
        $data['docsArray'] = $this->this_model->getDocumentDetail();
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
            $html = $this->load->view('admin/document/append', $data, TRUE);
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
        $data['page'] = "admin/document/add-label";
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
            'admin/document.js',
        );
        $data['init'] = array(
            'Document.documentList()',
        );
        $data['docsId'] = $id;
        $data['rowColumnArray'] = $this->db->get_where(TABLE_DOCUMENT, array('id' => $id))->row_array();
//        print_r($data['rowColumnArray']);exit;
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    public function getColumnData() {
//        print_r($this->input->post());exit;
        $data['columnArray'] = $this->db->get_where(TABLE_DOCUMENT_COLUMN, array('docs_id' => $this->input->post('docsId')))->result_array();
        $html = $this->load->view('admin/document/column_list', $data, TRUE);
        echo json_encode($html);
        exit();
    }

    public function getColumnaddRowData() {
//        $data['columnArray'] = $this->this_model->getRowData($this->input->post());
//        print_r($this->input->post());exit;
        $data['columnArray'] = $this->db->get_where(TABLE_DOCUMENT_COLUMN, array('docs_id' => $this->input->post('docsId')))->result_array();
//        print_r($data['columnArray']);exit;
        $html = $this->load->view('admin/document/row_add', $data, TRUE);
        echo json_encode($html);
        exit();
    }

    public function getRowList() {
        $data['rowArray'] = $this->this_model->getRowData($this->input->post());
        $data['columnArray'] = $this->db->get_where(TABLE_DOCUMENT_COLUMN, array('docs_id' => $this->input->post('docsId')))->result_array();
        $html = $this->load->view('admin/document/row_list', $data, TRUE);
        echo json_encode($html);
        exit();
    }
    
    public function getTabWiseRowList() {
        $data['rowArray'] = $this->this_model->getRowData($this->input->post());
        $data['columnArray'] = $this->db->get_where(TABLE_DOCUMENT_COLUMN, array('docs_id' => $this->input->post('docsId')))->result_array();
        $data['docname'] = $this->input->post('docname');
        $html = $this->load->view('admin/document/row_list_tab', $data, TRUE);
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

    public function deleteColumn() {
        if ($this->input->post()) {
            $result = $this->this_model->deleteColumn($this->input->post());
            echo json_encode($result);
            exit();
        }
    }

    function downloadpdf($id) {
        $invoiceId = $this->utility->decode($id);
        if (!ctype_digit($invoiceId)) {
            return(admin_url() . 'document');
        }
        $objArr = array();
        $objArr['docsId'] = $invoiceId;
        $data['rowArray'] = $this->this_model->getRowData($objArr);
        $data['columnArray'] = $this->db->get_where(TABLE_DOCUMENT_COLUMN, array('docs_id' => $invoiceId))->result_array();
        $data['documentData'] = $this->db->get_where(TABLE_DOCUMENT, array('id' => $invoiceId))->row_array();
//        $this->load->view('admin/document/pdf', $data);
        
        //Load the library
        $this->load->library('html2pdf');
        $docsName = $data['documentData']['document_name'];
        
        $this->html2pdf->folder('./public/asset/pdfs/');
        $this->html2pdf->filename($docsName . '.pdf');
        $this->html2pdf->paper('a4', 'portrait');

        $this->html2pdf->html($this->load->view('admin/document/pdf', $data, true));
        unlink('public/asset/pdfs/' . $docsName . '.pdf');
        if ($this->html2pdf->create('save')) {
            $this->load->helper('download');
            $pth = file_get_contents(base_url() . "public/asset/pdfs/$docsName.pdf");
            $nme = $docsName . ".pdf";
            force_download($nme, $pth);
            exit;
        }
    }
    
    public function documentdownload() {
        $data['page'] = "admin/document/documentdownload";
        $data['document'] = 'active';
         $data['downloaddoc'] = 'active';
        $data['pagetitle'] = 'View & Download Document';
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
            'admin/document.js',
        );
        $data['init'] = array(
            'Document.documentList()',
        );
        $data['companyName'] = $this->Client_model->getdocCompanyDetail();
       //print_r($data['companyName']);exit;
        $this->load->view(ADMIN_LAYOUT, $data);
    }
    
    public function viewalldocument($companyId) {
        $data['page'] = "admin/document/viewalldocument";
        $data['document'] = 'active';
        $data['downloaddoc'] = 'active';
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
            'admin/document.js',
        );
        $data['init'] = array(
            'Document.documentList()',
        );
        $data['companyDocName'] = $companyDocName = $this->this_model->getCompanyDocumentDetail($companyId);
//        $data['companyDocName'] = $this->this_model->getCompanyDocumentDetail($companyDocName);
//       print_r($data['companyDocName']);exit;
        $this->load->view(ADMIN_LAYOUT, $data);
    }
    
    public function downloadalldocument($companyId){
//        echo $clientId;
        $companyId = $this->utility->decode($companyId);
        if (!ctype_digit($companyId)) {
            return(admin_url() . 'document');
        }
       
        $documentData = $this->db->get_where(TABLE_DOCUMENT, array('company_id' => $companyId))->result_array();
        $fullData = array();
        $data['documentData'] = $documentData;
        for($i=0;$i<count($documentData);$i++){
            $docId = $documentData[$i]['id'];
            $columnArray = $this->db->get_where(TABLE_DOCUMENT_COLUMN, array('docs_id' => $docId))->result_array();
            $fullData[$i]['column']   = $columnArray;
            $objArr['docsId'] = $docId;
            $fullData[$i]['rowArray'] = $this->this_model->getRowData1($objArr);
        }
       
        $data['fullData'] = $fullData;
        $this->load->library('html2pdf');
        $docsName = 'ClientDocument';
        
        $this->html2pdf->folder('./public/asset/pdfs/');
        $this->html2pdf->filename($docsName . '.pdf');
        $this->html2pdf->paper('a4', 'portrait');

        $this->html2pdf->html($this->load->view('admin/document/pdfAll', $data, true));
        unlink('public/asset/pdfs/' . $docsName . '.pdf');
        if ($this->html2pdf->create('save')) {
            $this->load->helper('download');
            $pth = file_get_contents(base_url() . "public/asset/pdfs/$docsName.pdf");
            $nme = $docsName . ".pdf";
            force_download($nme, $pth);
            exit;
        }
    }
}

?>