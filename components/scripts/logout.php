<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$input = $_GET['return'];

if($input == 'logout'){
    include_once("$root/components/scripts/functions.php");
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    $cart->destroy();
    header("Location: /index.php");
    exit();
} else{
    header("Location: /index.php");
    exit();
}