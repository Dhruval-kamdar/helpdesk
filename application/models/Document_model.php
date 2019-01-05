<?php

class Document_model extends My_model {

    public function __construct() {
        parent::__construct();
    }

    function getLabelDetaild() {
        $data['select'] = ['id', 'title', 'company_id'];
        $data['table'] = TABLE_LABEL;
        $result = $this->selectRecords($data);
        return $result;
    }

    function getDocumentDetail() {
        $data['select'] = [
            'docs.id', 'docs.document_name', 'docs.company_id',
            'cmp.name as company_name', 'docs.dt_created',
        ];
        $data['table'] = TABLE_DOCUMENT . ' docs';
        $data['join'] = [
            TABLE_COMPANY . ' as cmp' => [
                'cmp.id = docs.company_id',
                'LEFT',
            ],
        ];
//        $data['where'] = ['docs.id' => $companyId];
        $result = $this->selectFromJoin($data);
        return $result;
    }

    function getCompanyDocumentDetail($companyId) {
        $data['select'] = [
            'docs.id', 'docs.document_name', 'docs.company_id',
            'cmp.name as company_name', 'docs.dt_created',
        ];
        $data['table'] = TABLE_DOCUMENT . ' docs';
        $data['join'] = [
            TABLE_COMPANY . ' as cmp' => [
                'cmp.id = docs.company_id',
                'LEFT',
            ],
        ];
        $data['where'] = ['docs.company_id' => $companyId];
        $result = $this->selectFromJoin($data);
        return $result;
    }

    function addDocument($postData) {
        $data ['where'] = [
            'document_name' => $postData['document_name']
        ];
        $data ['table'] = TABLE_DOCUMENT;
        $response = $this->isDuplicate($data);
//        if ($response > 0) {
//            $json_response['status'] = 'error';
//            $json_response['message'] = 'Document Name already exists';
//        } else {
            $data['insert']['document_name'] = $postData['document_name'];
            $data['insert']['company_id'] = $postData['company_id'];
            $data['insert']['dt_created'] = DATE_TIME;
            $data['insert']['dt_updated'] = DATE_TIME;
            $data['table'] = TABLE_DOCUMENT;
            $labelId = $this->insertRecord($data);

            unset($data);
            if ($labelId) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Document add successfully';
                $json_response['redirect'] = admin_url() . 'document';
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong';
            }
//        }
        return $json_response;
    }

    function companyDetail($companyId) {
        $data['select'] = [
            'c.name as companyName', 'c.email as companyEmail',
            'c.phone as companyPhone', 'c.address as companyAddress', 'c.city', 'c.id as companyId',
            'c.country_id', 'ct.name as countyName'];
        $data['table'] = TABLE_COMPANY . ' c';
        $data['join'] = [
            TABLE_COUNTRIES . ' as ct' => [
                'c.country_id = ct.id',
                'LEFT',
            ],
        ];
        $data['where'] = ['c.id' => $companyId];
        $result = $this->selectFromJoin($data);
        return $result;
    }

    function editDocument($postData) {
//        print_r($postData);exit;
        $data['update']['document_name'] = $postData['documentName'];
        $data['update']['company_id'] = $postData['company_id'];
        $data['update']['dt_updated'] = DATE_TIME;
        $data['where'] = ['id' => $postData['documentId']];
        $data['table'] = TABLE_DOCUMENT;
        $result = $this->updateRecords($data);
        unset($data);
        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Document edit successfully';
            $json_response['redirect'] = admin_url() . 'document';
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }

        return $json_response;
    }

    function deleteDocs($data) {
        $this->db->where('id', $data['docsId']);
        $result = $this->db->delete(TABLE_DOCUMENT);
        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Document delete successfully';
            $json_response['jscode'] = 'setTimeout(function(){location.reload();},1000)';
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

    function deleteDocumentInfo($data) {
        $this->db->where('id', $data['docsId']);
        $result = $this->db->delete(TABLE_DOCUMENT_ITEM);
        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Document Item delete successfully';
            $json_response['jscode'] = 'setTimeout(function(){location.reload();},1000)';
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

    function addDocsItem($postData) {
//        print_r($postData);exit;
        $data ['where'] = [
            'document_value' => $postData['item_value']
        ];
        $data ['table'] = TABLE_DOCUMENT_ITEM;
        $response = $this->isDuplicate($data);
        if ($response > 0) {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Value already exists';
        } else {
            $data['insert']['document_date'] = date('Y-m-d', strtotime($postData['item_date']));
            $data['insert']['document_value'] = $postData['item_value'];
            $data['insert']['document_id'] = $postData['docsId'];
            $data['insert']['dt_created'] = DATE_TIME;
            $data['insert']['dt_updated'] = DATE_TIME;
            $data['table'] = TABLE_DOCUMENT_ITEM;
            $labelId = $this->insertRecord($data);
            unset($data);
            if ($labelId) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Document Item add successfully';
                $json_response['redirect'] = admin_url() . 'document';
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong';
            }
        }

        return $json_response;
    }

    function getLabelinfo($companyId) {
        $data['select'] = ['lab.id', 'lab.title', 'lab.company_id'];
        $data['table'] = TABLE_LABEL . ' as lab';
        $data['where'] = ['lab.company_id' => $companyId];
        $result = $this->selectRecords($data);
        $json_encode = json_encode($result);
        $json_decodeArr = json_decode($json_encode, true);
        $finalArr = array();

        for ($i = 0; $i < count($json_decodeArr); $i++) {
            $data['select'] = ['li.item_date', 'li.item_value'];
            $data['table'] = TABLE_LABEL_ITEM . ' as li';
            $data['where'] = ['li.label_id' => $json_decodeArr[$i]['id']];
            $data['order'] = 'li.id desc';
            $data['limit'] = '1,1';
            $resultArr = $this->selectRecords($data);
            $finalArr[$i]['id'] = $json_decodeArr[$i]['id'];
            $finalArr[$i]['title'] = $json_decodeArr[$i]['title'];
            $finalArr[$i]['company_id'] = $json_decodeArr[$i]['company_id'];
            $finalArr[$i]['item_date'] = $resultArr[0]->item_date;
            $finalArr[$i]['item_value'] = $resultArr[0]->item_value;
        }
        return $finalArr;
    }

    function getClientDocumentDetail($companyId) {
        $data['select'] = ['docsItem.document_date', 'docsItem.document_value',
            'docs.id', 'docs.document_name', 'docs.company_id',
            'cmp.name as company_name', 'docs.dt_created',
        ];
        $data['table'] = TABLE_DOCUMENT . ' docs';
        $data['join'] = [
            TABLE_COMPANY . ' as cmp' => [
                'cmp.id = docs.company_id',
                'LEFT',
            ],
            TABLE_DOCUMENT_ITEM . ' as docsItem' => [
                'docsItem.document_id = docs.id',
                'LEFT',
            ],
        ];
        $data['where'] = ['docs.company_id' => $companyId];
        $result = $this->selectFromJoin($data);
        return $result;
    }

    function addColumn($postData) {
//        print_r($postData);
//        exit;
//        $rowArray = $postData['column'];
//        foreach ($rowArray as $row => $value) {
//            print_r($value);exit;
        $data['insert']['column_name'] = $postData['column'];
        $data['insert']['docs_id'] = $postData['docsId'];
        $data['insert']['dt_created'] = DATE_TIME;
        $data['table'] = TABLE_DOCUMENT_COLUMN;
        $result = $this->insertRecord($data);
        unset($data);
//        }

        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Comumn update successfully';
            $json_response['redirect'] = admin_url() . 'document';
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

    function addLabelItem($postData) {
//        print_r($postData);exit;
        $data ['where'] = [
            'document_value' => $postData['item_value']
        ];
        $data ['table'] = TABLE_DOCUMENT_ITEM;
        $response = $this->isDuplicate($data);
        if ($response > 0) {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Value already exists';
        } else {
            $data['insert']['document_date'] = date('Y-m-d', strtotime($postData['item_date']));
            $data['insert']['document_value'] = $postData['item_value'];
            $data['insert']['document_id'] = $postData['docsId'];
            $data['insert']['dt_created'] = DATE_TIME;
            $data['insert']['dt_updated'] = DATE_TIME;
            $data['table'] = TABLE_DOCUMENT_ITEM;
            $labelId = $this->insertRecord($data);
            unset($data);
            if ($labelId) {
                $json_response['status'] = 'success';
                $json_response['message'] = 'Document Item add successfully';
                $json_response['redirect'] = admin_url() . 'document';
            } else {
                $json_response['status'] = 'error';
                $json_response['message'] = 'Something went wrong';
            }
        }

        return $json_response;
    }

    function addRowData($postData) {
        $data['select'] = ['rowcount'];
        $data['table'] = TABLE_DOCUMENT_ROW;
        $data['where'] = ['docs_id' => $postData['docsId']];
        $data['order'] = 'rowcount DESC';
        $rowCount = $this->selectRecords($data);


        $rowArray = $postData['rows'];
        foreach ($rowArray as $row => $arr) {
            foreach ($arr as $key => $value) {
//                if (!empty($value)) {
                $data['insert']['row_value'] = $value;
                $data['insert']['column_id'] = $key;
                $data['insert']['docs_id'] = $postData['docsId'];
                $data['insert']['rowcount'] = $rowCount[0]->rowcount + 1;
                $data['insert']['dt_created'] = DATE_TIME;
                $data['table'] = TABLE_DOCUMENT_ROW;
                $result = $this->insertRecord($data);
                $lastId = $this->db->insert_id();
                unset($data);
//                }
            }
        }
        return TRUE;
    }

    function getRowData($postData, $clientId = NULL) {
        $postData['docsId'];
//        $dataColumn = $this->db->get_where(TABLE_DOCUMENT_COLUMN, array('docs_id' => $postData['docsId']))->result_array();
////        print_r($dataColumn);
////        exit;
//        $dataRow = array();
//        for ($j = 0; $j < count($dataColumn); $j++) {
////            print_r();exit;
//            $dataRow[$j] = $this->db->get_where(TABLE_DOCUMENT_ROW, array('docs_id' => $postData['docsId']))->result_array();
////            $dataRow[$j] = $this->db->get_where(TABLE_DOCUMENT_ROW, array('column_id' => $dataColumn[$j]['id']))->result_array();
//        }
//        print_r($dataRow);exit;

        $data['select'] = ['docsClmn.*', 'docsRow.row_value', 'docsRow.rowcount', 'docsRow.id as rowId'
        ];
        $data['table'] = TABLE_DOCUMENT_COLUMN . ' docsClmn';
        $data['join'] = [
            TABLE_DOCUMENT_ROW . ' as docsRow' => [
                'docsRow.column_id = docsClmn.id',
                'LEFT',
            ],
            TABLE_DOCUMENT . ' as docs' => [
                'docs.id = docsClmn.docs_id',
                'LEFT',
            ],
        ];
        if (!empty($clientId)) {
            $data['where'] = ['docs.company_id' => $clientId];
        }
        $data['where'] = ['docsClmn.docs_id' => $postData['docsId']];
        $result = $this->selectFromJoin($data);
        return $result;
    }

    function getRowData1($postData, $clientId = NULL) {
        
        $this->db->select('docsClmn.*,docsRow.row_value,docsRow.rowcount,docsRow.id as rowId');
        $this->db->from(TABLE_DOCUMENT_COLUMN . ' docsClmn');
        $this->db->join(TABLE_DOCUMENT_ROW . ' as docsRow', 'docsRow.column_id = docsClmn.id', 'left');
        $this->db->join(TABLE_DOCUMENT . ' as docs', 'docs.id = docsClmn.docs_id','LEFT');
      //  $this->db->where('docs.company_id', $clientId);
        $this->db->where('docsClmn.docs_id', $postData['docsId']);
        $result = $this->db->get()->result();

        return $result;
    }

    function deleterow($data) {
        $this->db->where('docs_id', $data['docsId']);
        $this->db->where('rowCount', $data['rowCount']);
        $result = $this->db->delete(TABLE_DOCUMENT_ROW);
        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Row delete successfully';
//            $json_response['jscode'] = 'setTimeout(function(){location.reload();},1000)';
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }
    
    function deleteColumn($data) {
        
        $this->db->where('id', $data['docsId']);
        $result = $this->db->delete(TABLE_DOCUMENT_COLUMN);
        $this->db->where('column_id', $data['docsId']);
        $this->db->delete(TABLE_DOCUMENT_ROW);
        
        if ($result) {
            $json_response['status'] = 'success';
            $json_response['message'] = 'Document Column delete successfully';
//            $json_response['jscode'] = 'setTimeout(function(){location.reload();},1000)';
        } else {
            $json_response['status'] = 'error';
            $json_response['message'] = 'Something went wrong';
        }
        return $json_response;
    }

}

?>