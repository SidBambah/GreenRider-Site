<?php
$root = $_SERVER['DOCUMENT_ROOT'];

if(isset($_POST['submit'])){
    session_start();
    include_once("$root/components/scripts/functions.php");

    //Get address to verify
    $address = mysqli_real_escape_string($db, $_POST['address']);
    //Variable to hold response
    $data = array();

    if($address != "Choose..."){
        $data['success'] = true;
        $data['message'] = "The delivery address has been succesfully verified!";
        $_SESSION['deliveryAddress'] = $address;
    }else{
        $data['success'] = false;
        $data['message'] = "You must choose a delivery location.";
    }


    echo json_encode($data);
}else{
    //Send user back if they reached accidentally
    header("Location: $root/index.php");
    exit();
}