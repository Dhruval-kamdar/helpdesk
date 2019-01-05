<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * This file is for Keeping Tablenames in single place and can be used as CONSTANT
 */

/* Performer Related Tables */

define("TABLE_USER", "user");
define("TABLE_COMPANY", "company");
define("TABLE_COUNTRIES", "countries");
define("TABLE_MASTER_DEPARTMENT", "master_department");
define("TABLE_TICKET", "ticket");
define("TABLE_TICKET_CONVERSATION", "ticket_conversation");
define("TABLE_INVOICE", "invoice");
define("TABLE_INVOICE_DETAILS", "invoice_details");
define("TABLE_INVOICE_HISTORY", "invoice_history");
define("TABLE_INVOICE_PAYMENT", "invoice_payment");
define("TABLE_INVOICE_EXPENSE", "invoice_expense");
define("TABLE_LABEL", "label");
define("TABLE_LABEL_ITEM", "label_item");
define("TABLE_ESTIMATE", "estimate");
define("TABLE_ESTIMATE_DETAILS", "estimate_details");
define("TABLE_ESTIMATE_HISTORY", "estimate_history");
define("TABLE_ESTIMATE_PAYMENT", "estimate_payment");
define("TABLE_ESTIMATE_EXPENSE", "estimate_expense");
define("TABLE_DOCUMENT", "document");
define("TABLE_DOCUMENT_ITEM", "document_item");
define("TABLE_DOCUMENT_ROW", "document_row");
define("TABLE_DOCUMENT_COLUMN", "document_column");