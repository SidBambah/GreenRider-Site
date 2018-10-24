<?php
$root = $_SERVER['DOCUMENT_ROOT'];
session_start();

$credentials = parse_ini_file("$root/credentials.ini", true);

//Load Composer's autoloader
include_once("$root/vendor/autoload.php");
//Load Cart Class
include_once("$root/components/scripts/class.Cart.php");


//Cart Configuration

// Initialize cart object
$cart = new Cart([
    // Maximum item can added to cart
    'cartMaxItem' => 20,

    // Maximum quantity of a item can be added to cart
    'itemMaxQuantity' => 100,

    // Do not use cookie, cart items will gone after browser closed
    'useCookie' => false,
]);

//Mail Configuration

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

//Mail Server settings

$mail->CharSet="UTF-8";
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = "greenriderlogistics@gmail.com";                 // SMTP username
$mail->Password = "makebank";                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->SMTPAuth = true;

//Braintree Configuration

$gateway = new Braintree_Gateway([
    'environment' => 'sandbox',
    'merchantId' => '9tcbh44p4c8trxmm',
    'publicKey' => 'trnjrrvjg8dq897n',
    'privateKey' => '0579d300346d9927f6dfaf06d1e32f01'
  ]);