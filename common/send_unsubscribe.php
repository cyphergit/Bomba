<?php

include '../config/default_settings.php';
include '../classes/unsubscribe.php';
include '../classes/module_tools.php';
//Initiate default values
$info = new Settings();
//Initiate database connection
include '../config/dbase_init.php';

$company_details = $info->default_settings();
$company = $company_details["company_info"];
$notif_messages = $company_details["notifs"];

$module_tools = new ModuleTools();

$field = $module_tools->extract_fields($_POST['set']);
$result_array = array();

if ($module_tools->is_injected($field['email'])) {

    $key = "error";
    $value = $notif_messages["sending_error"];
    $result_array[$key] = $value;

    echo json_encode($result_array);
    exit();
} else {

    $unsubscribe = new UnsubscribeTemplate();

    $unsubscribe->company = $company["company"];
    $unsubscribe->clientEmail = $field["email"];
    $unsubscribe->from = $company["email_no_reply"];

    $isSent = $unsubscribe->send_unsubscribe_request();

    if ($isSent) {
        //Update record
        $crud->newsletter_unsubcribe($field["email"]);

        $key = "success";
        $value = $notif_messages["sending_unsubscribe"];
        $result_array[$key] = $value;

        echo json_encode($result_array);
        exit();
    } else {

        $key = "error";
        $value = $notif_messages["sending_error"];
        $result_array[$key] = $value;

        echo json_encode($result_array);
        exit();
    }
}
