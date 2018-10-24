<?php
$root = $_SERVER['DOCUMENT_ROOT'];
session_start();
//Activate User Account
include_once("$root/components/scripts/server.php");
include_once("$root/components/scripts/functions.php");

//Send Activation Link
if(isset($_GET['sendActivation']) && $_GET['sendActivation'] == true && isset($_GET['activationHash']) && isset($_GET['email'])){
    $email = mysqli_real_escape_string($db, $_GET['email']);
    $hash = mysqli_real_escape_string($db, $_GET['activationHash']);
    $result = findUserWithEmail($email);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck < 1){
        echo "The activation link is invalid";
    } 
    else{
        //Get user
        $userData = mysqli_fetch_assoc($result);
        //Check if user is active
        if($userData['active'] == 0){
            if($hash == $userData['activationHash']){
                sendActivationMail($email, $hash);
                echo "An activation email has been sent to you!";
            }
            else{
                echo "The activation link is invalid";
            }
        }
        else{
            echo "Your account is already activated!";
        }
    }
}

//Activate User Account
elseif(isset($_GET['email']) && isset($_GET['hash'])){
    $email = mysqli_real_escape_string($db, $_GET['email']);
    $hash = mysqli_real_escape_string($db, $_GET['hash']);
    $result = findUserWithEmail($email);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck == 1){
        $userData = mysqli_fetch_assoc($result);
        if($userData['active'] == 1){
            $message = "alreadyActive";
        }
        elseif($userData['activationHash'] == $hash){
            $sql = "UPDATE users SET active=1 WHERE email='$email'";
            if(mysqli_query($db, $sql)){
                //Successful Account Activation
                $message = "success";
            } else{
                //Error with Activation
                $message = "fail";
            }
        } 
        else{
            //Activation link is broken
            $message = "fail";
        }
    }
    else{
        //Broken Activation link
        $message = "fail";
    }
    if($message == "fail"){
        $message = "Account activation failed. <a href='$root/index.php'> Click
        here </a> to go back.";
    }
    elseif($message == "alreadyActive"){
        $message = "Your account is already active. You may login
        <a href='$root/index.php'> here </a>";
    }
    else{
        $message = "Your have successfully activated your account. You may login
        <a href='$root/index.php'> here </a>";
    }
    echo $message;
}
else{
    //Send user back if they reached accidentally
    header("Location: $root/index.php");
    exit();
}