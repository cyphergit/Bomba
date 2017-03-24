<?php
session_start();
include 'classes/page.php';

$webpage = new Page();
//HTTP Response Header Protections
$webpage->page_secure();
