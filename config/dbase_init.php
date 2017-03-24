<?php

include 'dbase.php';
include 'crud.php';

//Initiate database connection
$dbase = new DBase();
$dbase->isLocal = true;
$dbase->setting = $info;
$db = $dbase->connect();
//Initiate crud
$crud = new CRUD();
$crud->conn = $db;