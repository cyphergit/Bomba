<?php

session_start();

include '../config/default_settings.php';
include '../classes/enquiry.php';
include '../classes/module_tools.php';
//Initiate default values
$info = new Settings();
//Initiate database connection
include '../config/dbase_init.php';

$company_details = $info->default_settings();
$company = $company_details["company_info"];
$key = $company_details["security"]["key"];
$notif_messages = $company_details["notifs"];

$module_tools = new ModuleTools();

$field = $module_tools->extract_fields($_POST['set']);
$result_array = array();

if ($module_tools->is_injected($field['email']) && $module_tools->is_injected($field['subject'])) {

    $key = "error";
    $value = $notif_messages["sending_error"];
    $result_array[$key] = $value;

    echo json_encode($result_array);
    exit();
}

if (empty($_SESSION['6_letters_code']) || strcmp($_SESSION['6_letters_code'], $field['captcha']) != 0) {

    $key = "error";
    $value = $notif_messages["captcha_mismatched"];
    $result_array[$key] = $value;

    echo json_encode($result_array);
    exit();
}

if ($_SESSION['6_letters_code'] != $field['captcha']) {

    $key = "error";
    $value = $notif_messages["captcha_mismatched"];
    $result_array[$key] = $value;

    echo json_encode($result_array);
    exit();
} else {

    $enquiry = new EnquiryTemplate();

    $enquiry->company = $company["company"];
    $enquiry->sendTo = $company["email_enquiry"];
    $enquiry->ccTo = $company["email_admin"];
    $enquiry->clientFname = $field["firstname"];
    $enquiry->clientLname = $field["lastname"];
    $enquiry->clientEmail = $field["email"];
    $enquiry->clientContact = $field["contact"];
    $enquiry->clientMessage = $field["message"];
    $enquiry->isSubcribed = $field["newsletter"];
    $enquiry->unsubscribeLink = $enquiry->unsubscribe_link($company["website"], $company["link_unsubscribe"]);

    switch ($field["subject"]) {
        case "Others":
            $enquiry->subject = $field["others"];
            break;

        case "Reservation":
            $enquiry->withReservation = true;
            $enquiry->subject = $field["subject"];
            $enquiry->reservationDate = $field["date"];
            $enquiry->reservationTime = $module_tools->alter_time($field["time"]);
            $enquiry->numberOfGuest = $field["guest"];
            break;

        default:
            $enquiry->subject = $field["subject"];
    }

    $isSent = $enquiry->send_enquiry();

    if ($isSent) {

        $subscribed = $enquiry->client_subscribe();
        if ($subscribed) {
            //Add record
            $column = "UserCustomerID";
            $new_id = $crud->id_count_new($column);
            $crud->id_count_update($column, $new_id);
            $crud->customer_new($new_id, $field['email'], $field['firstname'], $field['lastname'], $field['contact']);
            $crud->user_new($new_id, $field['email'], $key);

            //Send notification to admin & client
            $enquiry->notify_admin($company["email_admin"], "", $company["email_newsletter"]);
            $enquiry->notify_client($company["email_no_reply"], $company["email_admin"]);
        }

        $key = "success";
        $value = $notif_messages["sending_success"];
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


