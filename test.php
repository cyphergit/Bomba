<?php

include 'config/default_settings.php';
include 'config/dbase.php';
include 'config/crud.php';
include 'classes/enquiry.php';
include 'classes/module_tools.php';
//Initiate default values
$info = new Settings();
//Initiate database connection
$dbase = new DBase();
$dbase->isLocal = true;
$dbase->setting = $info;
$db = $dbase->connect();
//Initiate crud
$crud = new CRUD();
$crud->conn = $db;

//echo $crud->new_id_count("UserCustomerID");
$crud->customer_new("1", "test@email.com", "JC", "Santos");

