<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once("$root/components/scripts/config.php");
include_once("$root/components/scripts/server.php");
session_start();

function validatePhone($string) {
    $numbersOnly = preg_replace("[^0-9]", "", $string);
    if (strlen($numbersOnly) == 11) $numbersOnly = preg_replace("/^1/", '', $numbersOnly);
    $numberOfDigits = strlen($numbersOnly);
    if ($numberOfDigits == 10) { return $numbersOnly;}
    else return "";
}

//Send email to new users
function sendWelcomeMail($sendTo, $firstName){
    global $mail;
    $mail->From = "no-reply@greenrider.tech";
    $mail->FromName = "GreenRider Team";
    $mail->Subject = "Welcome $firstName!";
    $mail->Body = "Thank you for becoming a part of GreenRider. We hope 
    you enjoy your experience!!";
    $mail->addAddress($sendTo);
    $mail->send();
    return null;
}

//Send an email to allow users to activate accounts
function sendActivationMail($email, $activationHash){
    $link = "http://$_SERVER[HTTP_HOST]/components/scripts/activate.php?email=$email&hash=$activationHash";
    global $mail;
    $mail->From = "no-reply@greenrider.tech";
    $mail->FromName = "GreenRider Team";
    $mail->Subject = "Activate your Account!";
    $mail->Body = "Please click on this link to activate your account
    and begin ordering food. $link";
    $mail->addAddress($email);
    return $mail->send();
}

function findUserWithEmail($email){
    global $db;
    $sql = "SELECT * FROM users WHERE email='$email'";
    $record = mysqli_query($db, $sql);
    return $record;
}

function findOrderWithID($id){
    global $db;
    $sql = "SELECT * FROM orders WHERE id='$id'";
    $record = mysqli_query($db, $sql);
    return $record;
}

function getOrderItems($id){
    global $db;
    $sql = "SELECT * FROM order_items WHERE order_id='$id'";
    $items = mysqli_query($db, $sql);
    $itemArray = array();
    $i = 0;
    while($row = mysqli_fetch_assoc($items)){
        $itemArray[$i] = $row;
        $i = $i + 1;
    }
    $result = array();
    $i = 0;
    foreach($itemArray as $item){
        $product_id = findProductWithID($item['product_id']);
        $product = mysqli_fetch_assoc($product_id);
        $result[$i]['name'] = $product['item'];
        $result[$i]['quantity'] = $item['quantity'];
        $i = $i + 1;
    }
    return json_encode($result);
}

function showOrderItems($id){
    $items = getOrderItems($id);
    $view = file_get_contents($filepath);
}

function findProductWithID($id){
    global $db;
    $sql = "SELECT * FROM products WHERE id='$id'";
    $record = mysqli_query($db, $sql);
    return $record;
}

function generateToken(){
    global $gateway;
    $clientToken = $gateway->clientToken()->generate();
    echo $clientToken;
  }